<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Notificacion;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * <!-- Muestra un listado de productos -->
     */
    public function index()
    {
        $producto = Producto::all();
        return view('producto.index', compact('producto'));
    }

    /**
     * <!-- Muestra el formulario para crear un producto -->
     */
    public function create()
    {
        return view('producto.create', [
            'inventarios' => Inventario::orderBy('nombre')->get(['idInventario', 'nombre']),
        ]);
    }

    /**
     * <!-- Guarda un nuevo producto en la base de datos -->
     */
    public function store(Request $request)
    {
        // ✅ Validación de datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'costo_unitario' => 'required|numeric',
            'stock' => 'required|integer',
            'fecha_vencimiento' => 'nullable|date',
            'categoria' => 'nullable|string|max:255',
            'codigo_barras' => 'nullable|string|max:255',
            'estado' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        DB::beginTransaction();

        try {
            // 1️⃣ Crear inventario asociado
            $inventario = new Inventario();
            $inventario->nombre = $validated['nombre'] ?? 'Inventario de producto';
            $inventario->ubicacion = 'Bodega Principal';
            $inventario->stockTotal = $validated['stock'] ?? 0;
            $inventario->costouni = $validated['costo_unitario'] ?? 0;
            $inventario->valor_total = ($validated['stock'] ?? 0) * ($validated['costo_unitario'] ?? 0);
            $inventario->capacidad_maxima = 100;
            $inventario->alerta_minimos = 5;
            $inventario->responsable = auth()->user()->name ?? 'system';
            $inventario->ultima_revision = Carbon::now();
            $inventario->observaciones = 'Inventario creado automáticamente al crear producto';
            $inventario->usuario_ultima_actualizacion = auth()->id() ?? 1;
            $inventario->save();

            // 2️⃣ Crear producto
            $producto = new Producto();
            $producto->nombre = $validated['nombre'];
            $producto->descripcion = $validated['descripcion'] ?? null;
            $producto->costo_unitario = $validated['costo_unitario'];
            $producto->stock = $validated['stock'];
            $producto->fecha_vencimiento = $validated['fecha_vencimiento'] ?? null;
            $producto->categoria = $validated['categoria'] ?? null;
            $producto->codigo_barras = $validated['codigo_barras'] ?? null;
            $producto->estado = $validated['estado'];

            // ✅ Manejo de imagen
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');

                // Nombre único pero legible (sin caracteres raros)
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) 
                    . '.' . $file->getClientOriginalExtension();

                // Se guarda en storage/app/public/productos
                $file->storeAs('productos', $filename, 'public');

                // Guardamos SOLO el nombre del archivo en DB
                $producto->imagen = $filename;
            }

            // Asociar inventario
            $producto->idInventario = $inventario->idInventario;
            $producto->save();

            DB::commit();

            return redirect()->route('producto.index')->with('success', 'Producto creado con éxito y asociado a inventario.');

        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Error creando producto con inventario: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ocurrió un error al crear el producto: ' . $e->getMessage()]);
        }
    }

    
     // Muestra un producto específico -->
     
    public function show(Producto $producto)
    {
        // Aquí puedes mostrar el detalle de un producto si quieres
    }

    
    //Muestra el formulario para editar un producto -->
     
    public function edit(Producto $producto)
    {
        return view('producto.edit', [
            'producto'    => $producto,
            'inventarios' => Inventario::orderBy('nombre')->get(['idInventario','nombre']),
        ]);
    }

    /**
     * <!-- Actualiza un producto existente -->
     */

public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'costo_unitario' => 'required|numeric',
            'stock' => 'required|integer',
            'fecha_vencimiento' => 'nullable|date',
            'categoria' => 'nullable|string|max:255',
            'codigo_barras' => 'nullable|string|max:255',
            'estado' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $producto->fill($validated);

        // Si hay nueva imagen, reemplazar la anterior
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) 
                . '.' . $file->getClientOriginalExtension();

            // Se guarda en storage/app/public/productos
            $file->storeAs('productos', $filename, 'public');

            // Guardamos SOLO el nombre del archivo en DB
            $producto->imagen = $filename;
        }

        $producto->save();

        //  Notificación si el stock es menor a 10
        if ($producto->stock < 10) {
            Notificacion::create([
                'mensaje'   => "⚠️ El producto '{$producto->nombre}' tiene stock bajo ({$producto->stock}).",
                'idUsuario' => Auth::id(),
                'leida'     => false,
            ]);
        }

        return redirect()->route('producto.index')->with('success', 'Producto actualizado con éxito');
    }


    /**
     * <!-- Elimina un producto de la base de datos -->
     */
    public function destroy(Producto $producto)
    {
        try {
            $producto->delete();
            return back()->with('ok', 'Producto eliminado');
        } catch (\Throwable $e) {
            return back()->withErrors('No se puede eliminar: tiene registros relacionados.');
        }
    }

    /**
     * <!-- Muestra el catálogo de productos -->
     */
    public function catalogo()
    {
        $productos = Producto::all();
        return view('producto.catalogo', compact('productos'));
    }
}

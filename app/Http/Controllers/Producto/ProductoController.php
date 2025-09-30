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
use Illuminate\Support\Facades\Storage;

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
    public function store(StoreProductoRequest $request)
    {
        // ✅ Validación de datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'costo_unitario' => 'required|numeric',
            'stock' => 'required|integer',
            'fecha_vencimiento' => 'nullable|date|after:today',
            'categoria' => 'nullable|string|max:255',
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
            // Generar código de barras automáticamente con prefijo 77 + timestamp
            $producto->codigo_barras = '77' . now()->timestamp . rand(10, 99);
            $producto->estado = $validated['estado'];

            // ✅ MANEJO CORREGIDO DE IMAGEN
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                
                \Log::info('Archivo de imagen recibido:', [
                    'nombre_original' => $file->getClientOriginalName(),
                    'tamaño' => $file->getSize(),
                    'extension' => $file->getClientOriginalExtension()
                ]);

                // Nombre único pero legible
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) 
                    . '.' . $file->getClientOriginalExtension();

                \Log::info('Intentando guardar imagen como: ' . $filename);

                // Guardar usando Storage
                $path = $file->storeAs('public/productos', $filename);
                
                \Log::info('Imagen guardada en: ' . $path);

                // Guardar SOLO el nombre del archivo en DB
                $producto->imagen = $filename;

                \Log::info('Nombre guardado en BD: ' . $filename);
            } else {
                \Log::info('No se recibió archivo de imagen en la request');
            }

            // Asociar inventario
            $producto->idInventario = $inventario->idInventario;
            $producto->save();

            DB::commit();

            \Log::info('Producto creado exitosamente. ID: ' . $producto->idProducto);

            return redirect()->route('producto.index')->with('success', 'Producto creado con éxito y asociado a inventario.');

        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Error creando producto con inventario: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());
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
    public function update(UpdateProductoRequest $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'costo_unitario' => 'required|numeric',
            'stock' => 'required|integer',
            'fecha_vencimiento' => 'nullable|date|after:today',
            'categoria' => 'nullable|string|max:255',
            'estado' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $producto->fill($validated);

            // ✅ MANEJO CORREGIDO DE IMAGEN - ACTUALIZACIÓN
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                
                \Log::info('Actualizando imagen para producto ID: ' . $producto->idProducto);

                // Eliminar imagen anterior si existe
                if ($producto->imagen && Storage::exists('public/productos/' . $producto->imagen)) {
                    Storage::delete('public/productos/' . $producto->imagen);
                    \Log::info('Imagen anterior eliminada: ' . $producto->imagen);
                }

                // Nombre único pero legible
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) 
                    . '.' . $file->getClientOriginalExtension();

                // Guardar usando Storage
                $path = $file->storeAs('public/productos', $filename);
                
                \Log::info('Nueva imagen guardada en: ' . $path);

                // Guardar SOLO el nombre del archivo en DB
                $producto->imagen = $filename;
            }

            $producto->save();

            // Actualizar inventario asociado
            if ($producto->inventario) {
                $producto->inventario->stockTotal = $producto->stock;
                $producto->inventario->costouni = $producto->costo_unitario;
                $producto->inventario->valor_total = $producto->stock * $producto->costo_unitario;
                $producto->inventario->save();
            }

            DB::commit();

            //  Notificación si el stock es menor a 10
            if ($producto->stock < 10) {
                Notificacion::create([
                    'mensaje'   => "⚠️ El producto '{$producto->nombre}' tiene stock bajo ({$producto->stock}).",
                    'idUsuario' => Auth::id(),
                    'leida'     => false,
                ]);
            }

            return redirect()->route('producto.index')->with('success', 'Producto actualizado con éxito');

        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Error actualizando producto: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ocurrió un error al actualizar el producto: ' . $e->getMessage()]);
        }
    }


    /**
     * <!-- Elimina un producto de la base de datos -->
     */
    public function destroy(Producto $producto)
    {
        DB::beginTransaction();
        
        try {
            // Eliminar imagen si existe
            if ($producto->imagen && Storage::exists('public/productos/' . $producto->imagen)) {
                Storage::delete('public/productos/' . $producto->imagen);
            }

            // Eliminar inventario asociado
            if ($producto->inventario) {
                $producto->inventario->delete();
            }

            $producto->delete();
            
            DB::commit();
            
            return back()->with('ok', 'Producto eliminado');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Error eliminando producto: ' . $e->getMessage());
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
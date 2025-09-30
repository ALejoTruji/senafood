<?php

namespace App\Http\Controllers\Ordencompra;

use App\Http\Controllers\Controller;
use App\Models\Ordencompra;
use App\Models\Proveedor;
use App\Models\Producto;
use Illuminate\Http\Request;

class OrdencompraController extends Controller
{
    public function index()
    {
        $ordenes = Ordencompra::with(['proveedor', 'producto', 'usuario'])->get();
        return view('ordencompra.index', compact('ordenes'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('ordencompra.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        try {
            // ✅ CORREGIDO: Cambiar 'producto' por 'idProducto'
            $request->validate([
                'idProveedor' => 'required|exists:proveedor,idProveedor',
                'idProducto' => 'required|exists:producto,idProducto', // ✅ CORREGIDO
                'fecha' => 'required|date',
                'estado' => 'required',
                'cantidad' => 'required|integer|min:1',
                'precioUnitario' => 'required|numeric|min:0',
            ], [
                'idProveedor.required' => 'Debe seleccionar un proveedor.',
                'idProveedor.exists' => 'El proveedor seleccionado no es válido.',
                'idProducto.required' => 'Debe seleccionar un producto.', // ✅ CORREGIDO
                'idProducto.exists' => 'El producto seleccionado no es válido.', // ✅ CORREGIDO
                'fecha.required' => 'La fecha es obligatoria.',
                'cantidad.required' => 'Debe ingresar la cantidad.',
                'precioUnitario.required' => 'Debe ingresar el precio unitario.',
            ]);

            \Log::info('Datos recibidos:', $request->all());
            
            $orden = new Ordencompra();
            $orden->fecha = $request->fecha;
            $orden->estado = $request->estado;
            $orden->idProveedor = $request->idProveedor;
            $orden->idUsuario = auth()->id();
            $orden->idProducto = $request->idProducto; // ✅ CORREGIDO
            $orden->cantidad = $request->cantidad;
            $orden->precioUnitario = $request->precioUnitario;
            $orden->total = $request->cantidad * $request->precioUnitario;
            
            \Log::info('Orden a guardar:', $orden->toArray());
            
            if ($orden->save()) {
                \Log::info('Orden guardada exitosamente. ID: ' . $orden->idOrden);
                return redirect()->route('ordencompra.index')->with('success', 'Orden creada correctamente.');
            } else {
                \Log::error('Error al guardar la orden');
                return back()->with('error', 'Error al crear la orden.');
            }
        } catch (\Exception $e) {
            \Log::error('Error en store: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Ordencompra $ordencompra)
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('ordencompra.edit', compact('ordencompra', 'proveedores', 'productos'));
    }

    public function update(Request $request, Ordencompra $ordencompra)
    {
        try {
            // ✅ CORREGIDO: Cambiar 'producto' por 'idProducto'
            $request->validate([
                'idProveedor' => 'required|exists:proveedor,idProveedor',
                'idProducto' => 'required|exists:producto,idProducto', // ✅ CORREGIDO
                'fecha' => 'required|date',
                'estado' => 'required',
                'cantidad' => 'required|integer|min:1',
                'precioUnitario' => 'required|numeric|min:0',
            ], [
                'idProveedor.required' => 'Debe seleccionar un proveedor.',
                'idProveedor.exists' => 'El proveedor seleccionado no es válido.',
                'idProducto.required' => 'Debe seleccionar un producto.', // ✅ CORREGIDO
                'idProducto.exists' => 'El producto seleccionado no es válido.', // ✅ CORREGIDO
                'fecha.required' => 'La fecha es obligatoria.',
                'cantidad.required' => 'Debe ingresar la cantidad.',
                'precioUnitario.required' => 'Debe ingresar el precio unitario.',
            ]);

            $ordencompra->fecha = $request->fecha;
            $ordencompra->estado = $request->estado;
            $ordencompra->idProveedor = $request->idProveedor;
            $ordencompra->idProducto = $request->idProducto; // ✅ CORREGIDO
            $ordencompra->cantidad = $request->cantidad;
            $ordencompra->precioUnitario = $request->precioUnitario;
            $ordencompra->total = $request->cantidad * $request->precioUnitario;
            
            if ($ordencompra->save()) {
                return redirect()->route('ordencompra.index')->with('success', 'Orden actualizada correctamente.');
            } else {
                return back()->with('error', 'Error al actualizar la orden.');
            }
        } catch (\Exception $e) {
            \Log::error('Error en update: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Ordencompra $ordencompra)
    {
        if ($ordencompra->delete()) {
            return redirect()->route('ordencompra.index')->with('success', 'Orden eliminada correctamente.');
        } else {
            return back()->with('error', 'Error al eliminar la orden.');
        }
    }
}
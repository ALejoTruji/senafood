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
        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required',
            'idProveedor' => 'required|exists:proveedores,id',
            'producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precioUnitario' => 'required|numeric|min:0',
        ]);

        $orden = new Ordencompra();
        $orden->fecha = $request->fecha;
        $orden->estado = $request->estado;
        $orden->idProveedor = $request->idProveedor;
        $orden->idUsuario = auth()->id();
        $orden->producto = $request->producto;
        $orden->cantidad = $request->cantidad;
        $orden->precioUnitario = $request->precioUnitario;
        $orden->total = $request->cantidad * $request->precioUnitario;
        $orden->save();

        return redirect()->route('ordencompra.index')->with('success', 'Orden creada correctamente.');
    }

    public function edit(Ordencompra $ordencompra)
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('ordencompra.edit', compact('ordencompra', 'proveedores', 'productos'));
    }

    public function update(Request $request, Ordencompra $ordencompra)
    {
        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required',
            'idProveedor' => 'required|exists:proveedores,id',
            'producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precioUnitario' => 'required|numeric|min:0',
        ]);

        $ordencompra->update([
            'fecha' => $request->fecha,
            'estado' => $request->estado,
            'idProveedor' => $request->idProveedor,
            'producto' => $request->producto,
            'cantidad' => $request->cantidad,
            'precioUnitario' => $request->precioUnitario,
            'total' => $request->cantidad * $request->precioUnitario,
        ]);

        return redirect()->route('ordencompra.index')->with('success', 'Orden actualizada correctamente.');
    }

    public function destroy(Ordencompra $ordencompra)
    {
        $ordencompra->delete();
        return redirect()->route('ordencompra.index')->with('success', 'Orden eliminada correctamente.');
    }
}
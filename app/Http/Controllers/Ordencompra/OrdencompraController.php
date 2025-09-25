<?php

namespace App\Http\Controllers\Ordencompra;

use App\Http\Controllers\Controller;
use App\Models\OrdenCompra;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Http\Requests\StoreOrdencompraRequest;
use App\Http\Requests\UpdateOrdencompraRequest;

class OrdencompraController extends Controller
{
    /**
     * Muestra un listado de órdenes de compra.
     */
    public function index()
    {
        $ordencompra = OrdenCompra::with(['proveedor', 'producto'])->get();

        return view('ordencompra.index', compact('ordencompra'));
    }

    /**
     * Muestra el formulario para crear una nueva orden de compra.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();

        return view('ordencompra.create', compact('proveedores', 'productos'));
    }

    /**
     * Guarda una nueva orden de compra en la base de datos.
     */
    public function store(StoreOrdencompraRequest $request)
    {
        OrdenCompra::create($request->validated());

        return redirect()
            ->route('ordencompra.index')
            ->with('success', 'Orden de compra creada correctamente.');
    }

    /**
     * Muestra una orden de compra específica.
     */
    public function show(OrdenCompra $ordencompra)
    {
        return view('ordencompra.show', compact('ordencompra'));
    }

    /**
     * Muestra el formulario para editar una orden de compra.
     */
    public function edit(OrdenCompra $ordencompra)
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();

        return view('ordencompra.edit', compact('ordencompra', 'proveedores', 'productos'));
    }

    /**
     * Actualiza una orden de compra existente en la base de datos.
     */
    public function update(UpdateOrdencompraRequest $request, OrdenCompra $ordencompra)
    {
        $ordencompra->update($request->validated());

        return redirect()
            ->route('ordencompra.index')
            ->with('success', 'Orden de compra actualizada correctamente.');
    }

    /**
     * Elimina una orden de compra de la base de datos.
     */
    public function destroy(OrdenCompra $ordencompra)
    {
        $ordencompra->delete();

        return redirect()
            ->route('ordencompra.index')
            ->with('success', 'Orden de compra eliminada correctamente.');
    }
}

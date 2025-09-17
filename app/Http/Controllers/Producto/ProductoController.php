<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd("Entró al index de productos");
        $producto = Producto::all();
        return view('producto.index',compact('producto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Traemos inventarios disponibles para asociar al producto
        return view('producto.create', [
            'inventarios' => Inventario::orderBy('nombre')->get(['idInventario','nombre']),
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $data = $request->validated();

        // Asignar automáticamente el inventario (ejemplo: el primero disponible)
        $inventario = Inventario::first();
        if (!$inventario) {
            return redirect()
                ->route('producto.index')
                ->withErrors('No hay inventarios disponibles para asignar.');
        }

        $data['idInventario'] = $inventario->idInventario;

        Producto::create($data);

        return redirect()
            ->route('producto.index')
            ->with('ok', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('producto.edit', [
            'producto'    => $producto,
            'inventarios' => Inventario::orderBy('nombre')->get(['idInventario','nombre']),
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $data = $request->validated();

        // Mantener el inventario ya asignado
        $data['idInventario'] = $producto->idInventario;

        $producto->update($data);

        return redirect()
            ->route('producto.index')
            ->with('ok', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
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
    
    public function catalogo()
    {
        // Obtiene todos los productos con sus datos
        $productos = \App\Models\Producto::all();

        // Retorna la vista del catálogo con los productos
        return view('producto.catalogo', compact('productos'));
    }
}

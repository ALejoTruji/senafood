<?php

namespace App\Http\Controllers\Promocion;
use App\Http\Controllers\Controller;
use App\Models\Promocion;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promociones = promocion::all();
        return view('promocion.index',compact('promociones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    
            $productos = \App\Models\Producto::all();
    return view('Promocion.create', compact('productos'));
    }

    /**
     * Este código es el método store en el controlador (PromocionController).
     *se usa este método cuando el usuario envía el formulario de crear nueva promoción.
     */
    public function store(Request $request)
    {
            $request->validate([
        'descripcion' => 'required|string|max:255',
        'descuento'   => 'required|numeric|min:1|max:100',
        'idProducto'  => 'required|exists:producto,idProducto', // valida que exista en la tabla producto
    ]);

    \App\Models\Promocion::create($request->all());

    return redirect()->route('Promocion.index')
                    ->with('success', 'Promoción creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

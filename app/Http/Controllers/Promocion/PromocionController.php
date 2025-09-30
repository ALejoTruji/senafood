<?php

namespace App\Http\Controllers\Promocion;

use App\Http\Controllers\Controller;
use App\Models\Promocion;
use App\Models\Producto;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    // Mostrar todas las promociones
    public function index()
    {
        $promociones = Promocion::with('producto')->get();
        return view('promocion.index', compact('promociones'));
    }

    // Mostrar el formulario para crear promoción
    public function create()
    {
        $productos = Producto::all(); // Para el select de productos
        return view('promocion.create', compact('productos'));
    }

    // Guardar nueva promoción
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'descuento'   => 'required|numeric|min:0|max:100',
            'idProducto'  => 'required|exists:producto,idProducto',
            'estado'      => 'required|boolean',
        ]);

        Promocion::create([
            'descripcion' => $request->descripcion,
            'descuento'   => $request->descuento,
            'idProducto'  => $request->idProducto,
            'estado'      => $request->estado,
            'created_at'  => now(), // CORREGIDO: create_at -> created_at
            'updated_at'  => now(), // CORREGIDO: update_at -> updated_at
        ]);

        return redirect()->route('promocion.index')->with('success', 'Promoción creada correctamente.');
    }

    // Mostrar el formulario para editar
    public function edit(Promocion $promocion)
    {
        $productos = Producto::all();
        return view('promocion.edit', compact('promocion', 'productos'));
    }

    // Actualizar promoción
    public function update(Request $request, Promocion $promocion)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'descuento'   => 'required|numeric|min:0|max:100',
            'idProducto'  => 'required|exists:producto,idProducto',
            'estado'      => 'required|boolean',
        ]);

        $promocion->update([
            'descripcion' => $request->descripcion,
            'descuento'   => $request->descuento,
            'idProducto'  => $request->idProducto,
            'estado'      => $request->estado,
            'updated_at'  => now(), // CORREGIDO: update_at -> updated_at
        ]);

        return redirect()->route('promocion.index')->with('success', 'Promoción actualizada correctamente.');
    }

    // Eliminar promoción
    public function destroy(Promocion $promocion)
    {
        $promocion->delete();
        return redirect()->route('promocion.index')->with('success', 'Promoción eliminada correctamente.');
    }
}
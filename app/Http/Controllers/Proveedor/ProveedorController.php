<?php

namespace App\Http\Controllers\Proveedor;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd("Entró al index de Proveedor");
        $proveedor = Proveedor::all();
        return view('proveedor.index',compact('proveedor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedor.create'); // Asegúrate de que esta vista exista
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'contacto' => 'nullable|string|email|max:255',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'nit' => 'nullable|string|max:20',
        ], [
    'contacto.email' => 'El campo Contacto debe ser un correo electrónico válido.',
        ]);

        Proveedor::create($request->all()); // Esto guardará created_at y updated_at automáticamente

        return redirect()->route('proveedor.index')->with('success', 'Proveedor creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //return view('proveedor.show', compact('proveedor')); // Asegúrate de que esta vista exista
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('proveedor.edit', compact('proveedor')); // Asegúrate de que esta vista exista
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'contacto' => 'nullable|string|email|max:255',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'NIT' => 'nullable|string|max:20',
        ], [
        'contacto.email' => 'El campo Contacto debe ser un correo electrónico válido.',
        ]);

        $proveedor->update($validated); // Esto actualizará updated_at automáticamente
        return redirect()->route('proveedor.index')->with('success', 'Proveedor actualizado exitosamente.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedor.index')->with('success', 'Proveedor eliminado exitosamente.');
    }
}

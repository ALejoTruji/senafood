<?php

namespace App\Http\Controllers\Pqrsf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pqrsf;
use Illuminate\Support\Facades\Auth;

class PqrsfController extends Controller
{
    /**
     * Listar todas las PQRSF
     */
    public function index()
    {
        $pqrsfs = Pqrsf::with('usuario')->latest('idPQRSF')->get();
        return view('pqrsf.index', compact('pqrsfs'));
    }

    /**
     * Formulario para crear nueva PQRSF
     */
    public function create()
    {
        return view('pqrsf.create');
    }

    /**
     * Guardar nueva PQRSF
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:50',
            'descripcion' => 'required|string|max:500',
        ]);

        Pqrsf::create([
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente', // estado inicial
            'idUsuario' => Auth::id(), // usuario autenticado
            'idCarrito' => $request->idCarrito ?? null,
            'create_at' => now(),
            'update_at' => now(),
        ]);

        return redirect()->route('pqrsf.index')->with('success', 'PQRSF creada correctamente.');
    }

    /**
     * Mostrar una PQRSF específica
     */
    public function show(string $id)
    {
        $pqrsf = Pqrsf::findOrFail($id);
        return view('pqrsf.show', compact('pqrsf'));
    }

    /**
     * Formulario para editar PQRSF
     */
    public function edit(string $id)
    {
        $pqrsf = Pqrsf::findOrFail($id);
        return view('pqrsf.edit', compact('pqrsf'));
    }

    /**
     * Actualizar PQRSF
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tipo' => 'required|string|max:50',
            'descripcion' => 'required|string|max:500',
            'estado' => 'required|string|max:50',
        ]);

        $pqrsf = Pqrsf::findOrFail($id);
        $pqrsf->update([
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'update_at' => now(),
        ]);

        return redirect()->route('pqrsf.index')->with('success', 'PQRSF actualizada correctamente.');
    }

    /**
     * Eliminar PQRSF
     */
    public function destroy(string $id)
    {
        $pqrsf = Pqrsf::findOrFail($id);
        $pqrsf->delete();

        return redirect()->route('pqrsf.index')->with('success', 'PQRSF eliminada correctamente.');
    }
}

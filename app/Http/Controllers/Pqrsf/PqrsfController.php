<?php

namespace App\Http\Controllers\Pqrsf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pqrsf;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;

class PqrsfController extends Controller
{
    /**
     * Mostra todas las PQRSF (con buscador y paginación)
     */
    public function index(Request $request)
    {
        // Construye la consulta base, cargando la relación con el usuario
        $query = Pqrsf::with('usuario')->latest('idPQRSF');

        // Si el request trae un parámetro de búsqueda (?search=texto)
        if ($request->filled('search')) {
            $search = $request->search;

            // Condiciones para filtrar por tipo, descripción o estado
            $query->where(function($q) use ($search) {
                $q->where('tipo', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%")
                  ->orWhere('estado', 'LIKE', "%{$search}%");
            });
        }

        // Consulta con paginación de 10 registros por página
        // y conserva los parámetros de búsqueda en los links de paginación
        $pqrsfs = $query->paginate(10)->appends($request->all());

        // Retorna la vista con los resultados
        return view('pqrsf.index', compact('pqrsfs'));
    }

    /**
     * Mostra formulario para crear una nueva PQRSF
     */
    public function create()
    {
        return view('pqrsf.create');
    }

    /**
     * Guarda en la BD una nueva PQRSF
     */
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'tipo' => 'required|string|max:50',
            'descripcion' => 'required|string|max:500',
        ]);

        // Crear la PQRSF
        $pqrsf = Pqrsf::create([
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente', // Estado inicial
            'idUsuario' => Auth::id(),
            'id_carrito' => $request->id_carrito ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Crear la notificación enlazada con la PQRSF recién creada
        Notificacion::create([
            'mensaje'   => 'Se ha creado una nueva PQRSF (ID: ' . $pqrsf->idPQRSF . ')',
            'idUsuario' => Auth::id(),
            'idPQRSF'   => $pqrsf->idPQRSF, // 🔗 relación con la PQRSF
            'fecha_envio' => now(),
            'leida'     => false,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('pqrsf.index')
                        ->with('success', 'PQRSF creada correctamente.');
    }


    /**
     * Muostra el detalle de una PQRSF específica
     */
    public function show(string $id)
    {
        $pqrsf = Pqrsf::findOrFail($id);
        return view('pqrsf.show', compact('pqrsf'));
    }

    /**
     * Muostra formulario para editar una PQRSF
     */
    public function edit(string $id)
    {
        $pqrsf = Pqrsf::findOrFail($id);
        return view('pqrsf.edit', compact('pqrsf'));
    }

    /**
     * Actualiza los datos de una PQRSF existente
     */
    public function update(Request $request, string $id)
    {
        // Validación de los campos
        $request->validate([
            'tipo' => 'required|string|max:50',
            'descripcion' => 'required|string|max:500',
            'estado' => 'required|string|max:50',
        ]);

        // Buscar la PQRSF por ID
        $pqrsf = Pqrsf::findOrFail($id);

        // Actualizar los valores
        $pqrsf->update([
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'updated_at' => now(),
        ]);

        // Redirige con mensaje de éxito
        return redirect()->route('pqrsf.index')->with('success', 'PQRSF actualizada correctamente.');
    }

    /**
     * Elimina una PQRSF
     */
    public function destroy(string $id)
    {
        // Busca y elimina el registro
        $pqrsf = Pqrsf::findOrFail($id);
        $pqrsf->delete();

        // Redirige con mensaje de éxito
        return redirect()->route('pqrsf.index')->with('success', 'PQRSF eliminada correctamente.');
    }
}

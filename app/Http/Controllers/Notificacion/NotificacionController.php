<?php

namespace App\Http\Controllers\Notificacion;

use App\Http\Controllers\Controller;
use App\Models\Notificacion;
use App\Http\Requests\StoreNotificacionRequest;
use App\Http\Requests\UpdateNotificacionRequest;
use Carbon\Carbon;

class NotificacionController extends Controller
{
    /**
     * Mostrar todas las notificaciones.
     */
    public function index()
    {
        // Trae todas las notificaciones ordenadas por fecha de envío descendente
        $notificaciones = Notificacion::orderBy('fecha_envio', 'desc')->get();

        // Pasa los datos a la vista
        return view('notificacion.index', compact('notificaciones'));
    }

    /**
     * Muestra el formulario para crear una nueva notificación.
     */
    public function create()
    {
        // Retorna la vista con el formulario de creación
        return view('notificacion.create');
    }

    /**
     * Guarda una nueva notificación en la base de datos.
     */
    public function store(StoreNotificacionRequest $request)
    {
        // Validar datos
        $data = $request->validated();

        // Crear la notificación
        Notificacion::create($data);

        // Redirigir con mensaje de éxito
        return redirect()
            ->route('notificacion.index')
            ->with('ok', 'Notificación creada correctamente.');
    }

    /**
     * Mostra una notificación específica.
     */
    public function show(Notificacion $notificacion)
    {
        // Devolve la vista con los detalles de la notificación
        return view('notificacion.show', compact('notificacion'));
    }

    /**
     * Mostra el formulario para editar una notificación.
     */
    public function edit(Notificacion $notificacion)
    {
        // Pasam la notificación a la vista de edición
        return view('notificacion.edit', compact('notificacion'));
    }

    /**
     * Actualiza una notificación existente en la base de datos.
     */
    public function update(UpdateNotificacionRequest $request, Notificacion $notificacion)
    {
        // Validar datos
        $data = $request->validated();

        // Actualizar la notificación
        $notificacion->update($data);

        return redirect()
            ->route('notificacion.index')
            ->with('ok', 'Notificación actualizada correctamente.');
    }

    /**
     * Elimina una notificación de la base de datos.
     */
    public function destroy(Notificacion $notificacion)
    {
        try {
            $notificacion->delete();
            return back()->with('ok', 'Notificación eliminada correctamente.');
        } catch (\Throwable $e) {
            return back()->withErrors('No se puede eliminar: tiene registros relacionados.');
        }
    }
}

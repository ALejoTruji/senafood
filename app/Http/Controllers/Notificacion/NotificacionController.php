<?php

namespace App\Http\Controllers\Notificacion;

use App\Http\Controllers\Controller;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    /**
     * Muestra todas las notificaciones del usuario autenticado.
     */
    public function index()
    {
        // Obtiene las notificaciones asociadas al usuario logueado
        $notificaciones = Notificacion::where('idUsuario', Auth::id())
            ->orderBy('created_at', 'desc') // Ordenar por fecha de creación (más recientes primero)
            ->get();

        // Retorna la vista index con la lista de notificaciones
        return view('notificacion.index', compact('notificaciones'));
    }

    /**
     * Muestra el formulario para editar una notificación.
     */
    public function edit($id)
    {
        // Busca la notificación por ID o lanza un error 404 si no existe
        $notificacion = Notificacion::findOrFail($id);

        // Retorna la vista de edición con la notificación encontrada
        return view('notificacion.edit', compact('notificacion'));
    }

    /**
     * Actualiza los datos de una notificación en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Busca la notificación a actualizar
        $notificacion = Notificacion::findOrFail($id);

        // Valida los campos que vienen del formulario
        $validated = $request->validate([
            'mensaje' => 'required|string|max:255', // El mensaje es obligatorio
            'fecha_envio' => 'nullable|date',       // La fecha puede ser nula, pero debe ser fecha válida
            'leida' => 'boolean',                   // El estado debe ser verdadero/falso
        ]);

        // Actualiza la notificación con los datos validados
        $notificacion->update($validated);

        // Redirige al detalle de la notificación con mensaje de éxito
        return redirect()->route('notificacion.show', $notificacion->idNotificacion)
                        ->with('success', 'Notificación actualizada correctamente');
    }

    /**
     * Elimina una notificación de la base de datos.
     */
    public function destroy($id)
    {
        // Busca la notificación
        $notificacion = Notificacion::findOrFail($id);

        // La elimina
        $notificacion->delete();

        // Redirige al listado con mensaje de éxito
        return redirect()->route('notificacion.index')
                        ->with('success', 'Notificación eliminada correctamente');
    }

    /**
     * Marca una notificación como leída sin necesidad de abrirla.
     */
    public function marcarLeida($id)
    {
        // Busca la notificación
        $notificacion = Notificacion::findOrFail($id);

        // Cambia el estado a "leída"
        $notificacion->leida = true;

        // Guarda el cambio en la BD
        $notificacion->save();

        // Regresa a la página anterior
        return redirect()->back();
    }

    /**
     * Muestra el detalle de una notificación.
     * Además, si aún no estaba leída, la marca automáticamente como leída.
     */
    public function show($id)
    {
        // Busca la notificación
        $notificacion = Notificacion::findOrFail($id);

        // Si aún no estaba leída, la marca como leída
        if (!$notificacion->leida) {
            $notificacion->leida = true;
            $notificacion->save();
        }

        // ✅ Si la notificación está asociada a una PQRSF, redirigir al detalle
        if ($notificacion->pqrsf) {
            return redirect()->route('pqrsf.show', $notificacion->pqrsf->idPQRSF);
        }

        // ✅ Caso contrario, sigue mostrando la vista normal de notificación
        return view('notificacion.show', compact('notificacion'));
    }


}
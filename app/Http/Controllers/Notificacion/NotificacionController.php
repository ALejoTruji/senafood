<?php

namespace App\Http\Controllers\Notificacion;

use App\Http\Controllers\Controller;
use App\Models\Notificacion;
use App\Http\Requests\StoreNotificacionRequest;
use App\Http\Requests\UpdateNotificacionRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Trae las notificaciones con la relación usuario, ordenadas por fecha de envío
        $notificaciones = Notificacion::with('usuario')
            ->orderBy('fecha_envio', 'desc')
            ->get();

        return view('notificacion.index', compact('notificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos que sí vienen del formulario
        $data = $request->validated();

        // Forzar el usuario autenticado y la fecha
        $data['idUsuario'] = Auth::id();
        $data['fecha_envio'] = now();

        // Crear la notificación
        Notificacion::create($data);

        // Redirigir con mensaje de éxito
        return redirect()
            ->route('notificacion.index')
            ->with('success', 'Notificación creada correctamente.');
    }
    /**
     * Mostra una notificación específica.
     */
    public function show(Notificacion $notificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notificacion $notificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notificacion $notificacion)
    {
        $data = $request->validated();

        // Si quieres evitar que un update cambie de usuario:
        unset($data['idUsuario']);

        $notificacion->update($data);

        return redirect()
            ->route('notificacion.index')
            ->with('success', 'Notificación actualizada correctamente.');
    }

    /**
     * Elimina una notificación de la base de datos.
     */
    public function destroy(Notificacion $notificacion)
    {
        //
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificacionRequest extends FormRequest
{
    /**
     * Autorizar la petición.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'mensaje'     => 'required|string|max:255',
            'idCarrito'   => 'nullable|integer|exists:carrito,idCarrito',
            'leida'       => 'boolean',
            'fechaLeida'  => 'nullable|date',
            // 🔹 Quitamos idUsuario y fecha_envio porque los define el backend
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages()
    {
        return [
            'mensaje.required' => 'El mensaje es obligatorio.',
            'idCarrito.exists' => 'El carrito seleccionado no es válido.',
        ];
    }
}

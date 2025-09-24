<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificacionRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mensaje'      => 'sometimes|required|string|max:255',
            'fecha_envio'  => 'sometimes|required|date',
            'idUsuario'    => 'sometimes|required|integer|exists:users,id',
            'idCarrito'    => 'nullable|integer|exists:carrito,idCarrito',
            'leida'        => 'boolean',
            'fechaLeida'   => 'nullable|date',
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages()
    {
        return [
            'mensaje.required'       => 'El mensaje es obligatorio.',
            'fecha_envio.required'   => 'La fecha de envío es obligatoria.',
            'idUsuario.exists'       => 'El usuario seleccionado no es válido.',
            'idCarrito.exists'       => 'El carrito seleccionado no es válido.',
        ];
    }
}

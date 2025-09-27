<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'    => 'required|string|max:255',
            'contacto'  => 'nullable|string|max:255',
            'telefono'  => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'NIT'       => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'   => 'El nombre del proveedor es obligatorio.',
            'contacto.max'      => 'El contacto no puede tener más de 255 caracteres.',
            'telefono.max'      => 'El teléfono no puede tener más de 15 caracteres.',
            'direccion.max'     => 'La dirección no puede tener más de 255 caracteres.',
            'NIT.max'           => 'El NIT no puede tener más de 20 caracteres.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdencompraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'idProveedor'    => 'required|exists:proveedores,id', 
            'producto'       => 'required|exists:productos,id', // ← corregido
            'fecha'          => 'required|date|after_or_equal:today',
            'estado'         => 'required|string|max:50',
            'cantidad'       => 'required|integer|min:1',
            'precioUnitario' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'idProveedor.required'    => 'Debe seleccionar un proveedor.',
            'producto.required'       => 'Debe seleccionar un producto.', // ← corregido
            'fecha.required'          => 'La fecha es obligatoria.',
            'fecha.after_or_equal'    => 'La fecha no puede ser anterior al día de hoy.',
            'cantidad.required'       => 'Debe ingresar la cantidad.',
            'precioUnitario.required' => 'Debe ingresar el precio unitario.',
        ];
    }
}
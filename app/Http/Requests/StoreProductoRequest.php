<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'           => 'required|string|max:255',
            'descripcion'      => 'nullable|string',
            'costo_unitario'   => 'required|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'fecha_vencimiento'=> 'required|date|after:today',
            'categoria'        => 'required|string|max:100',
            'codigo_barras'    => 'nullable|string|max:50',
            'estado'           => 'required|in:activo,inactivo',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'            => 'El nombre del producto es obligatorio.',
            'costo_unitario.required'    => 'El costo unitario es obligatorio.',
            'costo_unitario.numeric'     => 'El costo unitario debe ser un número.',
            'stock.required'             => 'El stock es obligatorio.',
            'stock.integer'              => 'El stock debe ser un número entero.',
            'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
            'fecha_vencimiento.after'    => 'La fecha de vencimiento debe ser posterior a hoy.',
            'categoria.required'         => 'La categoría es obligatoria.',
            'estado.required'            => 'El estado es obligatorio.',
        ];
    }
}

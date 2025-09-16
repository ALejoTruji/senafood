<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el id del producto desde la ruta
        $id = $this->route('producto')->idProducto;

        return [
            'nombre'           => 'required|string|max:255',
            'descripcion'      => 'nullable|string|max:500',
            'costo_unitario'   => 'required|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'idInventario'     => 'required|integer|exists:inventario,idInventario',
            'fecha_vencimiento'=> 'required|date|after:today',
            'categoria'        => 'required|string|max:100',
            'codigo_barras'    => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('producto', 'codigo_barras')->ignore($id, 'idProducto'),
            ],
            'estado'           => 'required|in:activo,inactivo',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'            => 'El nombre del producto es obligatorio.',
            'nombre.max'                 => 'El nombre no puede superar los 255 caracteres.',
            'costo_unitario.required'    => 'Debe ingresar el costo unitario.',
            'costo_unitario.numeric'     => 'El costo unitario debe ser un número.',
            'stock.required'             => 'Debe ingresar el stock.',
            'stock.integer'              => 'El stock debe ser un número entero.',
            'idInventario.required'      => 'Debe seleccionar un inventario válido.',
            'idInventario.exists'        => 'El inventario seleccionado no existe.',
            'fecha_vencimiento.required' => 'Debe ingresar la fecha de vencimiento.',
            'fecha_vencimiento.after'    => 'La fecha de vencimiento debe ser posterior a hoy.',
            'categoria.required'         => 'Debe ingresar una categoría.',
            'codigo_barras.unique'       => 'El código de barras ya está registrado en otro producto.',
            'estado.required'            => 'Debe indicar el estado del producto.',
            'estado.in'                  => 'El estado solo puede ser activo o inactivo.',
        ];
    }
}

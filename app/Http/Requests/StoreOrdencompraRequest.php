<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdencompraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Permitir a todos los usuarios autenticados
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'idProveedor'    => 'required|integer|exists:proveedores,id', // ajusta "id" si tu PK se llama distinto
            'idProducto'     => 'required|integer|exists:productos,id',  // igual aquí según tu tabla productos
            'fecha'          => 'required|date',
            'estado'         => 'required|string|max:50',
            'cantidad'       => 'required|integer|min:1',
            'precioUnitario' => 'required|numeric|min:0',
            'total'          => 'required|numeric|min:0',
        ];
    }

    /**
     * Mensajes de validación personalizados
     */
    public function messages(): array
    {
        return [
            'idProveedor.required'    => 'Debe seleccionar un proveedor.',
            'idProveedor.exists'      => 'El proveedor seleccionado no existe.',
            'idProducto.required'     => 'Debe seleccionar un producto.',
            'idProducto.exists'       => 'El producto seleccionado no existe.',
            'fecha.required'          => 'La fecha es obligatoria.',
            'fecha.date'              => 'La fecha no tiene un formato válido.',
            'estado.required'         => 'El estado es obligatorio.',
            'cantidad.required'       => 'Debe ingresar la cantidad.',
            'cantidad.integer'        => 'La cantidad debe ser un número entero.',
            'cantidad.min'            => 'La cantidad mínima es 1.',
            'precioUnitario.required' => 'Debe ingresar el precio unitario.',
            'precioUnitario.numeric'  => 'El precio unitario debe ser un número.',
            'precioUnitario.min'      => 'El precio unitario no puede ser negativo.',
            'total.required'          => 'Debe ingresar el total.',
            'total.numeric'           => 'El total debe ser un número.',
            'total.min'               => 'El total no puede ser negativo.',
        ];
    }
}

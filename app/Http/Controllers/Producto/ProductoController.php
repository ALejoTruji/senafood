<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    /**
     * <!-- Muestra un listado de productos -->
     */
    public function index()
    {
        /** 
        * <!-- Obtiene todos los productos -->
        */
        $producto = Producto::all();

        /** 
          * <!-- Retorna la vista con la lista de productos -->
         */
        return view('producto.index', compact('producto'));
    }

    /**
     * <!-- Muestra el formulario para crear un producto -->
     */
    public function create()
    {
        /*
        *<!-- Se traen los inventarios ordenados por nombre para asociarlos al producto -->
        */
        return view('producto.create', [
            'inventarios' => Inventario::orderBy('nombre')->get(['idInventario', 'nombre']),
        ]);
    }

    /**
     * <!-- Guarda un nuevo producto en la base de datos -->
     */
    public function store(StoreProductoRequest $request)
    {
        /**
         * <!-- Valida los datos enviados en el formulario -->
         */
        $data = $request->validated();

        /**
         * <!-- Asigna automáticamente un inventario (ejemplo: el primero disponible) -->
        */
        $inventario = Inventario::first();
        if (!$inventario) {
            /**<!-- Si no hay inventarios, se devuelve con error -->*/
            return redirect()
                ->route('producto.index')
                ->withErrors('No hay inventarios disponibles para asignar.');
        }

        /**<!-- Se asigna el inventario al producto -->*/
        $data['idInventario'] = $inventario->idInventario;

        /**<!-- Crea el producto en la base de datos -->*/
        Producto::create($data);

        /**<!-- Redirige con mensaje de éxito -->*/
        return redirect()
            ->route('producto.index')
            ->with('ok', 'Producto creado correctamente.');
    }

    /**
     * <!-- Muestra un producto específico -->
     */
    public function show(Producto $producto)
    {
        /**<!-- Por ahora vacío, pero se puede usar para mostrar detalle del producto -->*/
    }

    /**
     * <!-- Muestra el formulario para editar un producto -->
     */
    public function edit(Producto $producto)
    {
        /**<!-- Retorna la vista de edición con el producto actual e inventarios -->*/
        return view('producto.edit', [
            'producto'    => $producto,
            'inventarios' => Inventario::orderBy('nombre')->get(['idInventario','nombre']),
        ]);
    }

    /**
     * <!-- Actualiza un producto existente -->
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        /**<!-- Valida los datos del formulario -->*/
        $data = $request->validated();

        /**<!-- Mantiene el inventario previamente asignado -->*/
        $data['idInventario'] = $producto->idInventario;

        /**<!-- Actualiza el producto en la base de datos -->*/
        $producto->update($data);

        /**<!-- Redirige con mensaje de éxito -->*/
        return redirect()
            ->route('producto.index')
            ->with('ok', 'Producto actualizado correctamente.');
    }

    /**
     * <!-- Elimina un producto de la base de datos -->
     */
    public function destroy(Producto $producto)
    {  
        try {
            /**<!-- Intenta eliminar el producto -->*/
            $producto->delete(); 

            /**<!-- Mensaje de éxito si se eliminó -->*/
            return back()->with('ok', 'Producto eliminado');
        } catch (\Throwable $e) {
            /**<!-- Si falla (por relaciones), muestra error -->*/
            return back()->withErrors('No se puede eliminar: tiene registros relacionados.');
        }
    }
    
    /**
     * <!-- Muestra el catálogo de productos -->
     */
    public function catalogo()
    {
        /**<!-- Obtiene todos los productos -->*/
        $productos = \App\Models\Producto::all();

        /**<!-- Retorna la vista del catálogo con los productos -->*/
        return view('producto.catalogo', compact('productos'));
    }
}

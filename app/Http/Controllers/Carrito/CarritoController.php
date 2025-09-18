<?php

// Declara el espacio de nombres del controlador
namespace App\Http\Controllers\Carrito;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
 
    // MÉTODO: Mostrar el carrito
    public function index()
    {
        // Obtiene el carrito desde la sesión.
        // Si no existe, se crea un arreglo vacio
        $carrito = session()->get('carrito', []);

        // Mostra la vista 'carrito.index' y le pasa el carrito
        return view('carrito.index', compact('carrito'));
    }
    // MÉTODO: Añadir un producto al carrito
    public function add(Request $request)
    {
        $producto = Producto::findOrFail($request->idProducto);

        // Obtiene el carrito actual de la sesión (o uno vacío si no existe)
        $carrito = session()->get('carrito', []);

        // Verifica si el producto ya está en el carrito
        if (isset($carrito[$producto->idProducto])) {
            $carrito[$producto->idProducto]['cantidad']++;
        } else {
            // Si no existe, lo agregam cantidad 1
            $carrito[$producto->idProducto] = [
                "nombre" => $producto->nombre,
                "cantidad" => 1,
                "precio" => $producto->costo_unitario
            ];
        }

        // Guarda el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        // Redirige a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', '¡Producto añadido al carrito!');
    }

    // MÉTODO: Eliminar un producto del carrito
    public function remove(Request $request)
    {
        // Obtiene el carrito actual de la sesión
        $carrito = session()->get('carrito', []);

        // Verifica si el producto está en el carrito
        if (isset($carrito[$request->idProducto])) {
            // Si existe, lo eliminamos
            unset($carrito[$request->idProducto]);

            // Guarda el carrito actualizado en la sesión
            session()->put('carrito', $carrito);
        }

        // Redirige a la página anterior con un mensaje 
        return redirect()->back()->with('success', '¡Producto eliminado del carrito!');
    }

    // MÉTODO: Vaciar todo el carrito
    public function clear()
    {
        // Elimina completamente el carrito de la sesión
        session()->forget('carrito');

        // Redirige a la página anterior con un mensaje
        return redirect()->back()->with('success', '¡Carrito vaciado!');
    }
}
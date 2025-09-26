<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Producto\ProductoController;
use App\Http\Controllers\Inventario\InventarioController;
use App\Http\Controllers\Carrito\CarritoController;
use App\Http\Controllers\Proveedor\ProveedorController;
use App\Http\Controllers\Notificacion\NotificacionController;
use App\Http\Controllers\Ordencompra\OrdencompraController;
use App\Http\Controllers\Pqrsf\PqrsfController;



Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('welcome'); // Mostrar la vista welcome
}); 

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
    ->resource('producto', ProductoController::class)
    ->names('producto');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
    ->resource('proveedor', ProveedorController::class)
    ->names('proveedor');

// Ruta para el catálogo de clientes
Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
    ->resource('inventario', InventarioController::class)
    ->names('inventario');

//Ruta Notificacion
Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
    ->resource('notificacion', NotificacionController::class)
    ->names('notificacion');

//Ruta Orden de compra (📌 corregida para usar id en vez de modelo completo)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
    ->resource('ordencompra', OrdencompraController::class)
    ->names('ordencompra');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// 📌 Rutas del pqrsf
Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
    ->resource('pqrsf', PqrsfController::class)
    ->names('pqrsf');

// 📌 Rutas del carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
Route::post('/carrito/remove', [CarritoController::class, 'remove'])->name('carrito.remove');
Route::post('/carrito/clear', [CarritoController::class, 'clear'])->name('carrito.clear');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Producto\ProductoController;
use App\Http\Controllers\Inventario\InventarioController;
use App\Http\Controllers\Carrito\CarritoController;
use App\Http\Controllers\Proveedor\ProveedorController;
use App\Http\Controllers\Promocion\PromocionController;


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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//ruta para promocion
Route::get('/promocion', [PromocionController::class, 'Promocion'])->name('Promocion');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
    ->resource('promocion', PromocionController::class)
    ->names('promoción');

// 📌 Rutas del carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
Route::post('/carrito/remove', [CarritoController::class, 'remove'])->name('carrito.remove');
Route::post('/carrito/clear', [CarritoController::class, 'clear'])->name('carrito.clear');

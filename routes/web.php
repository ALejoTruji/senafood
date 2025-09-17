<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Producto\ProductoController;
use App\Http\Controllers\Inventario\InventarioController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('welcome'); // Mostrar la vista welcome
}); 

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
    ->resource('producto', ProductoController::class)
    ->names('producto');

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

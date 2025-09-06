<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Producto\ProductoController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard') // Si está logueado, ir al dashboard
        : redirect()->route('login');    // Si no, al login
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
->resource('producto',ProductoController::class)
->names('producto');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

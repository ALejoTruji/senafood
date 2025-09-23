<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <!-- Formulario para editar producto -->
        <form action="{{ route('producto.update', $producto->idProducto) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Incluimos todos los campos desde form.blade.php -->
            @include('producto.partials.form', ['producto' => $producto])
        </form>
    </div>
</x-app-layout>

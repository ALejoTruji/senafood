<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Producto') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <!-- Formulario para crear producto -->
        <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Incluimos todos los campos desde form.blade.php -->
            @include('producto.partials.form')
        </form>
    </div>
</x-app-layout>

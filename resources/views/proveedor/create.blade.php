<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Proveedor') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <!-- Formulario para crear proveedor -->
        <form action="{{ route('proveedor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Incluimos todos los campos desde form.blade.php -->
            @include('proveedor.partials.form')
        </form>
    </div>
</x-app-layout>

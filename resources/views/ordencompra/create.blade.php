{{-- resources/views/ordencompra/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-green-500 leading-tight text-center">
                {{ __('Crear Orden de Compra') }}
            </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <!-- Formulario para crear orden de compra -->
        <form action="{{ route('ordencompra.store') }}" method="POST">
            @csrf
            <!-- Incluimos todos los campos desde form.blade.php -->
            @include('ordencompra.partials.form', [
                'ordencompra' => null,
                'proveedores' => $proveedores,
                'productos' => $productos,
            ])
        </form>
    </div>
</x-app-layout>

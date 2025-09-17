<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4 text-green-600 leading-tight text-center">
            {{ __('Catálogo de Productos') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($productos as $producto)
            <div class="bg-white rounded-lg shadow p-4">
                <img src="{{ asset('storage/productos/' . $producto->imagen) }}"
                    alt="{{ $producto->nombre }}"
                    class="max-w-[200px] max-h-[200px] object-contain rounded-md mb-4 mx-auto">
                <h3 class="mt-2 font-bold text-lg">{{ $producto->nombre }}</h3>
                <p class="text-gray-600">{{ $producto->descripcion }}</p>
                <p class="text-green-700 font-semibold">$
                    {{ number_format($producto->costo_unitario, 0, ',', '.') }}
                </p>
                <p class="text-sm text-gray-500">Stock: {{ $producto->stock }}</p>

                <button class="mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Añadir al carrito
                </button>
            </div>
        @endforeach
    </div>
</x-app-layout>

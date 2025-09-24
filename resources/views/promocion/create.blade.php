    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Promoción') }}
        </h2>
    </x-slot>

    {{-- Formulario para crear una nueva promoción --}}
    <div class="container mx-auto py-6">
        <form action="{{ route('Promocion.store') }}" method="POST">
            @csrf

            {{-- Campo descripción --}}
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <input type="text" name="descripcion" id="descripcion"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required>
            </div>

            {{-- Campo descuento --}}
            <div class="mb-4">
                <label for="descuento" class="block text-sm font-medium text-gray-700">Descuento (%)</label>
                <input type="number" name="descuento" id="descuento" min="1" max="100"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required>
            </div>

            {{-- Campo producto asociado --}}
            <div class="mb-4">
                <label for="idProducto" class="block text-sm font-medium text-gray-700">Producto</label>
                <select name="idProducto" id="idProducto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">-- Selecciona un producto --</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->idProducto }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end">
                <a href="{{ route('Promocion.index') }}" class="btn btn-secondary mr-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>

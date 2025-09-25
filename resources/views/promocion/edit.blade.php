<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Promoción') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <form action="{{ route('Promocion.update', $Promocion->idPromocion) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            {{-- Campo descripcion --}}
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $promocion->descripcion) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            {{-- Campo descuento --}}
            <div class="mb-4">
                <label for="descuento" class="block text-sm font-medium text-gray-700">Descuento (%)</label>
                <input type="number" name="descuento" id="descuento" value="{{ old('descuento', $promocion->descuento) }}"
                    min="1" max="100" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            {{-- Campo producto --}}
            <div class="mb-4">
                <label for="idProducto" class="block text-sm font-medium text-gray-700">Producto</label>
                <select name="idProducto" id="idProducto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">-- Selecciona un producto --</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->idProducto }}" {{ $producto->idProducto == $promocion->idProducto ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end">
                <a href="{{ route('Promocion.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">Cancelar</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
            </div>
        </form>
    </div>
</x-app-layout>
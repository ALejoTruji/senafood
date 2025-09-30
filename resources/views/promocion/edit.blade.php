<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4 text-green-600 leading-tight text-center">
            {{ __('Editar Promoción') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                {{-- Mensajes de éxito --}}
                @foreach (['ok', 'success'] as $msg)
                    @if (session($msg))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session($msg) }}
                        </div>
                    @endif
                @endforeach

                {{-- Errores --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('promocion.update', $promocion->idPromocion) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Descripción</label>
                        <input type="text" name="descripcion" value="{{ old('descripcion', $promocion->descripcion) }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Descuento (%)</label>
                        <input type="number" name="descuento" value="{{ old('descuento', $promocion->descuento) }}" min="0" max="100" step="0.01"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Producto</label>
                        <select name="idProducto" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @foreach($productos as $producto)
                                <option value="{{ $producto->idProducto }}" 
                                    {{ old('idProducto', $promocion->idProducto) == $producto->idProducto ? 'selected' : '' }}>
                                    {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Estado</label>
                        <select name="estado" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="1" {{ old('estado', $promocion->estado) == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado', $promocion->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('promocion.index') }}"
                        class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg shadow">
                        Cancelar
                        </a>
                        <button type="submit" 
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow">
                            Actualizar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
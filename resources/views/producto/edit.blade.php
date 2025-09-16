<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4 text-green-600 leading-tight text-center">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                {{-- Mensajes --}}
                @if (session('ok'))
                    <p class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('ok') }}
                    </p>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulario --}}
                <form action="{{ route('producto.update', $producto->idProducto) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nombre" class="block font-semibold">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                               value="{{ old('nombre', $producto->nombre) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block font-semibold">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3"
                                  class="w-full border rounded px-3 py-2">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="costo_unitario" class="block font-semibold">Costo Unitario</label>
                        <input type="number" step="0.01" name="costo_unitario" id="costo_unitario"
                               value="{{ old('costo_unitario', $producto->costo_unitario) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="stock" class="block font-semibold">Stock</label>
                        <input type="number" name="stock" id="stock"
                               value="{{ old('stock', $producto->stock) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="idInventario" class="block font-semibold">Inventario</label>
                        <select name="idInventario" id="idInventario"
                                class="w-full border rounded px-3 py-2">
                            @foreach($inventarios as $inv)
                                <option value="{{ $inv->idInventario }}"
                                    {{ old('idInventario', $producto->idInventario) == $inv->idInventario ? 'selected' : '' }}>
                                    {{ $inv->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="fecha_vencimiento" class="block font-semibold">Fecha de Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                               value="{{ old('fecha_vencimiento', $producto->fecha_vencimiento ? $producto->fecha_vencimiento->format('Y-m-d') : '') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="categoria" class="block font-semibold">Categoría</label>
                        <input type="text" name="categoria" id="categoria"
                               value="{{ old('categoria', $producto->categoria) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="codigo_barras" class="block font-semibold">Código de Barras</label>
                        <input type="text" name="codigo_barras" id="codigo_barras"
                               value="{{ old('codigo_barras', $producto->codigo_barras) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label for="estado" class="block font-semibold">Estado</label>
                        <select name="estado" id="estado"
                                class="w-full border rounded px-3 py-2">
                            <option value="activo" {{ old('estado', $producto->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('estado', $producto->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('producto.index') }}"
                           class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-4 py-2 rounded mr-2">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

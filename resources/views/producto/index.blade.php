
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="table-auto w-full border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Descripción</th>
                            <th class="px-4 py-2 border">Costo Unitario</th>
                            <th class="px-4 py-2 border">Stock</th>
                            <th class="px-4 py-2 border">Inventario</th>
                            <th class="px-4 py-2 border">Fecha Vencimiento</th>
                            <th class="px-4 py-2 border">Categoría</th>
                            <th class="px-4 py-2 border">Código Barras</th>
                            <th class="px-4 py-2 border">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producto as $item)
                            <tr>
                                <td class="px-4 py-2 border">{{ $item->nombre }}</td>
                                <td class="px-4 py-2 border">{{ $item->descripcion }}</td>
                                <td class="px-4 py-2 border">{{ $item->costo_unitario }}</td>
                                <td class="px-4 py-2 border">{{ $item->stock }}</td>
                                <td class="px-4 py-2 border">{{ $item->idInventario }}</td>
                                <td class="px-4 py-2 border">{{ $item->fecha_vencimiento }}</td>
                                <td class="px-4 py-2 border">{{ $item->categoria }}</td>
                                <td class="px-4 py-2 border">{{ $item->codigo_barras }}</td>
                                <td class="px-4 py-2 border">{{ $item->estado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <!-- Encabezado de la página -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de PQRSF
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Botón para crear una nueva PQRSF -->
        <a href="{{ route('pqrsf.create') }}"
           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
           + Nueva PQRSF
        </a>

        <div class="mt-6 bg-white shadow rounded p-4">
            <!-- Mensaje de éxito si viene de la sesión -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla con la lista de PQRSF -->
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Tipo</th>
                        <th class="border px-4 py-2">Descripción</th>
                        <th class="border px-4 py-2">Estado</th>
                        <th class="border px-4 py-2">Usuario</th>
                        <th class="border px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Recorredor de todas las PQRSF -->
                    @forelse ($pqrsfs as $pqrsf)
                        <tr>
                            <td class="border px-4 py-2">{{ $pqrsf->idPQRSF }}</td>
                            <td class="border px-4 py-2">{{ $pqrsf->tipo }}</td>
                            <td class="border px-4 py-2">{{ $pqrsf->descripcion }}</td>
                            <td class="border px-4 py-2">{{ $pqrsf->estado }}</td>
                            <td class="border px-4 py-2">{{ $pqrsf->usuario->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2 space-x-2">
                            <!-- Botón Ver -->
                            <a href="{{ route('pqrsf.show', $pqrsf->idPQRSF) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            Ver
                            </a>

                            <!-- Botón Editar -->
                            <a href="{{ route('pqrsf.edit', $pqrsf->idPQRSF) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                            Editar
                            </a>

                            <!-- Botón Eliminar -->
                            <form action="{{ route('pqrsf.destroy', $pqrsf->idPQRSF) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                    onclick="return confirm('¿Eliminar este registro?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                        </tr>
                    @empty
                        <!-- Si no hay registros -->
                        <tr>
                            <td colspan="6" class="text-center py-4">No hay PQRSF registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

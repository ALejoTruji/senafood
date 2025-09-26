<x-app-layout>
    <!-- Encabezado -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de PQRSF
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            <!-- Tabla con la información de la PQRSF -->
            <table class="w-full border-collapse">
                <tbody>
                    <tr>
                        <th class="border px-4 py-2 text-left bg-gray-100">ID</th>
                        <td class="border px-4 py-2">{{ $pqrsf->idPQRSF }}</td>
                    </tr>
                    <tr>
                        <th class="border px-4 py-2 text-left bg-gray-100">Tipo</th>
                        <td class="border px-4 py-2">{{ $pqrsf->tipo }}</td>
                    </tr>
                    <tr>
                        <th class="border px-4 py-2 text-left bg-gray-100">Descripción</th>
                        <td class="border px-4 py-2">{{ $pqrsf->descripcion }}</td>
                    </tr>
                    <tr>
                        <th class="border px-4 py-2 text-left bg-gray-100">Estado</th>
                        <td class="border px-4 py-2">{{ $pqrsf->estado }}</td>
                    </tr>
                    <tr>
                        <th class="border px-4 py-2 text-left bg-gray-100">Usuario</th>
                        <td class="border px-4 py-2">{{ $pqrsf->usuario->name ?? 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Botones de acción -->
            <div class="mt-6 flex space-x-3">
                <!-- Botón volver -->
                <a href="{{ route('pqrsf.index') }}" 
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    ← Volver
                </a>

                <!-- Botón editar -->
                <a href="{{ route('pqrsf.edit', $pqrsf->idPQRSF) }}" 
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    ✏️ Editar
                </a>

                <!-- Botón eliminar -->
                <form action="{{ route('pqrsf.destroy', $pqrsf->idPQRSF) }}" method="POST" 
                    onsubmit="return confirm('¿Seguro que deseas eliminar esta PQRSF?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        🗑️ Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de Notificación
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow p-6 rounded">
        <h1 class="text-2xl font-bold mb-4">Detalle de Notificación</h1>

        <p><strong>ID:</strong> {{ $notificacion->idNotificacion }}</p>
        <p><strong>Mensaje:</strong> {{ $notificacion->mensaje }}</p>
        <p><strong>Usuario:</strong> {{ $notificacion->usuario->name ?? 'N/A' }}</p>
        <p><strong>Fecha de envío:</strong> {{ $notificacion->fecha_envio }}</p>
        <p><strong>Estado:</strong> {{ $notificacion->leida ? 'Leída' : 'No leída' }}</p>

        <div class="mt-4 flex space-x-2">
            <!-- Volver -->
            <a href="{{ route('notificacion.index') }}" 
            class="bg-gray-500 hover:bg-gray-700 px-3 py-2 text-white rounded">
                ← Volver
            </a>

            <!-- Editar -->
            <a href="{{ route('notificacion.edit', $notificacion->idNotificacion) }}" 
            class="bg-yellow-500 hover:bg-yellow-700 px-3 py-2 text-white rounded">
                ✏️ Actualizar
            </a>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <!-- Encabezado -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Notificación
        </h2>
    </x-slot>

    <!-- Contenido -->
    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            <h1 class="text-2xl font-bold mb-4">Editar Notificación</h1>

            <form action="{{ route('notificacion.update', $notificacion->idNotificacion) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Mensaje -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Mensaje</label>
                    <input name="mensaje" type="text"
                        value="{{ old('mensaje', $notificacion->mensaje) }}"
                        class="mt-1 block w-full border-gray-300 rounded px-3 py-2" required>
                </div>

                <!-- Fecha de envío (datetime-local) -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Fecha de envío</label>
                    <input name="fecha_envio" type="datetime-local"
                        value="{{ old('fecha_envio', optional($notificacion->fecha_envio)->format('Y-m-d\TH:i')) }}"
                        class="mt-1 block w-full border-gray-300 rounded px-3 py-2">
                </div>

                <!-- Leída (checkbox) -->
                <div class="mb-4">
                    <!-- hidden para enviar 0 si no se marca -->
                    <input type="hidden" name="leida" value="0">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="leida" value="1"
                            class="rounded" {{ old('leida', $notificacion->leida) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">Marcar como leída</span>
                    </label>
                </div>

                <!-- Botones -->
                <div class="flex space-x-3 mt-6">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Guardar
                    </button>

                    <a href="{{ route('notificacion.show', $notificacion->idNotificacion) }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Cancelar
                    </a>

                    <form action="{{ route('notificacion.destroy', $notificacion->idNotificacion) }}" method="POST"
                        onsubmit="return confirm('¿Eliminar notificación?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Eliminar
                        </button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

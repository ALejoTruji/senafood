<!-- Usamos el layout principal -->
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-bold mb-4">Editar Notificación</h1>
    </x-slot>

    <!-- Formulario de edición -->
    <form action="{{ route('notificacion.update', $notificacion) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Incluimos el formulario parcial con datos -->
        @include('notificacion._form', ['notificacion' => $notificacion])

        <!-- Botones -->
        <div class="pt-4 flex gap-3">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
            <a href="{{ route('notificacion.index') }}" class="px-4 py-2 border rounded">Cancelar</a>
        </div>
    </form>
</x-app-layout>

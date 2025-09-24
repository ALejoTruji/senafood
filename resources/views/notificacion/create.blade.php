<!-- Usamos el layout principal -->
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-bold mb-4">Crear Notificación</h1>
    </x-slot>

    <!-- Formulario de creación -->
    <form action="{{ route('notificacion.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Incluimos el formulario parcial con los campos -->
        @include('notificacion._form', ['notificacion' => null])

        <!-- Botones -->
        <div class="pt-4 flex gap-3">
            <button class="px-4 py-2 bg-green-600 text-white rounded">Guardar</button>
            <a href="{{ route('notificacion.index') }}" class="px-4 py-2 border rounded">Cancelar</a>
        </div>
    </form>
</x-app-layout>

<x-app-layout>
    <!-- Encabezado -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear PQRSF
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            
            <!-- Mostrar errores de validación -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario para crear PQRSF -->
            <form action="{{ route('pqrsf.store') }}" method="POST">
                @csrf

                <!-- Campo tipo con opciones fijas -->
                <div class="mb-4">
                    <label for="tipo" class="block text-gray-700 font-semibold">Tipo de PQRSF</label>
                    <select name="tipo" id="tipo" class="w-full border rounded px-3 py-2" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Petición">Petición</option>
                        <option value="Queja">Queja</option>
                        <option value="Reclamo">Reclamo</option>
                        <option value="Sugerencia">Sugerencia</option>
                        <option value="Felicitación">Felicitación</option>
                    </select>
                </div>

                <!-- Campo descripción -->
                <div class="mb-4">
                    <label for="descripcion" class="block text-gray-700 font-semibold">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4" 
                            class="w-full border rounded px-3 py-2" required></textarea>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-between">
                    <!-- Botón Guardar -->
                    <button type="submit" 
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Guardar
                    </button>

                    <!-- Botón Cancelar -->
                    <a href="{{ route('pqrsf.index') }}" 
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

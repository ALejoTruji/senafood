<x-app-layout>
    <!-- Encabezado -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar PQRSF
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            
            <!-- Muestra errores de validación -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario de edición -->
            <form action="{{ route('pqrsf.update', $pqrsf->idPQRSF) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campo tipo con opciones fijas -->
                <div class="mb-4">
                    <label for="tipo" class="block text-gray-700 font-semibold">Tipo de PQRSF</label>
                    <select name="tipo" id="tipo" class="w-full border rounded px-3 py-2" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Petición" {{ $pqrsf->tipo == 'Petición' ? 'selected' : '' }}>Petición</option>
                        <option value="Queja" {{ $pqrsf->tipo == 'Queja' ? 'selected' : '' }}>Queja</option>
                        <option value="Reclamo" {{ $pqrsf->tipo == 'Reclamo' ? 'selected' : '' }}>Reclamo</option>
                        <option value="Sugerencia" {{ $pqrsf->tipo == 'Sugerencia' ? 'selected' : '' }}>Sugerencia</option>
                        <option value="Felicitación" {{ $pqrsf->tipo == 'Felicitación' ? 'selected' : '' }}>Felicitación</option>
                    </select>
                </div>

                <!-- Campo descripción -->
                <div class="mb-4">
                    <label for="descripcion" class="block text-gray-700 font-semibold">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4"
                        class="w-full border rounded px-3 py-2"
                        required>{{ old('descripcion', $pqrsf->descripcion) }}</textarea>
                </div>

                <!-- Campo estado -->
                <div class="mb-4">
                    <label for="estado" class="block text-gray-700 font-semibold">Estado</label>
                    <select name="estado" id="estado" class="w-full border rounded px-3 py-2" required>
                        <option value="">Seleccione un estado</option>
                        <option value="Pendiente" {{ $pqrsf->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="En Proceso" {{ $pqrsf->estado == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="Resuelto" {{ $pqrsf->estado == 'Resuelto' ? 'selected' : '' }}>Resuelto</option>
                    </select>
                </div>

                <!-- Botón -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<!-- resources/views/producto/create.blade.php -->

<x-app-layout>
    <!-- Slot para el encabezado superior de la vista -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Producto') }}
        </h2>
    </x-slot>

    <!-- Contenedor principal centrado con ancho máximo -->
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">

        <!--
            FORMULARIO DE CREACIÓN DE PRODUCTO 
            - method="POST": envía datos al servidor
            - action="{{ route('producto.store') }}": apunta al método store del ProductoController
            - enctype="multipart/form-data": NECESARIO para poder enviar archivos (imagenes)
        -->
        <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Token de seguridad obligatorio en Laravel para proteger el formulario -->

            <!-- FORMULARIO REUTILIZABLE -->
            <!-- Aquí se incluyen los campos comunes (nombre, descripción, precio, stock, etc.) -->
            @include('producto.partials.form')

            <!-- CAMPO DE SUBIDA DE IMAGEN -->
            <div class="mb-4">
                <label for="imagen" class="block font-semibold">Imagen</label>

                <!-- 
                    Input tipo archivo
                    - name="imagen": este nombre debe coincidir con la columna en la BD y la validación
                    - accept="image/*": filtra solo imágenes en el selector de archivos
                -->
                <input 
                    type="file" 
                    name="imagen" 
                    id="imagen" 
                    accept="image/*" 
                    class="w-full border rounded px-3 py-2"
                >

                <!-- Mensaje de error en caso de que la validación falle (ej: tipo no válido, tamaño muy grande) -->
                @error('imagen') 
                    <p class="text-red-600 text-sm">{{ $message }}</p> 
                @enderror
            </div>

            <!-- BOTÓN DE ENVÍO -->
            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition"
                >
                    Crear
                </button>
            </div>
        </form>
    </div>
</x-app-layout>


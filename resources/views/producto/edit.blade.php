<x-app-layout>
    <!-- Sección del encabezado de la vista -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- Título de la página -->
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <!-- Contenedor principal centrado con un ancho máximo -->
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">

        <!-- Formulario para actualizar el producto -->
        <!-- La acción apunta a la ruta 'producto.update' pasando el ID del producto -->
        <!-- method="POST" se usa pero luego se especifica que es un PUT para actualizar -->
        <form action="{{ route('producto.update', $producto->idProducto) }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Token de seguridad obligatorio en formularios Laravel -->
            @method('PUT') <!-- Indica que este formulario hará una actualización -->

            <!-- Se incluye el formulario reutilizable con los campos -->
            <!-- Se pasa el objeto $producto para que se carguen los valores en los inputs -->
            @include('producto.partials.form', ['producto' => $producto])
        </form>
    </div>
</x-app-layout>

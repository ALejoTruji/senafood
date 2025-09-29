<!-- resources/views/proveedor/partials/form.blade.php -->

<!-- Campo: Nombre del proveedor -->
<div class="mb-4">
    <label for="nombre" class="block text-gray-700">Nombre</label>
    <input type="text" name="nombre" id="nombre"
        value="{{ old('nombre', $proveedor->nombre ?? '') }}"
        class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
</div>

<!-- Campo: Contacto -->
<div class="mb-4">
    <label for="contacto" class="block text-gray-700">Contacto</label>
    <input type="text" name="contacto" id="contacto"
        value="{{ old('contacto', $proveedor->contacto ?? '') }}"
        class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
</div>

<!-- Campo: Teléfono -->
<div class="mb-4">
    <label for="telefono" class="block text-gray-700">Teléfono</label>
    <input type="text" name="telefono" id="telefono"
        value="{{ old('telefono', $proveedor->telefono ?? '') }}"
        class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
</div>

<!-- Campo: Dirección -->
<div class="mb-4">
    <label for="direccion" class="block text-gray-700">Dirección</label>
    <input type="text" name="direccion" id="direccion"
        value="{{ old('direccion', $proveedor->direccion ?? '') }}"
        class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
</div>

<!-- Campo: NIT -->
<div class="mb-4">
    <label for="NIT" class="block text-gray-700">NIT</label>
    <input type="text" name="NIT" id="NIT"
        value="{{ old('NIT', $proveedor->NIT ?? '') }}"
        class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
</div>

<!-- Botón submit -->
<div class="flex justify-end mt-4">
    <a href="{{route('proveedor.index')}}" 
    class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">
    Cancelar
    </a>
    <button type="submit" 
        class="ml-2 bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
        Guardar
    </button>
</div>

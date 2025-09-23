<!-- resources/views/producto/partials/form.blade.php -->

<!-- Campo: Nombre del producto -->
<div class="mb-4">
    <label for="nombre" class="block text-gray-700">Nombre</label>
    <input type="text" name="nombre" id="nombre"
           value="{{ old('nombre', $producto->nombre ?? '') }}"
           class="mt-1 block w-full  border-green-500 rounded-md shadow-sm">
</div>

<!-- Campo: Descripción -->
<div class="mb-4">
    <label for="descripcion" class="block text-gray-700">Descripción</label>
    <textarea name="descripcion" id="descripcion"
              class="mt-1 block w-full  border-green-500 rounded-md shadow-sm">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
</div>

<!-- Campo: Costo unitario -->
<div class="mb-4">
    <label for="costo_unitario" class="block text-gray-700">Costo Unitario</label>
    <input type="number" step="0.01" name="costo_unitario" id="costo_unitario"
           value="{{ old('costo_unitario', $producto->costo_unitario ?? '') }}"
           class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
</div>

<!-- Campo: Stock -->
<div class="mb-4">
    <label for="stock" class="block text-gray-700">Stock</label>
    <input type="number" name="stock" id="stock"
           value="{{ old('stock', $producto->stock ?? '') }}"
           class="mt-1 block w-full  border-green-500 rounded-md shadow-sm">
</div>

<!-- Campo: Fecha de vencimiento -->
<div class="mb-4">
    <label for="fecha_vencimiento" class="block text-gray-700">Fecha de vencimiento</label>
    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
           value="{{ old('fecha_vencimiento', isset($producto->fecha_vencimiento) ? \Carbon\Carbon::parse($producto->fecha_vencimiento)->format('Y-m-d') : '') }}"
           class="mt-1 block w-full  border-green-500 rounded-md shadow-sm">
</div>

<!-- Campo: Categoría -->
<div class="mb-4">
    <label for="categoria" class="block text-gray-700">Categoría</label>
    <input type="text" name="categoria" id="categoria"
           value="{{ old('categoria', $producto->categoria ?? '') }}"
           class="mt-1 block w-full  border-green-500 rounded-md shadow-sm">
</div>

<!-- Campo: Código de barras -->
<div class="mb-4">
    <label for="codigo_barras" class="block text-gray-700">Código de Barras</label>
    <input type="text" name="codigo_barras" id="codigo_barras"
           value="{{ old('codigo_barras', $producto->codigo_barras ?? '') }}"
           class="mt-1 block w-full  border-green-500 rounded-md shadow-sm">
</div>

<!-- Campo: Estado -->
<div class="mb-4">
    <label for="estado" class="block text-gray-700">Estado</label>
    <select name="estado" id="estado"
            class="mt-1 block w-full  border-green-500 rounded-md shadow-sm">
        <option value="activo" {{ old('estado', $producto->estado ?? '') == 'activo' ? 'selected' : '' }}>Activo</option>
        <option value="inactivo" {{ old('estado', $producto->estado ?? '') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
    </select>
</div>

<!-- Campo: Imagen del producto -->
<div class="mb-4">
    <label for="imagen" class="block text-gray-700">Imagen del producto</label>
    <input type="file" name="imagen" id="imagen"
           class="mt-1 block w-full  border-green-500 rounded-md shadow-sm"
           accept="image/*">

    <!-- Si ya existe una imagen, mostrarla -->
    @if(isset($producto) && $producto->imagen)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $producto->imagen) }}"
                 alt="{{ $producto->nombre }}"
                 class="max-w-[150px] max-h-[150px] object-contain rounded-md border">
        </div>
    @endif
</div>

<!-- Botón submit -->
<div class="flex justify-end mt-4">
    <a href="{{ route('producto.index') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">
       Cancelar
    </a>
    <button type="submit" 
            class="ml-2 bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
        Guardar
    </button>
</div>

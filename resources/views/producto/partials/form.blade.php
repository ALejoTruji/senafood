<div class="mb-4">
    <label for="nombre" class="block font-semibold">Nombre</label>
    <input type="text" name="nombre" id="nombre"
           value="{{ old('nombre', $producto->nombre ?? '') }}"
           class="w-full border rounded px-3 py-2">
    @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="descripcion" class="block font-semibold">Descripción</label>
    <textarea name="descripcion" id="descripcion" rows="3"
              class="w-full border rounded px-3 py-2">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
    @error('descripcion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="costo_unitario" class="block font-semibold">Costo Unitario</label>
    <input type="number" step="0.01" name="costo_unitario" id="costo_unitario"
           value="{{ old('costo_unitario', $producto->costo_unitario ?? '') }}"
           class="w-full border rounded px-3 py-2">
    @error('costo_unitario') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="stock" class="block font-semibold">Stock</label>
    <input type="number" name="stock" id="stock"
           value="{{ old('stock', $producto->stock ?? '') }}"
           class="w-full border rounded px-3 py-2">
    @error('stock') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="fecha_vencimiento" class="block font-semibold">Fecha de Vencimiento</label>
    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
           value="{{ old('fecha_vencimiento', isset($producto->fecha_vencimiento) ? $producto->fecha_vencimiento->format('Y-m-d') : '') }}"
           class="w-full border rounded px-3 py-2">
    @error('fecha_vencimiento') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="categoria" class="block font-semibold">Categoría</label>
    <input type="text" name="categoria" id="categoria"
           value="{{ old('categoria', $producto->categoria ?? '') }}"
           class="w-full border rounded px-3 py-2">
    @error('categoria') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="codigo_barras" class="block font-semibold">Código de Barras</label>
    <input type="text" name="codigo_barras" id="codigo_barras"
           value="{{ old('codigo_barras', $producto->codigo_barras ?? '') }}"
           class="w-full border rounded px-3 py-2">
    @error('codigo_barras') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="estado" class="block font-semibold">Estado</label>
    <select name="estado" id="estado" class="w-full border rounded px-3 py-2">
        <option value="activo" {{ old('estado', $producto->estado ?? '') == 'activo' ? 'selected' : '' }}>Activo</option>
        <option value="inactivo" {{ old('estado', $producto->estado ?? '') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
    </select>
    @error('estado') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>

<div class="flex justify-between">
    <a href="{{ route('producto.index') }}"
       class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
        Cancelar
    </a>
    <button type="submit"
            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        {{ isset($producto) ? 'Actualizar' : 'Crear' }}
    </button>
</div>

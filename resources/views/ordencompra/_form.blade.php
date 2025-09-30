@if(session('error'))
    <div class="bg-red-200 text-red-800 p-3 rounded mb-4 border border-red-400">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mb-4 border border-green-400">
        {{ session('success') }}
    </div>
@endif

@php
    $hoy = \Carbon\Carbon::today()->format('Y-m-d');
@endphp

<!-- Campo: Proveedor -->
<div class="mb-4">
    <label for="idProveedor" class="block text-gray-700">Proveedor</label>
    <select name="idProveedor" id="idProveedor"
            class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
        <option value="">Seleccione un proveedor</option>
        @foreach($proveedores as $proveedor)
            <option value="{{ $proveedor->idProveedor }}"
                {{ old('idProveedor', $ordencompra?->idProveedor) == $proveedor->idProveedor ? 'selected' : '' }}>
                {{ $proveedor->nombre }}
            </option>
        @endforeach
    </select>
    @error('idProveedor')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Campo: Producto -->
<div class="mb-4">
    <label for="idProducto" class="block text-gray-700">Producto</label> <!-- ✅ CORREGIDO -->
    <select name="idProducto" id="idProducto" <!-- ✅ CORREGIDO -->
            class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
        <option value="">Seleccione un producto</option>
        @foreach($productos as $producto)
            <option value="{{ $producto->idProducto }}"
                {{ old('idProducto', $ordencompra?->idProducto) == $producto->idProducto ? 'selected' : '' }}> <!-- ✅ CORREGIDO -->
                {{ $producto->nombre }}
            </option>
        @endforeach
    </select>
    @error('idProducto') <!-- ✅ CORREGIDO -->
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Campo: Fecha -->
<div class="mb-4">
    <label for="fecha" class="block text-gray-700">Fecha</label>
    <input type="date" name="fecha" id="fecha"
           min="{{ $hoy }}"
           value="{{ old('fecha', isset($ordencompra->fecha) ? \Carbon\Carbon::parse($ordencompra->fecha)->format('Y-m-d') : $hoy) }}"
           class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
    @error('fecha')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Campo: Estado -->
<div class="mb-4">
    <label for="estado" class="block text-gray-700">Estado</label>
    <select name="estado" id="estado"
            class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
        <option value="pendiente" {{ old('estado', $ordencompra?->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
        <option value="aprobado"  {{ old('estado', $ordencompra?->estado) == 'aprobado'  ? 'selected' : '' }}>Aprobado</option>
        <option value="cancelado" {{ old('estado', $ordencompra?->estado) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
    </select>
    @error('estado')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Campo: Cantidad -->
<div class="mb-4">
    <label for="cantidad" class="block text-gray-700">Cantidad</label>
    <input type="number" name="cantidad" id="cantidad" min="1"
           value="{{ old('cantidad', $ordencompra?->cantidad) }}"
           class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
    @error('cantidad')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Campo: Precio Unitario -->
<div class="mb-4">
    <label for="precioUnitario" class="block text-gray-700">Precio Unitario</label>
    <input type="number" step="0.01" name="precioUnitario" id="precioUnitario"
           value="{{ old('precioUnitario', $ordencompra?->precioUnitario) }}"
           class="mt-1 block w-full border-green-500 rounded-md shadow-sm">
    @error('precioUnitario')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Campo: Total (solo lectura) -->
<div class="mb-4">
    <label for="total" class="block text-gray-700">Total</label>
    <input type="number" step="0.01" name="total" id="total" readonly
           value="{{ old('total', $ordencompra?->total) }}"
           class="mt-1 block w-full border-green-500 rounded-md shadow-sm bg-gray-100 cursor-not-allowed">
</div>

<!-- Botones -->
<div class="flex justify-end mt-4">
    <a href="{{ route('ordencompra.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">
       Cancelar
    </a>
    <button type="submit"
            class="ml-2 bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
        Guardar
    </button>
</div>

<!-- Script para calcular total -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cantidadInput = document.getElementById('cantidad');
        const precioInput = document.getElementById('precioUnitario');
        const totalInput = document.getElementById('total');

        function calcularTotal() {
            const cantidad = parseFloat(cantidadInput.value) || 0;
            const precio = parseFloat(precioInput.value) || 0;
            totalInput.value = (cantidad * precio).toFixed(2);
        }

        cantidadInput.addEventListener('input', calcularTotal);
        precioInput.addEventListener('input', calcularTotal);

        // Ejecutar al cargar
        calcularTotal();
    });
</script>
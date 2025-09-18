<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4 text-green-600 leading-tight text-center">
            {{ __('Catálogo de Productos') }}
        </h2>
    </x-slot>

    <!-- Botón para abrir carrito -->
    <div class="text-center mb-6">
        <button onclick="toggleCarrito()" 
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">
            🛒 Ver carrito
    </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($productos as $producto)
            <div class="bg-white rounded-lg shadow p-4">
                <img src="{{ asset('storage/productos/' . $producto->imagen) }}"
                    alt="{{ $producto->nombre }}"
                    class="max-w-[200px] max-h-[200px] object-contain rounded-md mb-4 mx-auto">
                <h3 class="mt-2 font-bold text-lg">{{ $producto->nombre }}</h3>
                <p class="text-gray-600">{{ $producto->descripcion }}</p>
                <p class="text-green-700 font-semibold">$
                    {{ number_format($producto->costo_unitario, 0, ',', '.') }}
                </p>
                <p class="text-sm text-gray-500">Stock: {{ $producto->stock }}</p>

                <form action="{{ route('carrito.add') }}" method="POST">
                @csrf
                <input type="hidden" name="idProducto" value="{{ $producto->idProducto }}">
                <button type="submit" class="mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Añadir al carrito
                </button>
                </form>
            </div>
        @endforeach
    </div>
    <!-- Panel lateral del carrito -->
    <div id="sidebarCarrito" 
        class="fixed top-0 right-0 w-80 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50 overflow-y-auto">
        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-green-600">Mi carrito</h2>
            <button onclick="toggleCarrito()" class="text-gray-600 hover:text-red-500">✖</button>
        </div>
        @include('carrito.index')
    </div>
</div>

<!-- abrir/cerrar carrito -->
<script>
    function toggleCarrito() {
        const sidebar = document.getElementById('sidebarCarrito');
        sidebar.classList.toggle("translate-x-full");
        sidebar.classList.toggle("translate-x-0");
    }
</script>
</x-app-layout>

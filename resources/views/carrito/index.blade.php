{{-- Verifica si existe la variable de sesión "carrito" y que tenga al menos 1 producto --}}
@if (session('carrito') && count(session('carrito')) > 0)

    {{-- Lista de productos del carrito --}}
    <ul class="divide-y divide-gray-200">

        {{-- Inicializa variable $total en 0 --}}
        @php $total = 0; @endphp
        @foreach (session('carrito') as $id => $item)

            {{-- Calcula el subtotal del producto (precio * cantidad) --}}
            @php
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
            @endphp

            {{-- Cada producto se muestra en una fila con su info y botón de eliminar --}}
            <li class="flex justify-between items-center py-3">
                <div>
                    {{-- Nombre del producto --}}
                    <p class="font-bold text-gray-800">{{ $item['nombre'] }}</p>

                    {{-- Cantidad del producto --}}
                    <p class="text-sm text-gray-600">Cantidad: {{ $item['cantidad'] }}</p>

                    {{-- Subtotal de ese producto --}}
                    <p class="text-sm text-gray-600">
                        Subtotal: ${{ number_format($subtotal, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Botón para eliminar el producto del carrito --}}
                <form action="{{ route('carrito.remove') }}" method="POST">
                    @csrf
                    {{-- envía el ID del producto oculto --}}
                    <input type="hidden" name="idProducto" value="{{ $id }}">
                    <button type="submit" 
                        class="text-red-600 hover:text-red-800 text-sm font-semibold">
                        ✖
                    </button>
                </form>
            </li>
        @endforeach
    </ul>

    {{-- Sección inferior con el total general y el botón para vaciar todo el carrito --}}
    <div class="mt-4 border-t pt-4">
        {{-- Muestra el total acumulado de todos los productos --}}
        <p class="text-lg font-bold text-gray-800">
            Total: ${{ number_format($total, 0, ',', '.') }}
        </p>

        {{-- Botón para vaciar completamente el carrito --}}
        <form action="{{ route('carrito.clear') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" 
                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                Vaciar carrito
            </button>
        </form>
    </div>

{{-- muestra un mensaje --}}
@else
    <p class="text-gray-500 text-center">🛒 Tu carrito está vacío</p>
@endif
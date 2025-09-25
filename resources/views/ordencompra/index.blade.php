<x-app-layout>
    {{-- Encabezado --}}
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4 text-green-600 leading-tight text-center">
            {{ __('Orden de Compra') }}
        </h2>
    </x-slot>

    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                {{-- Título principal --}}
                <h1 class="text-2xl font-bold mb-4 text-green-600">Orden de Compra</h1>

                {{-- Botón para crear nueva orden --}}
                <p class="mb-4">
                    <a href="{{ route('ordencompra.create') }}" 
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Nueva Orden
                    </a>
                </p>

                {{-- Mensajes flash --}}
                @if (session('ok'))
                    <p class="text-green-600 font-semibold">{{ session('ok') }}</p>
                @endif

                {{-- Validación si existen órdenes --}}
                @if($ordencompra->count() > 0)
                    <table id="ordencompra" class="table-auto w-full border border-green-500">
                        <thead>
                            <tr class="bg-green-600 text-white">
                                <th class="px-4 py-2 border">Proveedor</th>
                                <th class="px-4 py-2 border">Fecha</th>
                                <th class="px-4 py-2 border">Estado</th>
                                <th class="px-4 py-2 border">Producto</th>
                                <th class="px-4 py-2 border">Cantidad</th>
                                <th class="px-4 py-2 border">Precio Unitario</th>
                                <th class="px-4 py-2 border">Total</th>
                                <th class="px-4 py-2 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ordencompra as $item)
                                <tr>
                                    <!-- Proveedor -->
                                    <td class="px-4 py-2 border">{{ $item->proveedor->nombre ?? 'N/A' }}</td>

                                    <!-- Fecha -->
                                    <td class="px-4 py-2 border">{{ $item->fecha }}</td>

                                    <!-- Estado -->
                                    <td class="px-4 py-2 border">{{ $item->estado }}</td>

                                    <!-- Producto -->
                                    <td class="px-4 py-2 border">{{ $item->producto->nombre ?? 'N/A' }}</td>

                                    <!-- Cantidad -->
                                    <td class="px-4 py-2 border">{{ $item->cantidad }}</td>

                                    <!-- Precio unitario -->
                                    <td class="px-4 py-2 border">{{ $item->precioUnitario }}</td>

                                    <!-- Total -->
                                    <td class="px-4 py-2 border">{{ $item->total }}</td>

                                    <!-- Acciones -->
                                    <td class="px-4 py-2 border text-center">
                                        <!-- Botón Editar -->
                                        <a href="{{ url('ordencompra/'.$item->id.'/edit') }}"
                                        class="bg-green-400 hover:bg-green-500 text-white font-semibold px-3 py-1 rounded-lg shadow">
                                        Modificar
                                        </a>
                                        <!-- Botón Eliminar -->
                                        <form action="{{ url('ordencompra/'.$item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold px-3 py-1 rounded-lg shadow">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600">No hay órdenes registradas.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Dependencias DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    {{-- Configuración DataTables --}}
    <script>
        $(function() {
            $('#ordencompra').DataTable({
                pageLength: 20,
                dom: 'Bfrtip',
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                },
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>
</x-app-layout>

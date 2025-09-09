<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4 text-green-600 leading-tight text-center">
            {{ __('Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-green-600">Productos</h1>

                @if($inventario->count() > 0)
                    <table id ="producto" class="table-auto w-full border border-green-300">
                        <thead>
                            <tr class="bg-green-600 text-white">
                                <th class="px-4 py-2 border">Nombre</th>
                                <th class="px-4 py-2 border">Id Producto</th>
                                <th class="px-4 py-2 border">Ubicacion</th>
                                <th class="px-4 py-2 border">Stock Total</th>
                                <th class="px-4 py-2 border">Valor Unitario</th>
                                <th class="px-4 py-2 border">Valor Total</th>
                                <th class="px-4 py-2 border">Capacidad Max</th>
                                <th class="px-4 py-2 border">Alerta Minimos</th>
                                <th class="px-4 py-2 border">Responsable</th>
                                <th class="px-4 py-2 border">Ultima Version</th>
                                <th class="px-4 py-2 border">Observacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventario as $item)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $item->nombre }}</td>
                                    <td class="px-4 py-2 border">{{ $item->idproducto }}</td>
                                    <td class="px-4 py-2 border">{{ $item->ubicacion }}</td>
                                    <td class="px-4 py-2 border">{{ $item->stockTotal }}</td>
                                    <td class="px-4 py-2 border">{{ $item->costouni }}</td>
                                    <td class="px-4 py-2 border">{{ $item->valor_total }}</td>
                                    <td class="px-4 py-2 border">{{ $item->capacidad_maxima }}</td>
                                    <td class="px-4 py-2 border">{{ $item->alerta_minimos }}</td>
                                    <td class="px-4 py-2 border">{{ $item->responsable }}</td>
                                    <td class="px-4 py-2 border">{{ $item->ultima_revision }}</td>
                                    <td class="px-4 py-2 border">{{ $item->observaciones }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600">No hay inventario registrados.</p>
                @endif

            </div>
        </div>
    </div>

    {{-- jQuery + DataTables (CDN) --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
    href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script>
        $(function() {
            $('#producto').DataTable({
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4 text-green-600 leading-tight text-center">
            {{ __('Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- 🔹 Encabezado con menú de informes -->
                <div class="flex justify-between items-center mb-6">
                    <!-- Menú de informes -->
                    <div class="relative">
                        <button id="informesBtn" 
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow flex items-center space-x-2">
                            <i class="fas fa-file-alt"></i>
                            <span>Informes</span>
                        </button>

                        <div id="informesMenu" 
                            class="hidden absolute mt-2 left-0 bg-white shadow-lg px-4 py-3 rounded-lg border border-gray-200 z-50">
                            <div class="flex space-x-6">
                                <button class="export-btn" data-type="copy" title="Copiar">
                                    <i class="fas fa-copy text-green-600 text-2xl"></i>
                                </button>
                                <button class="export-btn" data-type="csv" title="CSV">
                                    <i class="fas fa-file-csv text-green-600 text-2xl"></i>
                                </button>
                                <button class="export-btn" data-type="excel" title="Excel">
                                    <i class="fas fa-file-excel text-green-600 text-2xl"></i>
                                </button>
                                <button class="export-btn" data-type="pdf" title="PDF">
                                    <i class="fas fa-file-pdf text-green-600 text-2xl"></i>
                                </button>
                                <button class="export-btn" data-type="print" title="Imprimir">
                                    <i class="fas fa-print text-green-600 text-2xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @if($inventario->count() > 0)
                    <table id="inventario" class="table-auto w-full border border-green-300">
                        <thead>
                            <tr class="bg-green-600 text-white">
                                <th class="px-4 py-2 border">Nombre</th>
                                <th class="px-4 py-2 border">Id Producto</th>
                                <th class="px-4 py-2 border">Ubicación</th>
                                <th class="px-4 py-2 border">Stock Total</th>
                                <th class="px-4 py-2 border">Valor Unitario</th>
                                <th class="px-4 py-2 border">Valor Total</th>
                                <th class="px-4 py-2 border">Capacidad Máx</th>
                                <th class="px-4 py-2 border">Alerta Mínimos</th>
                                <th class="px-4 py-2 border">Responsable</th>
                                <th class="px-4 py-2 border">Última Revisión</th>
                                <th class="px-4 py-2 border">Observación</th>
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
                    <p class="text-gray-600">No hay inventario registrado.</p>
                @endif

            </div>
        </div>
    </div>

    {{-- jQuery + DataTables (CDN) --}}
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

    <script>
        $(function() {
            var table = $('#inventario').DataTable({
                pageLength: 20,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                }
            });

            // Toggle menú de informes
            $('#informesBtn').on('click', function() {
                $('#informesMenu').toggleClass('hidden');
            });

            // Exportar según ícono clickeado
            $('.export-btn').on('click', function() {
                var type = $(this).data('type');
                table.button('.buttons-' + type).trigger();
            });
        });
    </script>

    <style>
        /* Hover sobre íconos */
        #informesMenu button i {
            transition: transform 0.2s;
        }
        #informesMenu button i:hover {
            transform: scale(1.2);
        }

        /* Ocultar botones por defecto de DataTables */
        .dt-buttons {
            display: none !important;
        }
    </style>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

</x-app-layout>

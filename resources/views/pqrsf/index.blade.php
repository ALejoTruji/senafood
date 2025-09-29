<x-app-layout>
    <!-- Encabezado de la página -->
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-green-600 leading-tight text-center">
            Lista de PQRSF
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">

            <!-- Encabezado con botones -->
            <div class="flex justify-between items-center mb-6">
                <!-- Botón de informes con íconos -->
                <div class="relative">
                    <button id="informesBtn"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow flex items-center space-x-2">
                        <i class="fas fa-file-alt"></i>
                        <span>Informes</span>
                    </button>

                    <!-- Menú de íconos (horizontal) -->
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

                <!-- Botón crear PQRSF -->
                <a href="{{ route('pqrsf.create') }}"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg shadow">
                    + Nueva PQRSF
                </a>
            </div>

            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla fusionada -->
            @if($pqrsfs->count() > 0)
                <table id="pqrsf" class="table-auto w-full border border-green-300">
                    <thead>
                        <tr class="bg-green-600 text-white">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Tipo</th>
                            <th class="px-4 py-2 border">Descripción</th>
                            <th class="px-4 py-2 border">Estado</th>
                            <th class="px-4 py-2 border">Usuario</th>
                            <th class="px-4 py-2 border">Fecha Creación</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pqrsfs as $pqrsf)
                            <tr>
                                <td class="px-4 py-2 border">{{ $pqrsf->idPQRSF }}</td>
                                <td class="px-4 py-2 border">{{ $pqrsf->tipo }}</td>
                                <td class="px-4 py-2 border">{{ $pqrsf->descripcion }}</td>
                                <td class="px-4 py-2 border">{{ $pqrsf->estado }}</td>
                                <td class="px-4 py-2 border">{{ $pqrsf->usuario->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $pqrsf->create_at ? $pqrsf->create_at->format('d/m/Y H:i') : 'N/A' }}
                                </td>
                                <td class="px-4 py-2 border space-x-2 text-center">
                                    <!-- Botón Ver -->
                                    <a href="{{ route('pqrsf.show', $pqrsf->idPQRSF) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg shadow text-sm">
                                        Ver
                                    </a>

                                    <!-- Botón Editar -->
                                    <a href="{{ route('pqrsf.edit', $pqrsf->idPQRSF) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg shadow text-sm">
                                        Editar
                                    </a>

                                    <!-- Botón Eliminar -->
                                    <form action="{{ route('pqrsf.destroy', $pqrsf->idPQRSF) }}" method="POST" class="inline"
                                        onsubmit="return confirm('¿Eliminar este registro?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow text-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600">No hay PQRSF registradas</p>
            @endif
        </div>
    </div>

    <!-- DataTables + Botones -->
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

    <!-- Configuración de DataTables + Menú personalizado -->
    <script>
        $(function() {
            var table = $('#pqrsf').DataTable({
                pageLength: 20,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                }
            });

            // Mostrar/ocultar menú de informes
            $('#informesBtn').on('click', function() {
                $('#informesMenu').toggleClass('hidden');
            });

            // Exportar según ícono
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
        /* Ocultar botones originales de DataTables */
        .dt-buttons {
            display: none !important;
        }
    </style>

    <!-- Font Awesome para íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</x-app-layout>

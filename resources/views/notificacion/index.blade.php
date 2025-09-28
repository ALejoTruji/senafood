<x-app-layout>
    
    <!-- Slot para el encabezado -->
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-green-600 leading-tight text-center">
            {{ __('Notificaciones') }}
        </h2>
    </x-slot>

    <!-- Contenedor principal -->
    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Caja blanca con sombra -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Encabezado con botones -->
                <div class="flex justify-between items-center mb-6">
                    <!-- Botón de informes con íconos -->
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

                    <!-- Botón crear notificación -->
                    <a href="{{ route('notificacion.create') }}" 
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg shadow">
                        Nueva Notificación
                    </a>
                </div>

                <!-- Mensaje flash -->
                @if (session('success'))
                    <p class="text-green-600 font-semibold">{{ session('success') }}</p>
                @endif

                <!-- Tabla de notificaciones -->
                @if($notificaciones->count() > 0)
                    <table id="notificacion" class="table-auto w-full border border-green-300 mt-4">
                        <thead>
                            <tr class="bg-green-600 text-white">
                                <th class="px-4 py-2 border">Mensaje</th>
                                <th class="px-4 py-2 border">Fecha de envío</th>
                                <th class="px-4 py-2 border">Usuario</th>
                                <th class="px-4 py-2 border">Carrito</th>
                                <th class="px-4 py-2 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notificaciones as $item)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $item->mensaje }}</td>
                                    <td class="px-4 py-2 border">{{ $item->fecha_envio }}</td>
                                    <td class="px-4 py-2 border">{{ $item->usuario->name ?? 'Usuario no encontrado' }}</td>
                                    <td class="px-4 py-2 border">{{ $item->idCarrito }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <a href="{{ route('notificacion.edit', $item->idNotificacion) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg shadow">
                                           Editar
                                        </a>

                                        <form action="{{ route('notificacion.destroy', $item->idNotificacion) }}" 
                                            method="POST" 
                                            style="display:inline" 
                                            onsubmit="return confirm('¿Eliminar esta notificación?')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg shadow">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600">No hay notificaciones.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- jQuery + DataTables -->
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
    
    <!-- Configuración de DataTables -->
    <script>
        $(function() {
            var table = $('#notificacion').DataTable({
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

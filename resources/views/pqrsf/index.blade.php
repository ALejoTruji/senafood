<x-app-layout>
    <!-- Encabezado de la página -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de PQRSF
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Botón para crear una nueva PQRSF -->
        <a href="{{ route('pqrsf.create') }}"
        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
        + Nueva PQRSF
        </a>

        <div class="mt-6 bg-white shadow rounded p-4">
            <!-- Mensaje de éxito (se muestra si hay un flash en la sesión) -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla con ID para inicializar DataTables -->
            <table id="pqrsfTable" class="display nowrap stripe hover w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Se recorren las PQRSF enviadas desde el controlador -->
                    @foreach ($pqrsfs as $pqrsf)
                        <tr>
                            <td>{{ $pqrsf->idPQRSF }}</td>
                            <td>{{ $pqrsf->tipo }}</td>
                            <td>{{ $pqrsf->descripcion }}</td>
                            <td>{{ $pqrsf->estado }}</td>
                            <td>{{ $pqrsf->usuario->name ?? 'N/A' }}</td>
                            <td>{{ $pqrsf->create_at ? $pqrsf->create_at->format('d/m/Y H:i') : 'N/A' }}</td>
                            <td>
                                <!-- Boton ver -->
                                <a href="{{ route('pqrsf.show', $pqrsf->idPQRSF) }}" 
                                class="bg-blue-500 hover:bg-blue-700 px-2 py-1 text-white rounded">Ver</a>
                                <!-- Botón de edición -->
                                <a href="{{ route('pqrsf.edit', $pqrsf->idPQRSF) }}" 
                                class="bg-yellow-500 px-2 py-1 text-white rounded">Editar</a>
                                <!-- Botón de eliminación con confirmación -->
                                <form action="{{ route('pqrsf.destroy', $pqrsf->idPQRSF) }}" 
                                    method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('¿Eliminar?')" 
                                            class="bg-red-500 px-2 py-1 text-white rounded">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Estilos de DataTables y botones -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Librerías necesarias: jQuery + DataTables + extensiones de exportación -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Inicialización de DataTables -->
    <script>
        $(document).ready(function() {
            $('#pqrsfTable').DataTable({
                responsive: true,       // hace la tabla adaptable
                dom: 'Bfrtip',          // coloca los botones arriba y buscador a la derecha
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'], // botones de exportación
                language: {
                    // Traducción al español
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                }
            });
        });
    </script>

    <style>
        /* Estilo para el encabezado de la tabla */
        #pqrsfTable thead th {
            background-color: #16a34a; /* Verde */
            color: white;              /* Texto blanco */
            text-align: center;        /* Centrado */
        }

        /* Estilo para la columna Descripción (3ª columna) */
        #pqrsfTable td:nth-child(3),
        #pqrsfTable th:nth-child(3) {
            max-width: 300px;        /* Ancho máximo */
            white-space: normal;     /* Permite saltos de línea */
            word-wrap: break-word;   /* Rompe palabras largas */
            text-align: left;        /* Alinea el texto */
        }

        /* Ajuste general de celdas */
        #pqrsfTable td {
            vertical-align: top;     /* Alinea arriba el contenido */
            padding: 8px;            /* Espaciado interno */
        }

        /* Para tablas responsivas en pantallas pequeñas */
        div.dataTables_wrapper {
            width: 100%;
            overflow-x: auto;        /* Scroll horizontal si es necesario */
        }
    </style>

</x-app-layout>

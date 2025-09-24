<!-- Usamos el layout principal de Jetstream -->
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

                <!-- Título -->
                <h1 class="text-2xl font-bold mb-4 text-green-600">Listado de Notificaciones</h1>
                
                <!-- Botón crear -->
                <p>
                    <a href="{{ route('notificacion.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
                        Nueva Notificación
                    </a>
                </p>

                <!-- Mensaje flash -->
                @if (session('success'))
                    <p style="color:green">{{ session('success') }}</p>
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
                            <!-- Recorremos la colección de notificaciones -->
                            @foreach ($notificaciones as $item)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $item->mensaje }}</td>
                                    <td class="px-4 py-2 border">{{ $item->fecha_envio }}</td>
                                    <td class="px-4 py-2 border">{{ $item->idUsuario }}</td>
                                    <td class="px-4 py-2 border">{{ $item->idCarrito }}</td>
                                    <td class="px-4 py-2 border">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('notificacion.edit', $item->idNotificacion) }}" 
                                        class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>

                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('notificacion.destroy', $item->idNotificacion) }}" 
                                            method="POST" 
                                            style="display:inline" 
                                            onsubmit="return confirm('¿Eliminar esta notificación?')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-600 text-white px-2 py-1 rounded">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <!-- Si no hay registros -->
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
            $('#notificacion').DataTable({
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

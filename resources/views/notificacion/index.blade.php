<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4 text-green-600 leading-tight text-center">
            {{ __('Notificacion') }}
        </h2>
    </x-slot>

    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-green-600">Notificacion</h1>

                @if($notificacion->count() > 0)
                    <table id ="notificacion" class="table-auto w-full border border-green-300">
                        <thead>
                            <tr class="bg-green-600 text-white">
                                <th class="px-4 py-2 border">Mensage</th>
                                <th class="px-4 py-2 border">Fecha de envio</th>
                                <th class="px-4 py-2 border">Usuario</th>
                                <th class="px-4 py-2 border">Carrito</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notificacion as $item)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $item->mesage }}</td>
                                    <td class="px-4 py-2 border">{{ $item->fechaEnvio }}</td>
                                    <td class="px-4 py-2 border">{{ $item->idUsuario }}</td>
                                    <td class="px-4 py-2 border">{{ $item->idCarrito }}</td>
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

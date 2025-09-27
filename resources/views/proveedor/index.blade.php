<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4 text-green-600 leading-tight text-center">
            {{ __('Proveedor') }}
        </h2>
    </x-slot>

    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-green-600">Proveedor</h1>

            <p>
                <a href="{{ route('proveedor.create') }}" 
                class="bg-green-500 hover:bg-green-500 text-white font-semibold px-2 py-2 rounded-lg shadow">
                Añadir Proveedor
                </a>
            </p>

                @if($proveedor->count() > 0)
                    <table id ="proveedor" class="table-auto w-full border border-green-300">
                        <thead>
                            <tr class="bg-green-600 text-white">
                                <th class="px-4 py-2 border">Nombre</th>
                                <th class="px-4 py-2 border">Contacto</th>
                                <th class="px-4 py-2 border">Telefono</th>
                                <th class="px-4 py-2 border">Direccion</th>
                                <th class="px-4 py-2 border">NIT</th>
                                <th class="px-4 py-2 border">Modificar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proveedor as $item)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $item->nombre }}</td>
                                    <td class="px-4 py-2 border">{{ $item->contacto }}</td>
                                    <td class="px-4 py-2 border">{{ $item->telefono }}</td>
                                    <td class="px-4 py-2 border">{{ $item->direccion }}</td>
                                    <td class="px-4 py-2 border">{{ $item->NIT }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <a href="{{ route('proveedor.edit', $item->idProveedor) }}"
                                        class="bg-green-400 hover:bg-green-500 text-white font-semibold px-3 py-1 rounded-lg shadow">
                                        Modificar
                                        </a>

                                        <form action="{{ route('proveedor.destroy', $item->idProveedor) }}" method="POST" style="display:inline"
                                            onsubmit="return confirm('¿Eliminar este Proveedor?')">
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
                    <p class="text-gray-600">Proveedor no registrado</p>
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
            $('#proveedor').DataTable({
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

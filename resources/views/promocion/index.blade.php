<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Promociones') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <a href="{{ route('Promocion.create') }}" class="btn btn-primary mb-3">Nueva Promoción</a>

        <table class="table table-bordered w-full text-center">
            <thead class="bg-gray-200">
                <tr>
                    <th>descripcion</th>
                    <th>Descuento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($promociones as $promo)
                    <tr>
                        <td>{{ $promo->descripcion}}</td>
                        <td>{{ $promo->descuento }}%</td>
                        <td>{{ $promo->fecha_inicio }} - {{ $promo->fecha_fin }}</td>
                        <td>
                            <a href="{{ route('Promocion.edit', $promo) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('Promocion.destroy', $promo) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro deseas eliminar esta promoción?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4">No hay promociones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>

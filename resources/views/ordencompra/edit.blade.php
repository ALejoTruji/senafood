<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-green-600 text-center">Editar Orden</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded">
        <form action="{{ route('ordencompra.update', $ordencompra->idOrden) }}" method="POST">
            @csrf
            @method('PUT')
            @include('ordencompra._form', ['ordencompra' => $ordencompra])
        </form>
        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-3 rounded mb-4 border border-red-400">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-app-layout>

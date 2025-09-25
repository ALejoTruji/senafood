<form action="{{ route('ordencompra.update', $ordencompra) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    @include('ordencompra._form', [
        'ordencompra' => $ordencompra,
        'proveedores' => $proveedores,
        'productos' => $productos,
    ])

    <div class="pt-4 flex gap-3">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
        <a href="{{ route('ordencompra.index') }}" class="px-4 py-2 border rounded">Cancelar</a>
    </div>
</form>

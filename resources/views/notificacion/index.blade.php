<x-app-layout>
    <!-- 🔹 Encabezado de la página -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Notificaciones
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenedor -->
            <div class="bg-white shadow-xl sm:rounded-lg p-6">

                <!-- Si no hay notificaciones -->
                @if($notificaciones->isEmpty())
                    <p>No tienes notificaciones.</p>
                @else
                    <!-- Lista de notificaciones -->
                    <ul>
                        @foreach($notificaciones as $n)
                            <li class="flex justify-between items-center border-b py-2 {{ $n->leida ? 'text-gray-500' : 'text-black font-bold' }}">
                                
                                <!-- Texto de la notificación -->
                                <span>{{ $n->mensaje }}</span>

                                <!-- Acciones -->
                                <div class="flex space-x-2">
                                    <!-- 🔵 Botón para ver la notificación -->
                                    <a href="{{ route('notificacion.show', $n->idNotificacion) }}" 
                                    class="bg-blue-500 hover:bg-blue-700 px-2 py-1 text-white rounded">
                                        Ver
                                    </a>

                                    <!-- ✅ Botón para marcar como leída -->
                                    @if(!$n->leida)
                                        <form action="{{ route('notificaciones.leida', $n->idNotificacion) }}" method="POST">
                                            @csrf
                                            <button type="submit" 
                                                class="bg-green-500 hover:bg-green-700 px-2 py-1 text-white rounded">
                                                Marcar como leída
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

<div class="space-y-4"> <!-- Contenedor principal con espacio vertical entre elementos -->

    <!--Campo: Mensaje -->
    <div>
        <label for="mensaje" class="block text-sm font-medium">Mensaje</label>
        <input type="text" name="mensaje" id="mensaje"
            class="w-full border rounded p-2"
            {{-- Se asigna el valor anterior si hubo error, o el valor de la notificación si existe --}}
            value="{{ old('mensaje', $notificacion->mensaje ?? '') }}">
        <!--Si hay errores de validación, se muestran en rojo debajo del input -->
        @error('mensaje')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <!-- Campo: Fecha de envío -->
    <div>
        <label for="fecha_envio" class="block text-sm font-medium">Fecha de envío</label>
        <input type="datetime-local" name="fecha_envio" id="fecha_envio"
            class="w-full border rounded p-2"
            {{-- Si existe fecha en $notificacion, se formatea al formato de datetime-local --}}
            value="{{ old('fecha_envio', isset($notificacion->fecha_envio) ? $notificacion->fecha_envio->format('Y-m-d\TH:i') : '') }}">
        @error('fecha_envio')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <!--Campo: Usuario (relacionado con notificación) -->
    <div>
        <label for="idUsuario" class="block text-sm font-medium">Usuario</label>
        <input type="number" name="idUsuario" id="idUsuario"
            class="w-full border rounded p-2"
            value="{{ old('idUsuario', $notificacion->idUsuario ?? '') }}">
        @error('idUsuario')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <!-- Campo: Carrito (relacionado con notificación) -->
    <div>
        <label for="idCarrito" class="block text-sm font-medium">Carrito</label>
        <input type="number" name="idCarrito" id="idCarrito"
            class="w-full border rounded p-2"
            value="{{ old('idCarrito', $notificacion->idCarrito ?? '') }}">
        @error('idCarrito')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <!-- Campo: Leída (checkbox) -->
    <div>
        <label class="inline-flex items-center">
            {{-- Se marca el checkbox si la notificación está leída --}}
            <input type="checkbox" name="leida" value="1"
                {{ old('leida', $notificacion->leida ?? false) ? 'checked' : '' }}>
            <span class="ml-2">Leída</span>
        </label>
        @error('leida')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

</div>

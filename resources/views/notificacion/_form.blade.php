<div class="space-y-4"> <!-- Contenedor principal con espacio vertical entre elementos -->

    <!-- Campo: Mensaje -->
    <div>
        <label for="mensaje" class="block text-sm font-medium">Mensaje</label>
        <input type="text" name="mensaje" id="mensaje"
            class="w-full border rounded p-2"
            value="{{ old('mensaje', $notificacion->mensaje ?? '') }}">
        @error('mensaje')
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
            <input type="checkbox" name="leida" value="1"
                {{ old('leida', $notificacion->leida ?? false) ? 'checked' : '' }}>
            <span class="ml-2">Leída</span>
        </label>
        @error('leida')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

</div>

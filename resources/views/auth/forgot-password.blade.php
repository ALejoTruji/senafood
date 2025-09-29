<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente indícanos tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña y podrás elegir una nueva.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                @if ($value === 'We have emailed your password reset link.')
                    Te hemos enviado el enlace para restablecer tu contraseña por correo electrónico.
                @else
                    {{ $value }}
                @endif
            </div>
        @endsession

        @if ($errors->any())
            <div class="mb-4">
                <div class="font-medium text-red-600">
                    ¡Ups! Algo salió mal.
                </div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>
                            @if ($error == "We can't find a user with that email address.")
                                No encontramos un usuario con esa dirección de correo electrónico.
                            @else
                                {{ $error }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="bg-orange-500 hover:bg-orange-600 text-white">
                    {{ __('Enlace para restablecer contraseña') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

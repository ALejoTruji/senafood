<nav x-data="{ open: false }" class="bg-green-550 border-b border-gray-100">
    <!-- Contenedor principal de la barra de navegación -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Flex organiza los elementos de la navbar -->
        <div class="flex justify-between h-20 items-center">
            <div class="flex">
                <!--LOGO -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/senafood_logo.jpeg') }}" alt="Senafood Logo" style="height: 70px; width: auto;" />
                    </a>
                </div>

                <!--LINKS PRINCIPALES (Dash, Prod, Inve, Cata) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Enlace al Dashboard -->
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                
                <!-- Enlace a Productos -->
                <div class="flex justify-center flex-1">
                    <x-nav-link href="{{ route('producto.index') }}" :active="request()->routeIs('producto.*')">
                        {{ __('Productos') }}
                    </x-nav-link>
                </div>

                <!-- Enlace a Inventario -->
                <div class="flex justify-center flex-1">
                    <x-nav-link href="{{ route('inventario.index') }}" :active="request()->routeIs('inventario.*')">
                        {{ __('Inventario') }}
                    </x-nav-link>
                </div>

                <!-- Nuevo enlace al Catálogo -->
                <div class="flex justify-center flex-1">
                    <x-nav-link href="{{ route('catalogo') }}" :active="request()->routeIs('catalogo')">
                        {{ __('Catálogo') }}
                    </x-nav-link>
                </div>

                <!-- Enlace al Proveedor -->
                <div class="flex justify-center flex-1">
                    <x-nav-link href="{{ route('proveedor.index') }}" :active="request()->routeIs('proveedor.*')">
                        {{ __('Proveedor') }}
                    </x-nav-link>
                </div>

                <!--Enlase Orden de compra-->
                <div class="flex justify-center flex-1">
                    <x-nav-link href="{{ route('ordencompra.index') }}" :active="request()->routeIs('ordencompra.*')">
                        {{ __('O C') }}
                    </x-nav-link>
                </div>

                <!--Enlase Notificacion-->
                <div class="flex justify-center flex-1">
                    <x-nav-link href="{{ route('notificacion.index') }}" :active="request()->routeIs('notificacion.*')">
                        {{ __('Notificacion') }}
                    </x-nav-link>
                </div>

                <!--Enlace PQRSF-->
                <div class="flex justify-center flex-1">
                    <x-nav-link href="{{ route('pqrsf.index') }}" :active="request()->routeIs('pqrsf.*')">
                        {{ __('PQRSF') }}
                    </x-nav-link>
                </div>
            </div>
            
            <!-- 🔹 SECCIÓN DERECHA DE LA NAVBAR (equipos, usuario, etc.) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <!-- 🔔 Notificaciones -->
                <div class="ms-3 relative">
                    <a href="{{ route('notificacion.index') }}" class="relative flex items-center">
                        <!-- Icono campana -->
                        <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-7 h-7 text-yellow-400 animate-bounce">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 18.75a1.5 1.5 0 01-3 0m9-3.75V11.1a6.375 6.375 0 00-5.22-6.3 
                                2.25 2.25 0 10-4.56 0 6.375 6.375 0 00-5.22 6.3v3.9l-1.5 
                                1.5h18l-1.5-1.5z" />
                        </svg>


                        <!-- Contador rojo de notificaciones no leídas -->
                        @php
                            $unread = \App\Models\Notificacion::where('idUsuario', Auth::id())
                                        ->where('leida', false)
                                        ->count();
                        @endphp
                        @if($unread > 0)
                            <span class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1">
                                {{ $unread }}
                            </span>
                        @endif
                    </a>
                </div>

                <!-- Dropdown de Usuario -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <!--Trigger del dropdown (foto o nombre del usuario) -->
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <!-- Si tiene foto de perfil -->
                                <button class="flex text-sm border-2 ...">
                                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <!-- Si no tiene foto, mostrar su nombre -->
                                <span class="inline-flex rounded-md">
                                    <button type="button" 
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white 
                                                hover:text-gray-700 focus:outline-none focus:bg-gray-50 
                                                active:bg-gray-50 transition ease-in-out duration-150">

                                        {{ Auth::user()->name }}

                                <!-- Icono de flecha -->
                                            <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" 
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" 
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                            </button>
                                </span>
                            @endif
                        </x-slot>

                        <!-- Contenido del dropdown -->
                        <x-slot name="content">
                            <!-- Gestión de la cuenta -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <!-- Enlace al perfil -->
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Enlace a tokens API si Jetstream lo permite -->
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- 🔹 Botón "Hamburger" para dispositivos pequeños -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center ...">
                    <!-- Icono del menú -->
                    <svg class="size-6" ...>
                        <path :class="{'hidden': open, 'inline-flex': ! open }" ... />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" ... />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- 🔹 Menú Responsive (para móviles) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        ...
    </div>
</nav>

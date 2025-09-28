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
                <x-nav-link
                    href="{{ route('dashboard') }}"
                    :active="request()->routeIs('dashboard')"
                    class="text-xl text-green-700 hover:text-orange-700 font-semibold transition-transform duration-200 transform hover:scale-200"
                    active-class="bg-green-200 text-green-900 rounded-md px-3 py-2">
                    {{ __('Dashboard') }}
                </x-nav-link>
                
                <!-- Enlace a Productos -->
                <x-nav-link
                    href="{{ route('producto.index') }}"
                    :active="request()->routeIs('producto.*')"
                    class="text-xl text-green-700 hover:text-orange-700 font-semibold transition-transform duration-200 transform hover:scale-200"
                    active-class="bg-green-200 text-green-900 rounded-md px-3 py-2">
                    {{ __('Productos') }}
                </x-nav-link>

                <!-- Enlace al Catálogo -->
                <x-nav-link
                    href="{{ route('catalogo') }}"
                    :active="request()->routeIs('catalogo')"
                    class="text-xl text-green-700 hover:text-orange-700 font-semibold transition-transform duration-200 transform hover:scale-200"
                    active-class="bg-green-200 text-green-900 rounded-md px-3 py-2"
                >
                    {{ __('Catálogo') }}
                </x-nav-link>

                <!-- Enlace a Inventario -->
                <x-nav-link
                    href="{{ route('inventario.index') }}"
                    :active="request()->routeIs('inventario.*')"
                    class="text-xl text-green-700 hover:text-orange-700 font-semibold transition-transform duration-200 transform hover:scale-200"
                    active-class="bg-green-200 text-green-900 rounded-md px-3 py-2"
                >
                    {{ __('Inventario') }}
                </x-nav-link>

                <!-- Enlace al Proveedor -->
                <x-nav-link
                    href="{{ route('proveedor.index') }}"
                    :active="request()->routeIs('proveedor.*')"
                    class="text-xl text-green-700 hover:text-orange-700 font-semibold transition-transform duration-200 transform hover:scale-200"
                    active-class="bg-green-200 text-green-900 rounded-md px-3 py-2"
                >
                    {{ __('Proveedor') }}
                </x-nav-link>

                <!-- Enlace a Orden de compra -->
                <x-nav-link
                    href="{{ route('ordencompra.index') }}"
                    :active="request()->routeIs('ordencompra.*')"
                    class="text-xl text-green-700 hover:text-orange-700 font-semibold transition-transform duration-200 transform hover:scale-200"
                    active-class="bg-green-200 text-green-900 rounded-md px-3 py-2"
                >
                    {{ __('O C') }}
                </x-nav-link>

                <!-- Enlace a Notificación -->
                <x-nav-link
                    href="{{ route('notificacion.index') }}"
                    :active="request()->routeIs('notificacion.*')"
                    class="text-xl text-green-700 hover:text-orange-700 font-semibold transition-transform duration-200 transform hover:scale-200"
                    active-class="bg-green-200 text-green-900 rounded-md px-3 py-2"
                >
                    {{ __('Notificación') }}
                </x-nav-link>

                <!--Enlace PQRSF-->
                <x-nav-link
                    href="{{ route('pqrsf.index') }}"
                    :active="request()->routeIs('pqrsf.*')"
                    class="text-xl text-green-700 hover:text-orange-700 font-semibold transition-transform duration-200 transform hover:scale-200"
                    active-class="bg-green-200 text-green-900 rounded-md px-3 py-2"
                >
                    {{ __('PQRSF') }}
                </x-nav-link>

            <!-- 🔹 SECCIÓN DERECHA DE LA NAVBAR (equipos, usuario, etc.) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!--Dropdown de Equipos () -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <!-- Botón para mostrar el nombre del equipo actual -->
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 ...">
                                        {{ Auth::user()->currentTeam->name }}

                                        <!-- Icono de flecha hacia abajo -->
                                        <svg class="ms-2 -me-0.5 size-4" ...>
                                            <path ... />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <!--Contenido del menú de equipos -->
                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Gestión del equipo -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Configuración del equipo -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    <!-- Crear un nuevo equipo (si el usuario tiene permisos) -->
                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Cambiar de equipo si el usuario pertenece a más de uno -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>
                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

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
                            <div class="block px-6 py-2 text-l text-green-600 text-center">
                                {{ __('Gestionar cuenta') }}
                            </div>

                            <!-- Enlace al perfil -->
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
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
                                    {{ __('Cerrar sesion') }}
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
        <div class="pt-2 pb-3 space-y-1">

            <!-- Links del menú responsive -->
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Enlace al Productos -->
            <x-responsive-nav-link href="{{ route('producto.index') }}" :active="request()->routeIs('producto.*')">
                {{ __('Productos') }}
            </x-responsive-nav-link>

            <!-- Enlace al catálogo -->
            <x-responsive-nav-link href="{{ route('catalogo') }}" :active="request()->routeIs('catalogo')">
                {{ __('Catálogo') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('inventario.index') }}" :active="request()->routeIs('inventario.*')">
                {{ __('Inventario') }}
            </x-responsive-nav-link>

            <!-- Nuevo enlace al Proveedor en responsive -->
            <x-responsive-nav-link href="{{ route('proveedor.index') }}" :active="request()->routeIs('proveedor.*')">
                {{ __('Proveedor') }}
            </x-responsive-nav-link>

            <!-- Nuevo enlace al Proveedor en responsive -->
            <x-responsive-nav-link href="{{ route('notificacion.index') }}" :active="request()->routeIs('notificacion.*')">
                {{ __('Notificacion') }}
            </x-responsive-nav-link>

            <!-- Enlace PQRSF en responsive -->
            <x-responsive-nav-link href="{{ route('pqrsf.index') }}" :active="request()->routeIs('pqrsf.*')">
                {{ __('PQRSF') }}
            </x-responsive-nav-link>

            <!-- Nuevo enlace al Proveedor en responsive -->
            <x-responsive-nav-link href="{{ route('ordencompra.index') }}" :active="request()->routeIs('ordencompra.*')">
                {{ __('O C') }}
            </x-responsive-nav-link>
        </div>

        <!-- Opciones de usuario en responsive -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <!-- Foto de perfil -->
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <!-- Nombre y email del usuario -->
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <!-- Links de gestión de cuenta en responsive -->
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Gestión de equipos en responsive -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Configuración de equipo -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    <!-- Crear nuevo equipo -->
                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Cambiar de equipo -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>
                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>

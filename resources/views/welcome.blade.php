<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SenaFOOD</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Animación suave para cambio de banners */
        .fade {
            transition: opacity 0.5s ease-in-out;
        }

        .banner-image {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            object-fit: cover;
            z-index: -1;
            filter: brightness(0.6);
        }
    </style>
</head>
<body class="font-sans antialiased text-white flex flex-col min-h-screen">

    <!-- ===== Header (Solo Banner y Logo) ===== -->
    <header class="relative h-[60vh] w-full">

        <!-- Banner dinámico como fondo -->
        <img id="banner" src="{{ asset('images/banner1.png') }}" alt="Banner" class="banner-image fade">

        <!-- Logo en la esquina superior derecha -->
        <div class="absolute top-4 right-6 z-10">
            <img src="{{ asset('images/senafood_logo.png') }}" alt="Logo SenaFOOD" class="w-32 drop-shadow-lg">
        </div>
    </header>

<!-- ===== Sección Intermedia (Botones de ingreso) ===== -->
<main class="bg-gray-100 text-gray-900 py-16 px-4 text-center flex flex-col items-center justify-center flex-grow space-y-6">

    <!-- Título centrado en verde -->
    <h1 class="text-4xl font-bold text-green-700 drop-shadow-md">Bienvenido a SenaFOOD</h1>

    <!-- Subtítulo -->
    <p class="text-lg text-gray-700 max-w-xl">Explora la variedad y el sabor optimizando tu tiempo.</p>

    <!-- Botones de ingreso -->
    @if (Route::has('login'))
        <div class="space-x-4 mt-4">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="bg-green-600 hover:bg-orange-500 text-white font-semibold py-2 px-6 rounded shadow transition">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="bg-green-600 hover:bg-orange-500 text-white font-semibold py-2 px-6 rounded shadow transition">
                    Ingresar
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="bg-green-600 hover:bg-orange-500 text-white font-semibold py-2 px-6 rounded shadow transition">
                        Registrar
                    </a>
                @endif
            @endauth
        </div>
    @endif
</main>

    <!-- ===== Footer ===== -->
    <footer class="bg-orange-500 text-white py-4 text-center text-lg">
        <p>&copy; {{ date('Y') }} SenaFOOD - Todos los derechos reservados.</p>
    </footer>

    <!-- Banner rotativo -->
    <script>
        const banner = document.getElementById('banner');
        let current = 1;
        const totalImages = 9;

        setInterval(() => {
            current = (current % totalImages) + 1;
            banner.classList.add('opacity-0');
            setTimeout(() => {
                banner.src = `{{ asset('images') }}/banner${current}.png`;
                banner.classList.remove('opacity-0');
            }, 300);
        }, 3000);
    </script>

</body>
</html>

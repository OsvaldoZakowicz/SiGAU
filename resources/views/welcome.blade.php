<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SiGAU - Welcome</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialiased">
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex justify-center items-center space-x-8 sm:-my-px sm:ml-10 text-gray-600">
                    <h1>SiGAU</h1>
                </div>
                <!-- Navigation Links -->
                @if (Route::has('login'))
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                        {{-- si estoy en 'welcome' y autenticado --}}
                        @auth
                            @can('ver-pagina-estudiante')
                                <x-nav-link :href="route('student')" :active="request()->routeIs('student')">
                                    {{ __('Students')}}
                                </x-nav-link>
                            @endcan
                            @can('ver-pagina-dashboard')
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            @endcan
                        @else
                        {{-- si estoy en 'welcome' sin autenticar --}}
                            <x-nav-link :href="route('login')">
                                <i class="fa-solid fa-arrow-right-to-bracket mr-1"></i>
                                <span>{{ __('Log in') }}</span>
                            </x-nav-link>
                            @if (Route::has('register'))
                                <x-nav-link :href="route('register')">
                                    <i class="fa-solid fa-user-pen mr-1"></i>
                                    <span>{{ __('Register') }}</span>
                                </x-nav-link>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>
    <main>

    </main>
</body>

</html>

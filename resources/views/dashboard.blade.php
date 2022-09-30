<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- vista dashboard de administracion -->
    <div class="min-h-screen bg-zinc-100">
        <!-- navegacion -->
        @include('layouts.navigation')
        <!-- aside + main -->
        <div class="w-100vw h-screen flex flex-row">
            <aside class="flex-none w-1/6 p-2 bg-zinc-500 border-r-2 border-zinc-300">
                <h2 class="uppercase text-xs text-zinc-100">Secciones Principales</h2>
                <!-- lista de enlaces de navegacion -->
                <!-- BECA -->
                <div class="m-2">
                    <x-aside-dropdown align="left" width="48">
                        <!-- slot trigger contiene el boton que dispara el dropdown -->
                        <x-slot name="trigger">
                            <x-aside-dropdown-button>
                                <div class="w-full flex flex-row items-center justify-start">
                                    <div class="w-7 h-full flex items-center justify-center">
                                        <i class="fa-solid fa-clipboard-check"></i>
                                    </div>
                                    <span>Beca</span>
                                </div>
                            </x-aside-dropdown-button>
                        </x-slot>
                        <!-- slot content, mostrara los enlaces del dropdown -->
                        <x-slot name="content">
                            <!-- enlace dropdown -->
                            <x-aside-dropdown-link :href="route('dashboard')">
                                Opcion
                            </x-aside-dropdown-link>
                        </x-slot>
                    </x-aside-dropdown>
                </div>
                <!-- BECADOS -->
                <div class="m-2">
                    <x-aside-dropdown align="left" width="48">
                        <!-- slot trigger contiene el boton que dispara el dropdown -->
                        <x-slot name="trigger">
                            <x-aside-dropdown-button>
                                <div class="w-full flex flex-row items-center justify-start">
                                    <div class="w-7 h-full flex items-center justify-center">
                                        <i class="fa-solid fa-people-group"></i>
                                    </div>
                                    <span>Becados</span>
                                </div>
                            </x-aside-dropdown-button>
                        </x-slot>
                        <!-- slot content, mostrara los enlaces del dropdown -->
                        <x-slot name="content">
                            <!-- enlace dropdown -->
                            <x-aside-dropdown-link :href="route('dashboard')">
                                Opcion
                            </x-aside-dropdown-link>
                        </x-slot>
                    </x-aside-dropdown>
                </div>
                <!-- CASAS -->
                <div class="m-2">
                    <x-aside-dropdown align="left" width="48">
                        <!-- slot trigger contiene el boton que dispara el dropdown -->
                        <x-slot name="trigger">
                            <x-aside-dropdown-button>
                                <div class="w-full flex flex-row items-center justify-start">
                                    <div class="w-7 h-full flex items-center justify-center">
                                        <i class="fa-solid fa-house-user"></i>
                                    </div>
                                    <span>Casas</span>
                                </div>
                            </x-aside-dropdown-button>
                        </x-slot>
                        <!-- slot content, mostrara los enlaces del dropdown -->
                        <x-slot name="content">
                            <!-- enlace dropdown -->
                            <x-aside-dropdown-link :href="route('dashboard')">
                                Opcion
                            </x-aside-dropdown-link>
                        </x-slot>
                    </x-aside-dropdown>
                </div>
                <!-- PLANIFICACIONES -->
                <div class="m-2">
                    <x-aside-dropdown align="left" width="48">
                        <!-- slot trigger contiene el boton que dispara el dropdown -->
                        <x-slot name="trigger">
                            <x-aside-dropdown-button>
                                <div class="w-full flex flex-row items-center justify-start">
                                    <div class="w-7 h-full flex items-center justify-center">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </div>
                                    <span>Planificaciones</span>
                                </div>
                            </x-aside-dropdown-button>
                        </x-slot>
                        <!-- slot content, mostrara los enlaces del dropdown -->
                        <x-slot name="content">
                            <!-- enlace dropdown -->
                            <x-aside-dropdown-link :href="route('dashboard')">
                                Opcion
                            </x-aside-dropdown-link>
                        </x-slot>
                    </x-aside-dropdown>
                </div>
                <!-- MANTENIMIENTO -->
                <div class="m-2">
                    <x-aside-dropdown align="left" width="48">
                        <!-- slot trigger contiene el boton que dispara el dropdown -->
                        <x-slot name="trigger">
                            <button
                                class="w-full flex items-center justify-between text-md font-medium text-gray-800 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div class="w-full flex flex-row items-center justify-start">
                                    <div class="w-7 h-full flex items-center justify-center">
                                        <i class="fa-solid fa-screwdriver-wrench"></i>
                                    </div>
                                    <span>Mantenimiento</span>
                                </div>
                                <div class="ml-1">
                                    <i class="fa-solid fa-caret-down"></i>
                                </div>
                            </button>
                        </x-slot>
                        <!-- slot content, mostrara los enlaces del dropdown -->
                        <x-slot name="content">
                            <!-- enlace dropdown -->
                            <x-aside-dropdown-link :href="route('dashboard')">
                                Opcion
                            </x-aside-dropdown-link>
                        </x-slot>
                    </x-aside-dropdown>
                </div>
                <h2 class="uppercase text-xs text-zinc-100">Configuraciones</h2>
                <!-- USUARIOS -->
                <div class="m-2">
                    <x-aside-dropdown align="left" width="48">
                        <!-- slot trigger contiene el boton que dispara el dropdown -->
                        <x-slot name="trigger">
                            <x-aside-dropdown-button>
                                <div class="w-full flex flex-row items-center justify-start">
                                    <div class="w-7 h-full flex items-center justify-center">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <span>Usuarios</span>
                                </div>
                            </x-aside-dropdown-button>
                        </x-slot>
                        <!-- slot content, mostrara los enlaces del dropdown -->
                        <x-slot name="content">
                            <!-- enlace usuarios -->
                            <x-aside-dropdown-link :href="route('users.index')">
                                <div class="w-full flex flex-row items-center justify-start">
                                    <div class="w-7 h-full flex items-center justify-center">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <span>Ver Usuarios</span>
                                </div>
                            </x-aside-dropdown-link>
                            <!-- enlace roles -->
                            <x-aside-dropdown-link :href="route('roles.index')">
                                <div class="w-full flex flex-row items-center justify-start">
                                    <div class="w-7 h-full flex items-center justify-center">
                                        <i class="fa-solid fa-user-shield"></i>
                                    </div>
                                    <span>Ver Roles</span>
                                </div>
                            </x-aside-dropdown-link>
                        </x-slot>
                    </x-aside-dropdown>
                </div>
                <!-- AUDITORIA -->
                <div class="m-2">
                    <x-aside-dropdown align="left" width="48">
                        <!-- slot trigger contiene el boton que dispara el dropdown -->
                        <x-slot name="trigger">
                            <x-aside-dropdown-button>
                                <div class="w-full flex flex-row items-center justify-start">
                                    <div class="w-7 h-full flex items-center justify-center">
                                        <i class="fa-solid fa-scale-balanced"></i>
                                    </div>
                                    <span>Auditoria</span>
                                </div>
                            </x-aside-dropdown-button>
                        </x-slot>
                        <!-- slot content, mostrara los enlaces del dropdown -->
                        <x-slot name="content">
                            <!-- enlace dropdown -->
                            <x-aside-dropdown-link :href="route('dashboard')">
                                Opcion
                            </x-aside-dropdown-link>
                        </x-slot>
                    </x-aside-dropdown>
                </div>
                <!-- PARAMETROS -->
                <div class="m-2">
                    <x-aside-dropdown align="left" width="48">
                        <!-- slot trigger contiene el boton que dispara el dropdown -->
                        <x-slot name="trigger">
                            <x-aside-dropdown-button>
                                <div class="w-full flex flex-row items-center justify-start">
                                    <div class="w-7 h-full flex items-center justify-center">
                                        <i class="fa-solid fa-gear"></i>
                                    </div>
                                    <span>Parametros</span>
                                </div>
                            </x-aside-dropdown-button>
                        </x-slot>
                        <!-- slot content, mostrara los enlaces del dropdown -->
                        <x-slot name="content">
                            <!-- enlace dropdown -->
                            <x-aside-dropdown-link :href="route('dashboard')">
                                Opcion
                            </x-aside-dropdown-link>
                        </x-slot>
                    </x-aside-dropdown>
                </div>
            </aside>
            <main class="flex-initial w-5/6 bg-white border-gray-200">
                <!-- contenido dinamico -->
                @yield('dashboard-content')
            </main>
        </div>
    </div>
</body>
</html>
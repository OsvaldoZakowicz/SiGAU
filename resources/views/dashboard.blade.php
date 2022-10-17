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

    {{-- aonfiguración para alpine --}}
    {{-- impide una carga prematura de html antes que alpine se inicie --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>

</head>

<body class="font-sans antialiased">
    {{-- vista dashboard de administracion --}}
    <div class="min-h-screen bg-zinc-100">
        {{-- navegacion --}}
        @include('layouts.navigation')
        {{-- aside + main --}}
        <div class="w-100vw h-screen flex flex-row">
            {{-- aside cambia de tamaño --}}
            
            <aside x-cloak x-data="{ toggleAside: false }" x-bind:class="!toggleAside ? 'w-16 p-2 bg-zinc-400 border-r-2 border-zinc-300' : 'flex-none w-1/6 p-2 bg-zinc-400 border-r-2 border-zinc-300'">

                {{-- minimizar/maximizar aside --}}
                <div
                    x-bind:class="!toggleAside ? 'm-2 flex items-center justify-center' : 'm-2 flex items-center justify-between'">
                    {{-- menu, mostrar ocultar menu, cambiar flechas --}}
                    <h2
                        x-bind:class="!toggleAside ? 'hidden' : 'uppercase text-xs text-zinc-800 font-bold tracking-widest'">
                        menu</h2>
                    <button x-on:click="toggleAside = ! toggleAside"
                        class="text-zinc-800 font-bold tracking-widest">
                        {{-- flecha hacia izquierda --}}
                        <span x-show="toggleAside">
                            <i class="fa-solid fa-arrow-left-long" title="minimizar menu"></i>
                        </span>
                        {{-- flecha hacia derecha --}}
                        <span x-show="! toggleAside">
                            <i class="fa-solid fa-arrow-right" title="maximizar menu"></i>
                        </span>
                    </button>
                </div>

                <div class="mx-2 my-4 border-t-1 border-zinc-800">{{-- espacio --}}</div>

                {{-- BECA --}}
                @can('ver-seccion-beca')
                    <div x-bind:class="toggleAside ? 'm-2' : 'm-1'">
                        {{-- dropdown normal --}}
                        <div x-show="toggleAside">
                            <x-aside-dropdown align="left" width="48">
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
                                <x-slot name="content">
                                    <x-aside-dropdown-link :href="route('dashboard')">
                                        Opcion
                                    </x-aside-dropdown-link>
                                </x-slot>
                            </x-aside-dropdown>
                        </div>
                        {{-- dropdown responsive --}}
                        <div x-show="! toggleAside">
                            <x-aside-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <x-aside-dropdown-button-responsive>
                                        <i class="fa-solid fa-clipboard-check"></i>
                                    </x-aside-dropdown-button-responsive>
                                </x-slot>
                                <x-slot name="content">
                                    <x-aside-dropdown-link :href="route('dashboard')">
                                        Opcion
                                    </x-aside-dropdown-link>
                                </x-slot>
                            </x-aside-dropdown>
                        </div>
                    </div>
                @endcan
                {{-- BECADOS --}}
                @can('ver-seccion-becados')
                    <div x-bind:class="toggleAside ? 'm-2' : 'm-1'">
                        {{-- dropdown normal --}}
                        <div x-show="toggleAside">
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
                        {{-- dropdown responsive --}}
                        <div x-show="! toggleAside">
                            <x-aside-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <x-aside-dropdown-button-responsive>
                                        <i class="fa-solid fa-people-group"></i>
                                    </x-aside-dropdown-button-responsive>
                                </x-slot>
                                <x-slot name="content">
                                    <x-aside-dropdown-link :href="route('dashboard')">
                                        Opcion
                                    </x-aside-dropdown-link>
                                </x-slot>
                            </x-aside-dropdown>
                        </div>
                    </div>
                @endcan
                {{-- CASAS --}}
                @can('ver-seccion-casas')
                    <div x-bind:class="toggleAside ? 'm-2' : 'm-1'">
                        {{-- dropdown normal --}}
                        <div x-show="toggleAside">
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
                        {{-- dropdown responsive --}}
                        <div x-show="! toggleAside">
                            <x-aside-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <x-aside-dropdown-button-responsive>
                                        <i class="fa-solid fa-house-user"></i>
                                    </x-aside-dropdown-button-responsive>
                                </x-slot>
                                <x-slot name="content">
                                    <x-aside-dropdown-link :href="route('dashboard')">
                                        Opcion
                                    </x-aside-dropdown-link>
                                </x-slot>
                            </x-aside-dropdown>
                        </div>
                    </div>
                @endcan
                {{-- PLANIFICACIONES --}}
                @can('ver-seccion-planificaciones')
                    <div x-bind:class="toggleAside ? 'm-2' : 'm-1'">
                        {{-- dropdown normal --}}
                        <div x-show="toggleAside">
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
                        {{-- dropdown responsive --}}
                        <div x-show="! toggleAside">
                            <x-aside-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <x-aside-dropdown-button-responsive>
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </x-aside-dropdown-button-responsive>
                                </x-slot>
                                <x-slot name="content">
                                    <x-aside-dropdown-link :href="route('dashboard')">
                                        Opcion
                                    </x-aside-dropdown-link>
                                </x-slot>
                            </x-aside-dropdown>
                        </div>
                    </div>
                @endcan
                {{-- MANTENIMIENTO --}}
                @can('ver-seccion-mantenimiento')
                    <div x-bind:class="toggleAside ? 'm-2' : 'm-1'">
                        {{-- dropdown normal --}}
                        <div x-show="toggleAside">
                            <x-aside-dropdown align="left" width="48">
                                <!-- slot trigger contiene el boton que dispara el dropdown -->
                                <x-slot name="trigger">
                                    <x-aside-dropdown-button>
                                        <div class="w-full flex flex-row items-center justify-start">
                                            <div class="w-7 h-full flex items-center justify-center">
                                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                            </div>
                                            <span>Mantenimiento</span>
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
                        {{-- dropdown responsive --}}
                        <div x-show="! toggleAside">
                            <x-aside-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <x-aside-dropdown-button-responsive>
                                        <i class="fa-solid fa-screwdriver-wrench"></i>
                                    </x-aside-dropdown-button-responsive>
                                </x-slot>
                                <x-slot name="content">
                                    <x-aside-dropdown-link :href="route('dashboard')">
                                        Opcion
                                    </x-aside-dropdown-link>
                                </x-slot>
                            </x-aside-dropdown>
                        </div>
                    </div>
                @endcan
                {{-- USUARIOS --}}
                @can('ver-seccion-usuarios')
                    <div x-bind:class="toggleAside ? 'm-2' : 'm-1'">
                        {{-- dropdown normal --}}
                        <div x-show="toggleAside">
                            <x-aside-dropdown align="left" width="48">
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
                                <x-slot name="content">
                                    {{-- enlace usuarios --}}
                                    <x-aside-dropdown-link :href="route('users.index')">
                                        <div class="w-full flex flex-row items-center justify-start">
                                            <div class="w-7 h-full flex items-center justify-center">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                            <span>Ver Usuarios</span>
                                        </div>
                                    </x-aside-dropdown-link>
                                    {{-- enlace roles --}}
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
                        {{-- dropdown responsive --}}
                        <div x-show="! toggleAside">
                            <x-aside-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <x-aside-dropdown-button-responsive>
                                        <i class="fa-solid fa-user"></i>
                                    </x-aside-dropdown-button-responsive>
                                </x-slot>
                                <x-slot name="content">
                                    {{-- enlace usuarios --}}
                                    <x-aside-dropdown-link :href="route('users.index')">
                                        <div class="w-full flex flex-row items-center justify-start">
                                            <div class="w-7 h-full flex items-center justify-center">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                            <span>Ver Usuarios</span>
                                        </div>
                                    </x-aside-dropdown-link>
                                    {{-- enlace roles --}}
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
                    </div>
                @endcan
                {{-- AUDITORIA --}}
                @can('ver-seccion-auditoria')
                    <div x-bind:class="toggleAside ? 'm-2' : 'm-1'">
                        {{-- dropdown normal --}}
                        <div x-show="toggleAside">
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
                        {{-- dropdown responsive --}}
                        <div x-show="! toggleAside">
                            <x-aside-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <x-aside-dropdown-button-responsive>
                                        <i class="fa-solid fa-scale-balanced"></i>
                                    </x-aside-dropdown-button-responsive>
                                </x-slot>
                                <x-slot name="content">
                                    <x-aside-dropdown-link :href="route('dashboard')">
                                        Opcion
                                    </x-aside-dropdown-link>
                                </x-slot>
                            </x-aside-dropdown>
                        </div>
                    </div>
                @endcan
                {{-- PARAMETROS --}}
                @can('ver-seccion-parametros')
                    <div x-bind:class="toggleAside ? 'm-2' : 'm-1'">
                        {{-- dropdown normal --}}
                        <div x-show="toggleAside">
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
                        {{-- dropdown responsive --}}
                        <div x-show="! toggleAside">
                            <x-aside-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <x-aside-dropdown-button-responsive>
                                        <i class="fa-solid fa-gear"></i>
                                    </x-aside-dropdown-button-responsive>
                                </x-slot>
                                <x-slot name="content">
                                    <x-aside-dropdown-link :href="route('dashboard')">
                                        Opcion
                                    </x-aside-dropdown-link>
                                </x-slot>
                            </x-aside-dropdown>
                        </div>
                    </div>
                @endcan
            </aside>
            {{-- main tiene full ancho --}}
            <main class="relative flex-initial w-full bg-white border-gray-200">
                {{-- mensajes de sesion --}}
                @if (session('exito'))
                    <x-alerts.alert-success>
                        <span class="mx-1">{{ session('exito') }}</span>
                    </x-alerts.alert-success>
                @elseif (session('error'))
                    <x-alerts.alert-failure>
                        <span class="mx-1">{{ session('error') }}</span>
                    </x-alerts.alert-failure>
                @endif
                {{-- contenido dinamico --}}
                @yield('dashboard-content')
            </main>
        </div>
    </div>
</body>

</html>

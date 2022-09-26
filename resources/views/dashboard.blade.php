<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-l text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <!-- vista dashboard de administracion -->
    <div class="w-100vw h-screen flex flex-row">
        <aside class="flex-none w-1/6 p-2 bg-gray-400 border-r-2 border-gray-200">
            <h2 class="uppercase text-sm text-gray-500">Secciones Principales</h2>
            <!-- lista de enlaces de navegacion -->
            <!-- BECA -->
            <div class="m-2">
                <x-aside-dropdown align="left" width="48">
                    <!-- slot trigger contiene el boton que dispara el dropdown -->
                    <x-slot name="trigger">
                        <button
                            class="w-full flex items-center justify-between text-md font-medium text-gray-800 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="w-full flex flex-row items-center justify-start">
                                <div class="w-7 h-full flex items-center justify-center">
                                    <i class="fa-solid fa-clipboard-check"></i>
                                </div>
                                <span>Beca</span>
                            </div>
                            <div class="ml-1">
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                        </button>
                    </x-slot>
                    <!-- slot content, mostrara los enlaces del dropdown -->
                    <x-slot name="content">
                        <!-- enlace dropdown -->
                        <x-aside-dropdown-link :href="route('dashboard')"
                        onclick="event.preventDefault();">
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
                        <button
                            class="w-full flex items-center justify-between text-md font-medium text-gray-800 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="w-full flex flex-row items-center justify-start">
                                <div class="w-7 h-full flex items-center justify-center">
                                    <i class="fa-solid fa-people-group"></i>
                                </div>
                                <span>Becados</span>
                            </div>
                            <div class="ml-1">
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                        </button>
                    </x-slot>
                    <!-- slot content, mostrara los enlaces del dropdown -->
                    <x-slot name="content">
                        <!-- enlace dropdown -->
                        <x-aside-dropdown-link :href="route('dashboard')"
                        onclick="event.preventDefault();">
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
                        <button
                            class="w-full flex items-center justify-between text-md font-medium text-gray-800 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="w-full flex flex-row items-center justify-start">
                                <div class="w-7 h-full flex items-center justify-center">
                                    <i class="fa-solid fa-house-user"></i>
                                </div>
                                <span>Casas</span>
                            </div>
                            <div class="ml-1">
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                        </button>
                    </x-slot>
                    <!-- slot content, mostrara los enlaces del dropdown -->
                    <x-slot name="content">
                        <!-- enlace dropdown -->
                        <x-aside-dropdown-link :href="route('dashboard')"
                        onclick="event.preventDefault();">
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
                        <button
                            class="w-full flex items-center justify-between text-md font-medium text-gray-800 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="w-full flex flex-row items-center justify-start">
                                <div class="w-7 h-full flex items-center justify-center">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <span>Planificaciones</span>
                            </div>
                            <div class="ml-1">
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                        </button>
                    </x-slot>
                    <!-- slot content, mostrara los enlaces del dropdown -->
                    <x-slot name="content">
                        <!-- enlace dropdown -->
                        <x-aside-dropdown-link :href="route('dashboard')"
                        onclick="event.preventDefault();">
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
                        <x-aside-dropdown-link :href="route('dashboard')"
                        onclick="event.preventDefault();">
                            Opcion
                        </x-aside-dropdown-link>
                    </x-slot>
                </x-aside-dropdown>
            </div>
            <h2 class="uppercase text-sm text-gray-500">Configuraciones</h2>
            <!-- USUARIOS -->
            <div class="m-2">
                <x-aside-dropdown align="left" width="48">
                    <!-- slot trigger contiene el boton que dispara el dropdown -->
                    <x-slot name="trigger">
                        <button
                            class="w-full flex items-center justify-between text-md font-medium text-gray-800 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="w-full flex flex-row items-center justify-start">
                                <div class="w-7 h-full flex items-center justify-center">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <span>Usuarios</span>
                            </div>
                            <div class="ml-1">
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                        </button>
                    </x-slot>
                    <!-- slot content, mostrara los enlaces del dropdown -->
                    <x-slot name="content">
                        <!-- enlace dropdown -->
                        <x-aside-dropdown-link :href="route('dashboard')"
                        onclick="event.preventDefault();">
                            Opcion
                        </x-aside-dropdown-link>
                    </x-slot>
                </x-aside-dropdown>
            </div>
            <!-- AUDITORIA -->
            <div class="m-2">
                <x-aside-dropdown align="left" width="48">
                    <!-- slot trigger contiene el boton que dispara el dropdown -->
                    <x-slot name="trigger">
                        <button
                            class="w-full flex items-center justify-between text-md font-medium text-gray-800 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="w-full flex flex-row items-center justify-start">
                                <div class="w-7 h-full flex items-center justify-center">
                                    <i class="fa-solid fa-scale-balanced"></i>
                                </div>
                                <span>Auditoria</span>
                            </div>
                            <div class="ml-1">
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                        </button>
                    </x-slot>
                    <!-- slot content, mostrara los enlaces del dropdown -->
                    <x-slot name="content">
                        <!-- enlace dropdown -->
                        <x-aside-dropdown-link :href="route('dashboard')"
                        onclick="event.preventDefault();">
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
                        <button
                            class="w-full flex items-center justify-between text-md font-medium text-gray-800 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="w-full flex flex-row items-center justify-start">
                                <div class="w-7 h-full flex items-center justify-center">
                                    <i class="fa-solid fa-gear"></i>
                                </div>
                                <span>Parametros</span>
                            </div>
                            <div class="ml-1">
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                        </button>
                    </x-slot>
                    <!-- slot content, mostrara los enlaces del dropdown -->
                    <x-slot name="content">
                        <!-- enlace dropdown -->
                        <x-aside-dropdown-link :href="route('dashboard')"
                        onclick="event.preventDefault();">
                            Opcion
                        </x-aside-dropdown-link>
                    </x-slot>
                </x-aside-dropdown>
            </div>
        </aside>
        <div class="flex-initial w-5/6 bg-white border-gray-200">
            <!-- como cargo contenido aqui al seleccionar de los enlaces superiores? -->
            <p>contenido dinamico aqui para cada seccion</p>
        </div>
    </div>
</x-app-layout>

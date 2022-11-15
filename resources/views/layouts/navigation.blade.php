<nav x-data="{ open: false }" class="bg-white border-b border-zinc-200">
    <!-- Primary Navigation Menu -->
    <div class="w-100vw mx-2 px-2 sm:px-6 lg:px-4">
        <div class="flex justify-between h-12">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="#">
                        <h2 class="flex justify-center items-center space-x-8 sm:-my-px sm:ml-2 text-gray-600">SiGAU</h2>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                    @can('ver-pagina-estudiante')
                        <!-- link a vista para estudiantes -->
                        <x-nav-link :href="route('student')" :active="request()->routeIs('student')">
                            <i class="fa-solid fa-house mr-1"></i>
                            <span>{{ __('Students') }}</span>
                        </x-nav-link>
                    @endcan
                    @can('ver-pagina-dashboard')
                        <!-- link a vista para otros roles -->
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            <i class="fa-solid fa-house mr-1"></i>
                            <span>{{ __('Dashboard') }}</span>
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-700 hover:border-gray-300 focus:outline-none focus:text-zinc-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>
                                <span>{{Auth()->user()->people->last_name ?? ''}}</span>
                                <span>{{Auth()->user()->people->first_name ?? ''}}</span>
                                <i class="fa-solid fa-user ml-1"></i>
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- perfil  --}}
                        <x-dropdown-link :href="route('show-profile')">
                            <i class="fa-solid fa-address-card mr-1"></i>
                            <span>Mi perfil</span>
                        </x-dropdown-link>
                        {{-- cerrar sesion --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
								this.closest('form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket mr-1"></i>
                                <span>{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-zinc-400 hover:text-zinc-500 hover:bg-zinc-100 focus:outline-none focus:bg-zinc-100 focus:text-zinc-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @can('ver-pagina-estudiante')
                <!-- link responsivo a vista para estudiantes -->
                <x-responsive-nav-link :href="route('student')" :active="request()->routeIs('student')">
                    {{ __('Student') }}
                </x-responsive-nav-link>
            @endcan
            @can('ver-pagina-dashboard')
                <!-- link responsivo a vista para otros roles -->
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-zinc-200">
            <div class="px-4">
                <div class="font-medium text-base text-zinc-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-zinc-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                {{-- perfil --}}
                <x-responsive-nav-link href="#">
                    <i class="fa-solid fa-address-card mr-1"></i>
                    <span>Mi perfil</span>
                </x-responsive-nav-link>
                {{-- cerrar sesion --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
						this.closest('form').submit();">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-1"></i>
                        <span>{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

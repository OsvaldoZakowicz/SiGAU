<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    {{-- css select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- Scripts vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- scripts jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    {{-- scripts select2 (necesita jquery antes) --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- aonfiguración para alpine --}}
    {{-- impide una carga prematura de html antes que alpine se inicie --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>

</head>

<body class="font-sans antialiased">
    {{-- vista de estudiantes --}}
    <div class="min-h-screen">
        {{-- navegacion --}}
        @include('layouts.navigation')

        <div class="w-100vw h-screen">
            {{-- header o navegacion de estudiante --}}

            {{-- main tiene full ancho --}}
            <main class="relative flex-initial w-full bg-zinc-100">
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
                @yield('student-content')
            </main>
        </div>
    </div>
</body>

</html>
{{-- <x-app-layout> --}}
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-l text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot> --}}

		<!-- vista de estudiantes -->
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-zinc-200">
                    @yield('student-content')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

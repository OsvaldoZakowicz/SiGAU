<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-l text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <!-- vista dashboard de administracion -->
    <div class="w-100vw h-screen flex flex-row">
        <aside class="flex-none w-1/6 p-2 bg-gray-400 border-r-2 border-gray-200">
            <!-- lista de enlaces de navegacion -->
            <ul>
                <li class="uppercase">Principal</li>
                <li><a href="#">Beca</a></li>
                <li><a href="#">Becados</a></li>
                <li><a href="#">Casas</a></li>
                <li><a href="#">Planificaciones</a></li>
                <li><a href="#">Mantenimiento</a></li>
                <li class="uppercase">Ajustes</li>
                <li><a href="#">Usuarios</a></li>
                <li><a href="#">Auditoria</a></li>
                <li><a href="#">Parametros</a></li>
            </ul>
        </aside>
        <div class="flex-initial w-5/6 bg-white border-gray-200">
            <!-- como cargo contenido aqui al seleccionar de los enlaces superiores? -->
            <p>contenido dinamico aqui para cada seccion</p>
        </div>
    </div>
</x-app-layout>

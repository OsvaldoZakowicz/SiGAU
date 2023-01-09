@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- encabezado --}}
        <div class="bg-zinc-300">
            {{-- titulo de seccion --}}
            <div class="p-1 flex justify-center items-center bg-zinc-400">
                <h3 class="text-sm font-bold text-zinc-800 uppercase inline-block">área de limpieza: ver área</h3>
            </div>
            {{-- menu de recargar, filtros, busqueda, reporte --}}
            {{-- x-data necesario para el modal --}}
            <div x-data="{ dialog: false }" class="relative m-1">
                {{-- seccion de modal de confirmacion --}}
                <x-modals.modal-warning :name="$area->name" :question="'Desea eliminar el área de limpieza '" :message="'Esta accion es irreversible, puede dejar ambientes sin áreas de limpieza.'">
                    {{-- formulario --}}
                    <div class="px-3 py-2 mt-1 w-full flex items-center justify-end">
                        <x-buttons.button-link-zinc-light x-on:click="dialog = ! dialog" href="#" class="mr-1">
                            <i class="fa-solid fa-ban"></i>
                            <span>cancelar</span>
                        </x-buttons.button-link-zinc-light>
                        <form action="{{route('cleaningareas.destroy', $area->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-buttons.button-submit-red>
                                <i class="fa-solid fa-trash-can mr-1"></i>
                                <span>eliminar</span>
                            </x-buttons.button-submit-red>
                        </form>
                    </div>
                </x-modals.modal-warning>
                <div class="w-full flex items-center justify-end">
                    <x-buttons.button-link-zinc-light href="{{ route('cleaningareas.index') }}" class="mr-2">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>volver al listado</span>
                    </x-buttons.button-link-zinc-light>
                    <x-buttons.button-link-zinc href="{{ route('cleaningareas.edit', $area->id) }}" class="mr-2">
                        <i class="fa-solid fa-pen-to-square mr-1"></i>
                        <span>editar</span>
                    </x-buttons.button-link-zinc>
                    <x-buttons.button-link-red x-on:click="dialog = ! dialog" href="#">
                        <i class="fa-solid fa-trash-can mr-1"></i>
                        <span>eliminar</span>
                    </x-buttons.button-link-red>
                </div>
            </div>
        </div>
        <table class="my-2 border border-zinc-300 border-collapse">
            <tr>
                <x-tables.th-cell class="text-left w-1/4">area:</x-tables.th-cell>
                <x-tables.td-cell>{{ $area->name }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">descripcion de limpieza:</x-tables.th-cell>
                <x-tables.td-cell>{{ $area->cleaning_description }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">frecuencia de limpieza:</x-tables.th-cell>
                <x-tables.td-cell>{{ $area->cleaning_frequency }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">puntaje por limpieza:</x-tables.th-cell>
                <x-tables.td-cell>{{ $area->cleaning_points }}</x-tables.td-cell>
            </tr>
        </table>
    </div>
@endsection
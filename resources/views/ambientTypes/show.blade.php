@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- x-data necesario para el modal --}}
        <div x-data="{ dialog: false }" class="relative mx-2 flex flex-col items-start justify-start">
            {{-- seccion de modal de confirmacion --}}
            <x-modals.modal-warning :name="$tipoAmbiente->name" :question="'Desea eliminar el tipo de ambiente '" :message="'Esta accion es irreversible'">
                {{-- formulario --}}
                <div class="px-3 py-2 mt-1 w-full flex items-center justify-end">
                    <x-buttons.button-link-zinc-light x-on:click="dialog = ! dialog" href="#" class="mr-1">
                        <i class="fa-solid fa-ban"></i>
                        <span>cancelar</span>
                    </x-buttons.button-link-zinc-light>
                    @can('borrar-rol')
                        <form action="{{route('ambienttypes.destroy', $tipoAmbiente->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-buttons.button-submit-red>
                                <i class="fa-solid fa-trash-can mr-1"></i>
                                <span>eliminar</span>
                            </x-buttons.button-submit-red>
                        </form>
                    @endcan
                </div>
            </x-modals.modal-warning>
            <h3 class="text-base text-zinc-800 capitalize">tipo de ambiente: ver tipo</h3>
            <div class="w-full flex items-center justify-end">
                <x-buttons.button-link-zinc-light href="{{ route('ambienttypes.index') }}" class="mr-2">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>volver al listado</span>
                </x-buttons.button-link-zinc-light>
                <x-buttons.button-link-zinc href="{{ route('ambienttypes.edit', $tipoAmbiente->id) }}" class="mr-2">
                    <i class="fa-solid fa-pen-to-square mr-1"></i>
                    <span>editar</span>
                </x-buttons.button-link-zinc>
                <x-buttons.button-link-red x-on:click="dialog = ! dialog" href="#">
                    <i class="fa-solid fa-trash-can mr-1"></i>
                    <span>eliminar</span>
                </x-buttons.button-link-red>
            </div>
        </div>
        <table class="m-2 border border-zinc-300 border-collapse">
            <tr>
                <x-tables.th-cell class="text-left w-1/4">nombre del tipo de ambiente:</x-tables.th-cell>
                <x-tables.td-cell>{{ $tipoAmbiente->name }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">descripcion:</x-tables.th-cell>
                <x-tables.td-cell>{{ $tipoAmbiente->description }}</x-tables.td-cell>
            </tr>
        </table>
    </div>
@endsection
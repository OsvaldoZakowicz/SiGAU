@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- x-data necesario para el modal --}}
        <div x-data="{ dialog: false }" class="relative mx-2 flex flex-col items-start justify-start">
            {{-- seccion de modal de confirmacion --}}
            <x-modals.modal-warning :name="$descripcionServicio->name" :question="'Desea eliminar la descripción de servicio '" :message="'Esta accion es irreversible'">
                {{-- formulario --}}
                <div class="px-3 py-2 mt-1 w-full flex items-center justify-end">
                    <x-buttons.button-link-zinc-light x-on:click="dialog = ! dialog" href="#" class="mr-1">
                        <i class="fa-solid fa-ban"></i>
                        <span>cancelar</span>
                    </x-buttons.button-link-zinc-light>
                    <form action="{{route('servicedescriptions.destroy', $descripcionServicio->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-buttons.button-submit-red>
                            <i class="fa-solid fa-trash-can mr-1"></i>
                            <span>eliminar</span>
                        </x-buttons.button-submit-red>
                    </form>
                </div>
            </x-modals.modal-warning>
            <h3 class="text-base text-zinc-800 capitalize">descripcion de servicio: ver descripcion</h3>
            <div class="w-full flex items-center justify-end">
                <x-buttons.button-link-zinc-light href="{{ route('servicedescriptions.index') }}" class="mr-2">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>volver al listado</span>
                </x-buttons.button-link-zinc-light>
                <x-buttons.button-link-zinc href="{{ route('servicedescriptions.edit', $descripcionServicio->id) }}" class="mr-2">
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
                <x-tables.th-cell class="text-left w-1/4">tipo de servicio:</x-tables.th-cell>
                <x-tables.td-cell>{{ $descripcionServicio->service_type->name }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">llegada de la boleta:</x-tables.th-cell>
                <x-tables.td-cell>
                    <span class="text-xs text-gray-600 uppercase mr-1">día</span>
                    {{ $descripcionServicio->dia_llegada_boleta }}
                    <span class="text-xs text-gray-600 uppercase m-1">de cada mes.</span>
                </x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">período de recaudación:</x-tables.th-cell>
                <x-tables.td-cell>
                    {{ $descripcionServicio->periodo_recaudacion }}
                    <span class="text-xs text-gray-600 uppercase m-1">días</span>
                </x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">pago de la boleta:</x-tables.th-cell>
                <x-tables.td-cell>
                    <span class="text-xs text-gray-600 uppercase mr-1">día</span>
                    {{ $descripcionServicio->dia_pago_servicio }}
                    <span class="text-xs text-gray-600 uppercase m-1">de cada mes.</span>
                </x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">máximo de boletas adeudables:</x-tables.th-cell>
                <x-tables.td-cell>
                    <span class="text-xs text-gray-600 uppercase mr-1">hasta</span>
                    {{ $descripcionServicio->maximo_pagos_adeudados }}
                    <span class="text-xs text-gray-600 uppercase m-1">pagos</span>
                </x-tables.td-cell>
            </tr>
        </table>
    </div>
@endsection
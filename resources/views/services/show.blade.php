@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- x-data necesario para el modal --}}
        <div x-data="{ dialog: false }" class="relative mx-2 flex flex-col items-start justify-start">
            {{-- seccion de modal de confirmacion --}}
            <x-modals.modal-warning :name="$servicio->connection_number" :question="'Desea eliminar el servicio '" :message="'Esta accion es irreversible, dejará una casa sin un servicio'">
                {{-- formulario --}}
                <div class="px-3 py-2 mt-1 w-full flex items-center justify-end">
                    <x-buttons.button-link-zinc-light x-on:click="dialog = ! dialog" href="#" class="mr-1">
                        <i class="fa-solid fa-ban"></i>
                        <span>cancelar</span>
                    </x-buttons.button-link-zinc-light>
                    <form action="{{route('services.destroy', $servicio->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-buttons.button-submit-red>
                            <i class="fa-solid fa-trash-can mr-1"></i>
                            <span>eliminar</span>
                        </x-buttons.button-submit-red>
                    </form>
                </div>
            </x-modals.modal-warning>
            <h3 class="text-base text-zinc-800 capitalize">servicio: ver servicio</h3>
            <div class="w-full flex items-center justify-end">
                <x-buttons.button-link-zinc-light href="{{ route('houses.show',$servicio->house_id) }}" class="mr-2">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>volver al listado</span>
                </x-buttons.button-link-zinc-light>
                <x-buttons.button-link-zinc href="{{ route('services.edit', $servicio->id) }}" class="mr-2">
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
                <th colspan="2" class="px-1 py-1 text-xs uppercase font-bold bg-zinc-200 text-zinc-600">
                    <div class="flex justify-center items-center">
                        <span>servicio de la casa</span>
                    </div>
                </th>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">tipo de servicio:</x-tables.th-cell>
                <x-tables.td-cell>{{ $servicio->service_description->service_type->name }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">nro. conexión | cuenta:</x-tables.th-cell>
                <x-tables.td-cell>{{ $servicio->connection_number }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">titular | dueño</x-tables.th-cell>
                <x-tables.td-cell>{{ $servicio->service_owner }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">CUIT</x-tables.th-cell>
                <x-tables.td-cell>{{ $servicio->cuit }}</x-tables.td-cell>
            </tr>
        </table>
        <table class="m-2 border border-zinc-300 border-collapse">
            <tr>
                <th colspan="2" class="px-1 py-1 text-xs uppercase font-bold bg-zinc-200 text-zinc-600">
                    <div class="flex justify-center items-center">
                        <span>descripcion | configuracion vigente</span>
                    </div>
                </th>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">llegada de la boleta:</x-tables.th-cell>
                <x-tables.td-cell>
                    <span class="text-xs text-gray-600 uppercase mr-1">día</span>
                    {{ $servicio->service_description->dia_llegada_boleta }}
                    <span class="text-xs text-gray-600 uppercase m-1">de cada mes.</span>
                </x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">período de recaudación:</x-tables.th-cell>
                <x-tables.td-cell>
                    {{ $servicio->service_description->periodo_recaudacion }}
                    <span class="text-xs text-gray-600 uppercase m-1">días</span>
                </x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">pago de la boleta:</x-tables.th-cell>
                <x-tables.td-cell>
                    <span class="text-xs text-gray-600 uppercase mr-1">día</span>
                    {{ $servicio->service_description->dia_pago_servicio }}
                    <span class="text-xs text-gray-600 uppercase m-1">de cada mes.</span>
                </x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">máximo de boletas adeudables:</x-tables.th-cell>
                <x-tables.td-cell>
                    <span class="text-xs text-gray-600 uppercase mr-1">hasta</span>
                    {{ $servicio->service_description->maximo_pagos_adeudados }}
                    <span class="text-xs text-gray-600 uppercase m-1">pagos</span>
                </x-tables.td-cell>
            </tr>
        </table>
    </div>
@endsection
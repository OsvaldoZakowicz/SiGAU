@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- x-data necesario para el modal --}}
        <div x-data="{ dialog: false }" class="relative mx-2 flex flex-col items-start justify-start">
            {{-- seccion de modal de confirmacion --}}
            <x-modals.modal-warning :name="$casa->address->house_number" :question="'Desea eliminar la casa '" :message="'Esta accion es irreversible'">
                {{-- formulario --}}
                <div class="px-3 py-2 mt-1 w-full flex items-center justify-end">
                    <x-buttons.button-link-zinc-light x-on:click="dialog = ! dialog" href="#" class="mr-1">
                        <i class="fa-solid fa-ban"></i>
                        <span>cancelar</span>
                    </x-buttons.button-link-zinc-light>
                    <form action="{{route('houses.destroy', $casa->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-buttons.button-submit-red>
                            <i class="fa-solid fa-trash-can mr-1"></i>
                            <span>eliminar</span>
                        </x-buttons.button-submit-red>
                    </form>
                </div>
            </x-modals.modal-warning>
            <h3 class="text-base text-zinc-800 capitalize">casas: ver casa</h3>
            <div class="w-full flex items-center justify-end">
                <x-buttons.button-link-zinc-light href="{{ route('houses.index') }}" class="mr-2">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>volver al listado</span>
                </x-buttons.button-link-zinc-light>
                <x-buttons.button-link-zinc href="{{ route('houses.edit', $casa->id) }}" class="mr-2">
                    <i class="fa-solid fa-pen-to-square mr-1"></i>
                    <span>editar</span>
                </x-buttons.button-link-zinc>
                <x-buttons.button-link-red x-on:click="dialog = ! dialog" href="#">
                    <i class="fa-solid fa-trash-can mr-1"></i>
                    <span>eliminar</span>
                </x-buttons.button-link-red>
            </div>
        </div>
        {{-- cabecera de informacion general --}}
        <div class="mx-2 my-2 p-2 mb-4 flex flex-row items-start justify-start border border-zinc-300 border-collapse">
            {{-- casa --}}
            <div class="mr-1 p-2">
                <h4 class="block text-sm uppercase font-semibold tracking-wider text-zinc-600">Informacion de la casa:</h4>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">casa | edificio:</h4>
                    <span class="text-sm font-bold mx-1 px-1 text-zinc-800">N° {{ $casa->address->house_number }}</span>
                </div>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">dpto. y piso:</h4>
                    <span class="text-sm font-bold mx-1 px-1 text-zinc-800">
                        @if ($casa->address->department_number !== null)
                            <span>dpto:</span>
                            {{ $casa->address->department_number }}
                        @else
                            <span>dpto: - </span>
                        @endif
                        @if ($casa->address->floor_number !== null)
                            <span>piso:</span>
                            {{ $casa->address->floor_number }}
                        @else
                            <span>piso: - </span>
                        @endif
                    </span>
                </div>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">calle y número:</h4>
                    <span class="text-sm font-bold mx-1 px-1 text-zinc-800">
                        {{ $casa->address->street }}
                        {{ $casa->address->street_number }}
                    </span>
                </div>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">cuadra:</h4>
                    <span class="text-sm font-bold mx-1 px-1 text-zinc-800">
                        {{ $casa->block }}
                    </span>
                </div>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">barrio:</h4>
                    <span class="text-sm font-bold mx-1 px-1 text-zinc-800">
                        {{ $casa->neighborhood }}
                    </span>
                </div>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">direccion:</h4>
                    <span class="text-sm font-bold mx-1 px-1 text-zinc-800">
                        {{ $casa->address->location->name }}
                        {{ $casa->address->location->postal_code }}
                        {{ $casa->address->location->province->name }}
                        {{ $casa->address->location->province->country->name }}
                    </span>
                </div>
            </div>
            {{-- proximamente--}}
            <div class="mr-1 p-2 border-l border-zinc-300">
                <h4 class="block text-sm uppercase font-semibold tracking-wider text-zinc-600">proximamente:</h4>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">becados asignados:</h4>
                    <span class="text-sm mx-1 px-1 text-zinc-800">
                        <span class="italic">datos datos datos datos</span>
                    </span>
                </div>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">estado de la limpieza:</h4>
                    <span class="text-sm mx-1 px-1 text-zinc-800">
                        <span class="italic">datos datos datos datos</span>
                    </span>
                </div>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">estado de los servicios:</h4>
                    <span class="text-sm mx-1 px-1 text-zinc-800">
                        <span class="italic">datos datos datos datos</span>
                    </span>
                </div>
            </div>
        </div>
        {{-- servicios --}}
        <table class="table-auto m-2 border border-zinc-300 border-collapse">
            <thead>
                <tr>
                    <th colspan="6" class="px-1 py-1 text-xs uppercase font-bold bg-zinc-200 text-zinc-600">
                        <div class="flex justify-between items-center">
                            <span>servicios de la casa</span>
                            <x-buttons.button-link-zinc href="{{route('service-for-house',$casa->id)}}">
                                <i class="fa-solid fa-pen-to-square mr-1"></i>
                                <span>nuevo servicio</span>
                            </x-buttons.button-link-zinc>
                        </div>
                    </th>
                </tr>
                <tr>
                    <x-tables.th-cell>id</x-tables.th-cell>
                    <x-tables.th-cell>servicio</x-tables.th-cell>
                    <x-tables.th-cell>nro. conexión | cuenta</x-tables.th-cell>
                    <x-tables.th-cell>titular | dueño</x-tables.th-cell>
                    <x-tables.th-cell>CUIT</x-tables.th-cell>
                    <x-tables.th-cell>acciones</x-tables.th-cell>
                </tr>
            </thead>
            @if (count($serviciosDeLaCasa) !== 0)
                <tbody>
                    @foreach ($serviciosDeLaCasa as $servicio)
                        <tr class="text-sm text-zinc-800">
                            <x-tables.td-cell>{{$servicio->id}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$servicio->service_description->service_type->name}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$servicio->connection_number}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$servicio->service_owner}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$servicio->cuit}}</x-tables.td-cell>
                            <x-tables.td-cell>
                                <a href="{{ route('services.edit', $servicio->id) }}"
                                    class="mr-1 text-xs uppercase hover:text-green-500">
                                    <i class="fa-solid fa-pen"></i>
                                    <span>editar</span>
                                </a>
                                <a href="{{ route('services.show', $servicio->id) }}"
                                    class="mr-1 text-xs uppercase hover:text-sky-500">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>detalles</span>
                                </a>
                            </x-tables.td-cell>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <tbody>
                    <tr>
                        <td colspan="6" class="px-1 text-sm text-red-600 border border-zinc-300">esta casa no cuenta con servicios registrados!</td>
                    </tr>
                </tbody>
            @endif
        </table>
        {{-- ambientes --}}
        <table class="table-auto m-2 border border-zinc-300 border-collapse">
            <thead>
                <tr>
                    <th colspan="8" class="px-1 py-1 text-xs uppercase font-bold bg-zinc-200 text-zinc-600">
                        <div class="flex justify-between items-center">
                            <span>ambientes de la casa</span>
                            <x-buttons.button-link-zinc href="{{route('ambient-for-house',$casa->id)}}">
                                <i class="fa-solid fa-pen-to-square mr-1"></i>
                                <span>nuevo ambiente</span>
                            </x-buttons.button-link-zinc>
                        </div>
                    </th>
                </tr>
                <tr>
                    <x-tables.th-cell>id</x-tables.th-cell>
                    <x-tables.th-cell>ambiente</x-tables.th-cell>
                    <x-tables.th-cell>cantidad en la casa</x-tables.th-cell>
                    <x-tables.th-cell>tamaño del ambiente</x-tables.th-cell>
                    <x-tables.th-cell>cant. lugares</x-tables.th-cell>
                    <x-tables.th-cell>cant. luces</x-tables.th-cell>
                    <x-tables.th-cell>cant. tomas</x-tables.th-cell>
                    <x-tables.th-cell>acciones</x-tables.th-cell>
                </tr>
            </thead>
            @if (count($ambientesDeLaCasa) !== 0)
                <tbody>
                    @foreach ($ambientesDeLaCasa as $ambiente)
                        <tr class="text-sm text-zinc-800">
                            <x-tables.td-cell>{{$ambiente->id}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$ambiente->ambient_description->ambient_type->name}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$ambiente->quantity}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$ambiente->ambient_description->size}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$ambiente->ambient_description->places_quantity}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$ambiente->ambient_description->lights_quantity}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$ambiente->ambient_description->plugs_quantity}}</x-tables.td-cell>
                            <x-tables.td-cell>
                                <a href="{{ route('ambients.edit', $ambiente->id) }}"
                                    class="mr-1 text-xs uppercase hover:text-green-500">
                                    <i class="fa-solid fa-pen"></i>
                                    <span>editar</span>
                                </a>
                                <a href="{{ route('ambients.show', $ambiente->id) }}"
                                    class="mr-1 text-xs uppercase hover:text-sky-500">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>detalles</span>
                                </a>
                            </x-tables.td-cell>
                        </tr>
                    @endforeach
                </tbody>
            @else    
            <tbody>
                <tr>
                    <td colspan="6" class="px-1 text-sm text-red-600 border border-zinc-300">esta casa no cuenta con ambientes registrados!</td>
                </tr>
            </tbody>
            @endif
        </table>
    </div>
@endsection
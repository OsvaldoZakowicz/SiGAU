@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- encabezado --}}
        <div class="bg-zinc-300">
            {{-- titulo de seccion --}}
            <div class="p-1 flex justify-center items-center bg-zinc-400">
                <h3 class="text-sm font-bold text-zinc-800 uppercase inline-block">casas: listado</h3>
            </div>
            {{-- menu de recargar, filtros, busqueda, reporte --}}
            <div class="m-1">
                <div class="w-full flex items-center justify-between">
                    <x-buttons.button-link-zinc-light href="{{ route('houses.index') }}" title="refrescar lista">
                        <i class="fa-solid fa-rotate text-zinc-600 mr-1"></i>
                        <span>recargar</span>
                    </x-buttons.button-link-zinc-light>
                    {{-- formulario de busqueda --}}
                    {{-- <div class="w-2/3">
                        <form action="{{ route('users.index') }}" method="GET">
                            <div class="flex items-center">
                                <select name="filtro"
                                    class="w-52 my-1 p-1 mr-1 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <option value="email">email</option>
                                    <option value="role">rol</option>
                                </select>
                                <input type="text" name="valor" placeholder="buscar ..."
                                    class="my-1 mr-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                <select name="orden"
                                    class="w-36 my-1 p-1 mr-1 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <option value="asc">a&rarr;z</option>
                                    <option value="desc">z&rarr;a</option>
                                </select>
                                <x-buttons.button-submit-green class="ml-1">
                                    <i class="fa-solid fa-magnifying-glass mr-1"></i>
                                    <span>buscar</span>
                                </x-buttons.button-submit-green>
                            </div>
                        </form>
                    </div> --}}
                    <x-buttons.button-link-zinc href="{{ route('houses.create') }}">
                        <i class="fa-solid fa-house mr-1"></i>
                        <span>nueva casa</span>
                    </x-buttons.button-link-zinc>
                </div>
            </div>
            {{-- informe de busqueda --}}
            {{-- @if (count($validated) !== 0)
                <div class="m-1 p-1 flex items-center justify-between mt-2 text-md text-zinc-700 border border-zinc-300 bg-zinc-200">
                    <div>
                        <span>filtrado por columna:
                            <span class="ml-1 font-bold">
                                {{ __($validated['filtro']) }}
                            </span>
                            @if (array_key_exists('valor', $validated))
                                <span class="ml-1">con valor de busqueda:</span>
                                <span class="ml-1 font-bold">
                                    {{ $validated['valor'] }}
                                </span>
                            @endif
                            <span class="ml-1">ordenado de forma:</span>
                            <span class="ml-1 font-bold">
                                {{ __($validated['orden']) }}
                            </span>
                        </span>
                    </div>
                    <div>
                        @if (count($users) !== 0)
                            <form action="{{ route('report-users') }}" method="GET">
                                <input type="text" name="filtro" value="{{ $validated['filtro'] }}" class="hidden">
                                @if (array_key_exists('valor', $validated))
                                    <input type="text" name="valor" value="{{ $validated['valor'] }}" class="hidden">
                                @endif
                                <input type="text" name="orden" value="{{ $validated['orden'] }}" class="hidden">
                                <button type="submit" title="reporte PDF de la tabla">
                                    <i class="fa-solid fa-file-pdf text-xl text-red-600"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif --}}
        </div>
        {{-- tabla --}}
        <table class="my-2 table-auto border border-zinc-300 border-collapse">
            <thead>
                <tr>
                    <x-tables.th-cell>id</x-tables.th-cell>
                    <x-tables.th-cell>casa | edificio</x-tables.th-cell>
                    <x-tables.th-cell>dpto. y piso</x-tables.th-cell>
                    {{-- calle + numero --}}
                    <x-tables.th-cell>calle y numero</x-tables.th-cell>
                    {{-- manzana --}}
                    <x-tables.th-cell>cuadra</x-tables.th-cell>
                    {{-- barrio --}}
                    <x-tables.th-cell>barrio</x-tables.th-cell>
                    {{-- CP, localidad, pais, provincia --}}
                    <x-tables.th-cell>direccion</x-tables.th-cell>
                    <x-tables.th-cell>acciones</x-tables.th-cell>
                </tr>
            </thead>
            @if (count($casas) !== 0)
                <tbody>
                    @foreach ($casas as $casa)
                        <tr class="text-sm text-zinc-800">
                            <x-tables.td-cell>{{ $casa->id }}</x-tables.td-cell>
                            <x-tables.td-cell>
                                <span class="text-xs text-gray-600 uppercase m-1">N??:</span>
                                {{ $casa->address->house_number }}
                            </x-tables.td-cell>
                            <x-tables.td-cell>
                                @if ($casa->address->department_number !== null)
                                    <span class="text-xs text-gray-600 uppercase m-1">dpto:</span>
                                    {{ $casa->address->department_number }}
                                @else
                                    <span class="text-xs text-gray-600 uppercase m-1">dpto: - </span>
                                @endif
                                @if ($casa->address->floor_number !== null)
                                    <span class="text-xs text-gray-600 uppercase m-1">piso:</span>
                                    {{ $casa->address->floor_number }}
                                @else
                                    <span class="text-xs text-gray-600 uppercase m-1">piso: - </span>
                                @endif
                            </x-tables.td-cell>
                            <x-tables.td-cell>
                                {{ $casa->address->street }}
                                {{ $casa->address->street_number }}
                            </x-tables.td-cell>
                            <x-tables.td-cell>
                                {{ $casa->block }}
                            </x-tables.td-cell>
                            <x-tables.td-cell>
                                {{ $casa->neighborhood }}
                            </x-tables.td-cell>
                            <x-tables.td-cell>
                                {{ $casa->address->location->name }}
                                {{ $casa->address->location->postal_code }}
                                {{ $casa->address->location->province->name }}
                                {{ $casa->address->location->province->country->name }}
                            </x-tables.td-cell>
                            <x-tables.td-cell>
                                <a href="{{ route('houses.edit', $casa->id) }}"
                                    class="mr-1 text-xs uppercase hover:text-green-500">
                                    <i class="fa-solid fa-pen"></i>
                                    <span>editar</span>
                                </a>
                                {{-- show, casa, ambientes, servicios --}}
                                <a href="{{ route('houses.show', $casa->id) }}"
                                    class="mr-1 text-xs uppercase hover:text-sky-500">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>ver</span>
                                </a>
                            </x-tables.td-cell>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <tbody>
                    <tr class="text-sm text-red-600">
                        <x-tables.td-cell colspan="6">Sin resultados de busqueda.</x-tables.td-cell>
                    </tr>
                </tbody>
            @endif
        </table>
        {{-- paginacion --}}
        <div class="">
            {{ $casas->links() }}
        </div>
    </div>
@endsection
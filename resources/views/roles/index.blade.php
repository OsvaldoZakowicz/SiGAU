@extends('dashboard')
@section('dashboard-content')
<div class="w-full h-max flex flex-col p-1">
    <div class="mx-2 flex flex-col items-start justify-start">
        <h3 class="text-base text-zinc-800 capitalize">roles: listado</h3>
        {{-- menu de recargar, filtros, busqueda --}}
        <div class="w-full flex items-center justify-between">
            <x-buttons.button-link-zinc-light href="{{route('roles.index')}}">
                <i class="fa-solid fa-rotate text-zinc-600"></i>
            </x-buttons.button-link-zinc-light>
            {{-- formulario de busqueda --}}
            <div class="w-2/3">
                <form action="{{route('roles.index')}}" method="GET">
                    <div class="flex items-center">
                        {{-- filtros --}}
                        <select name="filtro" class="w-52 my-1 p-1 mr-1 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            <option value="name">nombre</option>
                            <option value="description">descripcion</option>
                        </select>
                        {{-- busqueda --}}
                        <input type="text" name="valor" placeholder="buscar ..." class="my-1 mr-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                        {{-- orden de listado --}}
                        <select name="orden" class="w-36 my-1 p-1 mr-1 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            <option value="asc">a&rarr;z</option>
                            <option value="desc">z&rarr;a</option>
                        </select>
                        {{-- submit --}}
                        <x-buttons.button-submit-green class="ml-1">
                            <i class="fa-solid fa-magnifying-glass mr-1"></i>
                            <span>buscar</span>
                        </x-buttons.button-submit-green>
                    </div>
                </form>
            </div>
            @can('crear-rol')
                <x-buttons.button-link-zinc href="{{route('roles.create')}}">
                    <i class="fa-solid fa-user-tag"></i>
                    <span>crear rol</span>
                </x-buttons.button-link-zinc>
            @endcan
        </div>
    </div>
    {{-- informe de busqueda --}}
    @if (count($validated) !== 0)
        <div class="mx-2 p-1 flex items-center justify-between mt-2 text-md text-zinc-700 border border-zinc-300 bg-zinc-200">
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
                {{-- si hay resultados de busqueda o filtro --}}
                @if (count($roles) !== 0)
                    <form action="{{route('report-roles')}}" method="GET">
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
    @endif
    {{-- tabla --}}
    <table class="table-auto m-2 border border-zinc-300 border-collapse">
        <thead>
            <tr>
                <x-tables.th-cell>id</x-tables.th-cell>
                <x-tables.th-cell>nombre</x-tables.th-cell>
                <x-tables.th-cell>descripcion</x-tables.th-cell>
                <x-tables.th-cell>fecha de creacion</x-tables.th-cell>
                <x-tables.th-cell title="indica si el rol se puede editar o no.">
                    <span>visibilidad</span>
                    <i class="fa-solid fa-circle-info ml-1"></i>
                </x-tables.th-cell>
                <x-tables.th-cell>acciones</x-tables.th-cell>
            </tr>
        </thead>
        @if (count($roles))
            <tbody>
                @foreach ($roles as $role)
                    <tr class="text-sm text-zinc-800">
                        <x-tables.td-cell>{{$role->id}}</x-tables.td-cell>
                        <x-tables.td-cell>{{$role->name}}</x-tables.td-cell>
                        <x-tables.td-cell>{{$role->description}}</x-tables.td-cell>
                        <x-tables.td-cell>{{$role->created_at}} Hrs.</x-tables.td-cell>
                        <x-tables.td-cell>
                            @if ($role->visibility === "readonly")
                                <span class="bg-red-300 px-1 text-zinc-800">{{__($role->visibility)}}</span>
                            @else
                                <span class="bg-green-300 px-1 text-zinc-800">{{__($role->visibility)}}</span>
                            @endif
                        </x-tables.td-cell>
                        <x-tables.td-cell>
                            <a href="{{route('roles.show', $role->id)}}" class="mr-1 text-xs uppercase hover:text-sky-500">
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
    <div class="mx-2">
        {{$roles->links()}}
    </div>
</div>
@endsection

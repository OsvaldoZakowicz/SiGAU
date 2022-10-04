@extends('dashboard')
@section('dashboard-content')
<div class="w-full h-max flex flex-col p-1">
    <div class="mx-2 flex flex-col items-start justify-start">
        <h3 class="text-base text-zinc-800 capitalize">roles: listado</h3>
        <div class="w-full flex items-center justify-between">
            <span>filtros/busqueda aqui!</span>
            {{-- falta permisos!! --}}
            <x-buttons.button-link-zinc href="{{route('roles.create')}}">
                <i class="fa-solid fa-user-tag"></i>
                <span>crear rol</span>
            </x-buttons.button-link-zinc>
        </div>
    </div>
    <table class="table-auto m-2 border border-zinc-300 border-collapse">
        <thead>
            <tr>
                <x-tables.th-cell>id</x-tables.th-cell>
                <x-tables.th-cell>nombre</x-tables.th-cell>
                <x-tables.th-cell>acciones</x-tables.th-cell>
            </tr>
        </thead>
        <tbody>
            @if (count($roles))
                @foreach ($roles as $role)
                    <tr class="text-sm text-zinc-800">
                        <x-tables.td-cell>{{$role->id}}</x-tables.td-cell>
                        <x-tables.td-cell>{{$role->name}}</x-tables.td-cell>
                        <x-tables.td-cell>
                            <a href="{{route('roles.show', $role->id)}}" class="mr-1 text-xs uppercase hover:text-sky-500">
                                <i class="fa-solid fa-eye"></i>
                                <span>ver</span>
                            </a> 
                        </x-tables.td-cell>
                    </tr>
                @endforeach
            @else
                <tr>
                    <x-tables.td-cell class="">sin datos</x-tables.td-cell>
                </tr>
            @endif
        </tbody>
    </table>
    {{-- paginacion --}}
    <div class="mx-2">
        {{$roles->links()}}
    </div>
</div>
@endsection

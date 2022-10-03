@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">roles: ver rol</h3>
            <div class="w-full flex items-center justify-end">
                <x-buttons.button-link-zinc href="{{route('roles.edit', $role->id)}}" class="mr-2">
                    <i class="fa-solid fa-pen-to-square mr-1"></i>
                    <span>editar rol</span>
                </x-button-link-zinc>
                <x-buttons.button-link-red href="{{route('roles.destroy', $role->id)}}">
                    <i class="fa-solid fa-trash-can mr-1"></i>
                    <span>eliminar rol</span>
                </x-button-link-red>
            </div>
        </div>
        <table class="m-2 border border-zinc-300 border-collapse">
            <tr>
                <x-tables.th-cell class="text-left w-1/4">nombre del rol:</x-tables.th-cell>
                <x-tables.td-cell>{{$role->name}}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">permisos del rol:</x-tables.th-cell>
                <x-tables.td-cell>
                    @if (count($rolePermissions))
                        @foreach ($rolePermissions as $permission)
                            <span class="bg-green-300 px-1 text-zinc-600">{{$permission}}</span>
                        @endforeach
                    @else
                        <span class="text-red-600">sin permisos</span>
                    @endif
                </x-tables.td-cell>
            </tr>
        </table>
    </div>
@endsection
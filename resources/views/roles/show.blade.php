@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">roles: ver rol</h3>
            <div class="w-full flex items-center justify-end">
                @if ($role->visibility === 'readwrite')
                    <x-buttons.button-link-zinc-light href="{{ route('roles.index') }}" class="mr-2">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>volver al listado</span>
                    </x-buttons.button-link-zinc-light>
                    @can('editar-rol')
                        <x-buttons.button-link-zinc href="{{ route('roles.edit', $role->id) }}" class="mr-2">
                            <i class="fa-solid fa-pen-to-square mr-1"></i>
                            <span>editar rol</span>
                        </x-button-link-zinc>
                    @endcan
                    {{-- eliminar --}}
                    @can('borrar-rol')
                        <form action="{{route('roles.destroy', $role)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-buttons.button-submit-red>
                                <i class="fa-solid fa-trash-can mr-1"></i>
                                <span>eliminar rol</span>
                            </x-buttons.button-submit-red>
                        </form>
                    @endcan
                @else
                    <x-buttons.button-link-zinc-light href="{{ route('roles.index') }}">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>volver al listado</span>
                    </x-buttons.button-link-zinc-light>
                @endif
            </div>
        </div>
        <table class="m-2 border border-zinc-300 border-collapse">
            <tr>
                <x-tables.th-cell class="text-left w-1/4">nombre del rol:</x-tables.th-cell>
                <x-tables.td-cell>{{ $role->name }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">descripcion del rol:</x-tables.th-cell>
                <x-tables.td-cell>{{ $role->description }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">fecha de creacion:</x-tables.th-cell>
                <x-tables.td-cell>
                    {{\Carbon\Carbon::parse($role->created_at)->locale('es_ES')->format('d-m-Y H:i')}} Hrs.
                </x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">visibilidad del rol:</x-tables.th-cell>
                <x-tables.td-cell>
                    @if ($role->visibility === 'readonly')
                        <span class="bg-red-300 text-zinc-600">{{ $role->visibility }}</span>
                    @else
                        <span class="bg-green-300 text-zinc-600">{{ $role->visibility }}</span>
                    @endif
                </x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">permisos del rol:</x-tables.th-cell>
                <x-tables.td-cell>
                    @if (count($rolePermissions))
                        @foreach ($rolePermissions as $permission)
                            <span class="bg-green-300 px-1 text-zinc-600">{{ $permission }}</span>
                        @endforeach
                    @else
                        <span class="text-red-600">sin permisos</span>
                    @endif
                </x-tables.td-cell>
            </tr>
        </table>
    </div>
@endsection

@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- x-data necesario para el modal --}}
        <div x-data="{ dialog: false }" class="relative mx-2 flex flex-col items-start justify-start">
            {{-- seccion de modal de confirmacion --}}
            <x-modals.modal-warning :name="$user->name" :question="'Desea revocar el rol del usuario '" :message="'Esta accion dejará al usuario con un rol inhabilitado solo con acceso al dashboard y su cuenta'">
                {{-- formulario --}}
                <div class="px-3 py-2 mt-1 w-full flex items-center justify-end">
                    <x-buttons.button-link-zinc-light x-on:click="dialog = ! dialog" href="#" class="mr-1">
                        <i class="fa-solid fa-ban"></i>
                        <span>cancelar</span>
                    </x-buttons.button-link-zinc-light>
                    @can('borrar-usuario')
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-buttons.button-submit-red>
                                <i class="fa-solid fa-lock mr-1"></i>
                                <span>revocar rol</span>
                            </x-buttons.button-submit-red>
                        </form>
                    @endcan
                </div>
            </x-modals.modal-warning>
            <h3 class="text-base text-zinc-800 capitalize">usuarios: ver usuario</h3>
            <div class="w-full flex items-center justify-end">
                <x-buttons.button-link-zinc-light href="{{ route('users.index') }}" class="mr-1">
                    <i class="fa-solid fa-rotate-left mr-1"></i>
                    <span>volver al listado</span>
                </x-buttons.button-link-zinc-light>
                @can('editar-usuario')
                    <x-buttons.button-link-zinc href="{{ route('users.edit', $user->id) }}" class="mr-1">
                        <i class="fa-solid fa-user-shield mr-1"></i>
                        <span>asignar rol</span>
                    </x-buttons.button-link-zinc>
                @endcan
                {{-- inhabilitar --}}
                @if ($rolesAsignados->count())
                    @foreach ($rolesAsignados as $role)
                        @if ($role !== 'inhabilitado')
                            @can('borrar-usuario')
                                <x-buttons.button-link-red x-on:click="dialog = ! dialog" href="#">
                                    <i class="fa-solid fa-lock mr-1"></i>
                                    <span>revocar rol</span>
                                </x-buttons.button-link-red>
                            @endcan
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
        <table class="m-2 border border-zinc-300 border-collapse">
            <tr>
                <x-tables.th-cell class="text-left w-1/4">nombre de usuario:</x-tables.th-cell>
                <x-tables.td-cell>{{ $user->name }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">correo:</x-tables.th-cell>
                <x-tables.td-cell>{{ $user->email }}</x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">cuenta creada en:</x-tables.th-cell>
                <x-tables.td-cell>
                    {{ \Carbon\Carbon::parse($user->created_at)->locale('es_Ar')->format('d-m-Y H:i') }} Hrs.
                </x-tables.td-cell>
            </tr>
            <tr>
                <x-tables.th-cell class="text-left w-1/4">roles activos:</x-tables.th-cell>
                <x-tables.td-cell>
                    @if ($rolesAsignados->count())
                        @foreach ($rolesAsignados as $role)
                            @if ($role === 'inhabilitado')
                                <span class="bg-zinc-300 px-1 text-zinc-800">{{ $role }}</span>
                            @else
                                <span class="bg-green-300 px-1 text-zinc-800">{{ $role }}</span>
                            @endif
                        @endforeach
                    @elseif ($user->email === 'admin@admin.com')
                        <span class="bg-red-300 px-1 text-zinc-800">super administrador</span>
                    @else
                        <span class="text-red-600">sin roles</span>
                    @endif
                </x-tables.td-cell>
            </tr>
        </table>
    </div>
@endsection

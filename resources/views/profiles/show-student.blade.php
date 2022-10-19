@extends('student')
@section('student-content')
<div x-data="{ dialog: false }" class="w-full flex flex-col p-1">
    {{-- x-data necesario para el modal --}}
    <div class="relative mx-2">
        <x-modals.modal-warning :name="$user->name" :question="'Estas seguro de eliminar tu cuenta '" :message="'Esta accion es irreversible, perderás tu acceso al sistema, tus datos personales serán borrados'">
            {{-- formulario --}}
            <div class="px-3 py-2 mt-1 w-full flex items-center justify-end">
                <x-buttons.button-link-zinc-light x-on:click="dialog = ! dialog" href="#" class="mr-1">
                    <i class="fa-solid fa-ban"></i>
                    <span>cancelar</span>
                </x-buttons.button-link-zinc-light>
                <form action="{{route('delete-student', $user)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-buttons.button-submit-red>
                        <i class="fa-solid fa-user-slash mr-1"></i>
                        <span>si, eliminar!</span>
                    </x-buttons.button-submit-red>
                </form>
            </div>
        </x-modals.modal-warning>
        <h3 class="text-base text-zinc-800 capitalize">mi perfil</h3>
    </div>
    <div class="mx-2 flex">
        {{-- perfil --}}
        <div class="w-full max-w-xs overflow-hidden bg-zinc-50 border border-zinc-100">
            <img class="object-cover w-full h-56"
                src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                alt="avatar">

            <div class="py-5 text-center">
                <a href="#" class="block text-2xl font-bold text-zinc-800" tabindex="0"
                    role="link">{{ $user->name }}</a>
                <span class="block text-xs uppercase font-semibold tracking-wider text-zinc-600" tabindex="0"
                    role="link">soy:</span>
                @foreach ($roles as $role)
                    <span class="text-sm bg-green-300 px-1 text-zinc-800">{{ $role }}</span>
                @endforeach
            </div>
        </div>
        {{-- cuenta --}}
        <div class="w-full ml-3 p-3 overflow-hidden flex flex-col justify-between bg-zinc-50 border border-zinc-100">
            <div>
                <div class="py-2 text-left">
                    <span class="block text-xs uppercase font-semibold tracking-wider text-zinc-600" tabindex="0"
                        role="link">nombre de usuario:</span>
                    <span class="text-md text-zinc-700 font-bold tracking-wider">{{ $user->name }}</span>
                </div>
                <div class="py-2 text-left">
                    <span class="block text-xs uppercase font-semibold tracking-wider text-zinc-600" tabindex="0"
                        role="link">correo electrónico:</span>
                    <span class="text-md text-zinc-700 font-bold tracking-wider">{{ $user->email }}</span>
                </div>
                <div class="py-2 text-left">
                    <span class="block text-xs uppercase font-semibold tracking-wider text-zinc-600" tabindex="0"
                        role="link">cuenta activa desde:</span>
                    <span class="text-md text-zinc-700 font-bold tracking-wider">{{ $user->created_at }}</span>
                </div>
            </div>
            <div class="h-48 flex items-end justify-end">
                <x-buttons.button-link-zinc href="{{route('edit-student', $user)}}" class="mr-1">
                    <i class="fa-solid fa-user-pen mr-1"></i>
                    <span>editar mi perfil</span>
                </x-buttons.button-link-zinc>
                <x-buttons.button-link-red x-on:click="dialog = ! dialog" href="#" class="">
                    <i class="fa-solid fa-user-slash mr-1"></i>
                    <span>eliminar mi cuenta</span>
                </x-buttons.button-link-red>
            </div>
        </div>
    </div>
</div>
@endsection
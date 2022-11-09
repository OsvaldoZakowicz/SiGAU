@extends('student')
@section('student-content')
    <div x-data="{ dialog: false }" class="w-full flex flex-col p-1">
        {{-- x-data necesario para el modal --}}
        <div class="relative mx-2">
            <x-modals.modal-warning :name="$user->name" :question="'Estas seguro de eliminar tu cuenta '" :message="'Esta accion es irreversible, perderás tu rol y acceso al sistema, tus datos personales serán borrados'">
                {{-- formulario --}}
                <div class="px-3 py-2 mt-1 w-full flex items-center justify-end">
                    <x-buttons.button-link-zinc-light x-on:click="dialog = ! dialog" href="#" class="mr-1">
                        <i class="fa-solid fa-ban"></i>
                        <span>cancelar</span>
                    </x-buttons.button-link-zinc-light>
                    <form action="{{ route('delete-account-student', $user) }}" method="POST">
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
            {{-- cuenta --}}
            <div
                class="flex flex-col justify-center items-center p-3 w-full max-w-xs overflow-hidden bg-white border border-zinc-200">
                <span class="block text-xs my-2 uppercase font-semibold tracking-wider text-zinc-800">detalle de
                    cuenta:</span>
                <img class="object-cover w-32 h-32 rounded-full"
                    src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                    alt="avatar">

                <div class="py-5 text-center">
                    <span class="block text-xs uppercase font-semibold tracking-wider text-zinc-600">correo:</span>
                    <span class="text-sm px-1 text-zinc-800">{{ $user->email }}</span>
                    <span class="block text-xs uppercase font-semibold tracking-wider text-zinc-600">activo desde:</span>
                    <span class="text-sm px-1 text-zinc-800">{{ $user->created_at }}</span>
                    <span class="block text-xs uppercase font-semibold tracking-wider text-zinc-600">soy:</span>
                    @foreach ($roles as $role)
                        <span class="text-sm bg-green-300 px-1 text-zinc-800">{{ $role }}</span>
                    @endforeach
                </div>
                <div class="flex items-end justify-end">
                    <x-buttons.button-link-zinc href="{{route('edit-account-student', $user)}}" class="mr-1">
                        <i class="fa-solid fa-user-pen mr-1"></i>
                        <span>editar</span>
                    </x-buttons.button-link-zinc>
                    <x-buttons.button-link-red x-on:click="dialog = ! dialog" href="#" class="">
                        <i class="fa-solid fa-user-slash mr-1"></i>
                        <span>eliminar</span>
                    </x-buttons.button-link-red>
                </div>
            </div>
            {{-- perfil --}}
            @if ($user->people_id !== null)
                {{-- perfil, completo --}}
                <div
                    class="flex flex-col justify-start items-start w-full ml-3 p-3 overflow-hidden bg-white border border-zinc-200">
                    <span class="block text-xs my-2 uppercase font-semibold tracking-wider text-zinc-800">detalle del
                        perfil:</span>
                    <div class="flex flex-col justify-between h-full w-full">
                        <div class="w-full flex flex-col flex-wrap">
                            <div class="py-1 text-left">
                                <span
                                    class="text-xs uppercase font-semibold tracking-wider text-zinc-600">{{ $profile->profile_id_type }}:</span>
                                <span class="text-sm px-1 text-zinc-800">{{ $profile->profile_id_number }}</span>
                            </div>
                            <div class="py-1 text-left">
                                <span class="text-xs uppercase font-semibold tracking-wider text-zinc-600">apellido:</span>
                                <span class="text-sm px-1 text-zinc-800">{{ $profile->profile_last_name }}</span>
                            </div>
                            <div class="py-1 text-left">
                                <span class="text-xs uppercase font-semibold tracking-wider text-zinc-600">nombre:</span>
                                <span class="text-sm px-1 text-zinc-800">{{ $profile->profile_first_name }}</span>
                            </div>
                            <div class="py-1 text-left">
                                <span class="text-xs uppercase font-semibold tracking-wider text-zinc-600">género:</span>
                                <span class="text-sm px-1 text-zinc-800">{{ $profile->profile_gender_name }}</span>
                            </div>
                            <div class="py-1 text-left">
                                <span class="text-xs uppercase font-semibold tracking-wider text-zinc-600">teléfono:</span>
                                <span class="text-sm px-1 text-zinc-800">{{ $profile->profile_phone_number }}</span>
                            </div>
                            <div class="py-1 text-left">
                                <span class="text-xs uppercase font-semibold tracking-wider text-zinc-600">direccion:</span>
                                <span class="text-sm px-1 text-zinc-800">Calle: {{ $profile->profile_address_street }},
                                    numero de calle / altura: {{ $profile->profile_address_number }}</span>
                            </div>
                            @if ($profile->profile_address_house_number !== null)
                                <div class="py-1 text-left">
                                    <span class="text-xs uppercase font-semibold tracking-wider text-zinc-600">Casa:</span>
                                    <span class="text-sm px-1 text-zinc-800">Nro.
                                        {{ $profile->profile_address_house_number }}</span>
                                </div>
                            @endif
                            @if ($profile->profile_address_department_number !== null || $profile->profile_address_floor_number)
                                <div class="py-1 text-left">
                                    <span
                                        class="text-xs uppercase font-semibold tracking-wider text-zinc-600">Departamento:</span>
                                    <span class="text-sm px-1 text-zinc-800">Nro.
                                        {{ $profile->profile_address_department_number ?? '--' }} Piso:
                                        {{ $profile->profile_address_floor_number ?? '--' }}</span>
                                </div>
                            @endif
                            <div class="py-1 text-left">
                                <span class="text-xs uppercase font-semibold tracking-wider text-zinc-600">Localidad:</span>
                                <span class="text-sm px-1 text-zinc-800">{{ $location['value'] }}</span>
                            </div>
                        </div>
                        <div class="flex w-full justify-end items-center">
                            <x-buttons.button-link-zinc href="{{route('edit-profile-student', $user)}}">
                                <i class="fa-solid fa-user-pen mr-1"></i>
                                <span>editar mi perfil</span>
                            </x-buttons.button-link-zinc>
                        </div>
                    </div>
                </div>
            @else
                {{-- perfil, sin completar --}}
                <div
                    class="flex flex-col justify-center items-center w-full ml-3 p-3 overflow-hidden bg-zinc-300 border-2 border-dashed border-zinc-600">
                    <div class="flex flex-col justify-center items-center my-3">
                        <span class="text-base tracking-wider font-bold">Aún no has completado tus datos de perfil.</span>
                        <span class="text-sm tracking-wider font-semibold">Es necesario que completes tus datos
                            personales.</span>
                    </div>
                    <x-buttons.button-link-zinc href="{{route('create-profile-student', $user)}}">
                        <i class="fa-solid fa-address-card mr-1"></i>
                        <span>completar mi perfil</span>
                    </x-buttons.button-link-zinc>
                </div>
            @endif
        </div>
    </div>
@endsection

@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">usuarios: nuevo usuario</h3>
        </div>
    </div>
    <div class="my-2 mx-auto w-1/2 border border-zinc-200">
        {{-- errores --}}

        {{-- formulario --}}
        {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
        <div class="flex">
            {{-- nombre de usuario --}}
            <div class="">
                <x-required-input-label for="name" :value="__('User Name')" title="ingrese un nombre de usuario o nickname" />
                {!! Form::text('name', null, ['class' => 'block mt-1 w-full']) !!}
            </div>
            {{-- email --}}
            <div class="">
                <x-required-input-label for="email" :value="__('Email')"
                    title="ingrese un correo electrónico válido, ejemplo: micorreo@gmail.com" />
                {!! Form::email('email', null, ['class' => 'block mt-1 w-full']) !!}
            </div>
        </div>
        <div class="flex">
            {{-- password --}}
            <div class="">
                <x-required-input-label for="password" :value="__('Password')"
                    title="ingrese una contraseña con minimo 8 caracteres" />
                {!! Form::password('password', ['class' => 'block mt-1 w-full']) !!}
            </div>
            {{-- confirm password --}}
            <div class="">
                <x-required-input-label for="confirm-password" :value="__('Confirm Password')"
                    title="repita la misma contraseña que ingresó" />
                {!! Form::password('confirm-password', ['class' => 'block mt-1 w-full']) !!}
            </div>
        </div>
        <div class="flex">
            {{-- roles --}}
            <div class="mt-4">
                <x-required-input-label for="roles" :value="'Seleccione rol'" />
                {!! Form::select('roles[]', $roles, [], ['class' => 'block mt-1 w-full']) !!}
            </div>
        </div>
        {{-- informacion --}}
        <div class="mt-4 mb-6 py-1 border-b border-gray-300">
            <span class="block font-medium text-sm text-gray-600">mantenga el cursor sobre el icono <i
                    class="fa-solid fa-circle-info"></i> para mas informacion.</span>
        </div>
        {{-- submit --}}
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                Guardar
            </x-primary-button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

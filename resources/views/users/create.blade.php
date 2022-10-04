@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">usuarios: nuevo usuario</h3>
        </div>
    </div>
    <div class="my-2 mx-auto w-1/2 border border-zinc-200">
        {{-- errores --}}
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
        {{-- formulario --}}
        {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
        <div class="flex flex-col items-center justify-center">
            <div class="flex items-center justify-between w-full mt-2 p-2">
                {{-- nombre de usuario --}}
                <div class="w-1/2">
                    <x-required-input-label for="name" :value="__('User Name')" title="ingrese un nombre de usuario o nickname" />
                    {!! Form::text('name', null, ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                </div>
                {{-- email --}}
                <div class="w-1/2 ml-1">
                    <x-required-input-label for="email" :value="__('Email')"
                        title="ingrese un correo electrónico válido, ejemplo: micorreo@gmail.com" />
                    {!! Form::email('email', null, ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                </div>
            </div>
            <div class="flex items-center justify-between w-full mt-2 p-2">
                {{-- password --}}
                <div class="w-1/2">
                    <x-required-input-label for="password" :value="__('Password')"
                        title="ingrese una contraseña con minimo 8 caracteres" />
                    {!! Form::password('password', ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                </div>
                {{-- confirm password --}}
                <div class="w-1/2 ml-1">
                    <x-required-input-label for="confirm-password" :value="__('Confirm Password')"
                        title="repita la misma contraseña que ingresó" />
                    {!! Form::password('confirm-password', ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                </div>
            </div>
            <div class="flex items-center justify-start w-full mt-2 p-2">
                {{-- roles --}}
                <div class="w-1/2">
                    <x-required-input-label for="roles" :value="'Seleccione rol'" 
                        title="Elija el rol que cumplirá esta cuenta"/>
                    {!! Form::select('roles[]', $roles, [], ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                </div>
            </div>
            {{-- informacion --}}
            <div class="w-full mt-2 p-2 border-b border-zinc-300">
                <span class="block font-medium text-sm text-gray-600">mantenga el cursor sobre el icono <i
                        class="fa-solid fa-circle-info"></i> para mas informacion.</span>
            </div>
            {{-- buttons --}}
            <div class="w-full p-2 flex items-center justify-end">
                <x-buttons.button-link-zinc-light href="{{route('users.index')}}" class="mr-2">
                    <i class="fa-solid fa-ban mr-1"></i>
                    <span>cancelar</span>
                </x-buttons.button-link-zinc-light>
                <x-buttons.button-submit-green>
                    <i class="fa-solid fa-floppy-disk mr-1"></i>
                    <span>guardar</span>
                </x-buttons.button-submit-green>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
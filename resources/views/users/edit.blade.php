@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- encabezado --}}
        <div class="bg-zinc-300">
            {{-- titulo de seccion --}}
            <div class="p-1 flex justify-center items-center bg-zinc-400">
                <h3 class="text-sm font-bold text-zinc-800 uppercase inline-block">usuarios: editar usuario</h3>
            </div>
        </div>
        {{-- formulario --}}
        <div class="my-2 mx-auto w-full bg-white border border-zinc-200">
            {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update',$user]]) !!}
            <div class="flex flex-col items-center justify-center">
                <div class="flex items-center justify-between w-full p-2">
                    {{-- email --}}
                    <div class="w-full">
                        <x-required-input-label for="email" :value="__('Email')"
                            title="ingrese un correo electrónico válido, ejemplo: micorreo@gmail.com" />
                        @error('email')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        {!! Form::email('email', null, ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                    </div>
                </div>
                <div class="flex flex-col w-full p-2">
                    {{-- password --}}
                    <div class="w-full">
                        <x-required-input-label for="password" :value="__('Password')"
                            title="ingrese una contraseña con minimo 8 caracteres" />
                        @error('password')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        {!! Form::password('password', ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                    </div>
                    {{-- confirm password --}}
                    <div class="w-full">
                        <x-required-input-label for="confirm-password" :value="__('Confirm Password')"
                            title="repita la misma contraseña que ingresó" />
                        @error('confirm-password')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        {!! Form::password('confirm-password', ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                    </div>
                </div>
                <div class="flex items-center justify-start w-full p-2">
                    {{-- roles --}}
                    <div class="w-1/2">
                        <x-required-input-label for="roles" :value="'Seleccione rol'" 
                            title="Elija el rol que cumplirá esta cuenta"/>
                        @error('roles')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        {!! Form::select('roles[]', $roles, $userRoles, ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                    </div>
                </div>
                {{-- informacion --}}
                <div class="w-full mt-2 p-2 border-b border-zinc-300">
                    <span class="block font-medium text-sm text-gray-600">mantenga el cursor sobre el icono <i
                        class="fa-solid fa-circle-info"></i> para mas informacion.</span>
                    <span class="block font-medium text-sm text-red-600">AVISO! deje los campos de contraseña vacios, para que la cuenta mantenga la misma. O cambie la contraseña definiendo una nueva!</span>
                </div>
                {{-- buttons --}}
                <div class="w-full p-2 flex items-center justify-end">
                    <x-buttons.button-link-zinc-light href="{{route('users.index')}}" class="mr-1">
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
    </div>
@endsection

@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- titulo: --}}
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">mi cuenta: editar</h3>
        </div>
        {{-- formulario: tiene todo el ancho, hasta un maximo de 1280px --}}
        <div class="my-2 mx-auto w-full max-w-7xl border bg-white border-zinc-200">
            {!! Form::model($user, ['method' => 'PUT', 'route' => ['update-account-admin', $user]]) !!}
            <div class="flex flex-col items-center justify-center">
                <div class="flex items-center justify-between w-full p-2">
                    {{-- email --}}
                    <div class="w-full">
                        <x-required-input-label 
                            for="email" 
                            :value="__('Email')"
                            title="ingrese un correo electrónico válido, ejemplo: micorreo@gmail.com"
                        />
                        @error('email')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        {!! Form::email('email', null, ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                    </div>
                </div>
                <div class="flex flex-col w-full p-2">
                    {{-- password --}}
                    <div class="w-full">
                        <x-required-input-label 
                            for="password"
                            :value="__('Password')"
                            title="ingrese una contraseña con minimo 8 caracteres"
                        />
                        @error('password')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        {!! Form::password('password', ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                    </div>
                    {{-- confirm password --}}
                    <div class="w-full">
                        <x-required-input-label 
                            for="confirm-password"
                            :value="__('Confirm Password')"
                            title="repita la misma contraseña que ingresó"
                        />
                        @error('confirm-password')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        {!! Form::password('confirm-password', ['class' => 'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm']) !!}
                    </div>
                </div>
                {{-- informacion --}}
                <div class="w-full mt-2 p-2 border-b border-zinc-300">
                    <span class="block font-medium text-sm text-gray-600">mantenga el cursor sobre el icono <i class="fa-solid fa-circle-info"></i> para mas informacion.</span>
                    <span class="block font-medium text-sm text-red-600">AVISO! deje los campos de contraseña vacios, para que la cuenta mantenga la misma. O cambie la contraseña definiendo una nueva!</span>
                    <span class="block font-medium text-sm text-red-600">AVISO! si cambia su correo electrónico, deberá confirmarlo nuevamente y volver a iniciar sesión!</span>
                </div>
                {{-- buttons --}}
                <div class="w-full p-2 flex items-center justify-end">
                    <x-buttons.button-link-zinc-light href="{{ route('show-profile') }}" class="mr-1">
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
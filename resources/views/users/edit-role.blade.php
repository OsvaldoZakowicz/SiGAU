@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">usuarios: asignar rol a usuario</h3>
        </div>
        <div class="my-2 mx-auto w-1/2 bg-white border border-zinc-200">
            {{-- formulario --}}
            {!! Form::model($user, ['method' => 'PUT', 'route' => ['assign-role', $user]]) !!}
            <div class="flex flex-col items-center justify-center">
                <div class="flex items-center justify-start w-full p-2">
                    <div class="w-full">
                        <span class="text-xs uppercase font-bold text-zinc-600">cuenta:</span>
                        <span class="text-sm text-zinc-800">{{ $user->email }}</span>
                    </div>
                </div>
                <div class="flex items-center justify-start w-full p-2">
                    {{-- roles --}}
                    <div class="w-full">
                        <x-required-input-label for="roles" :value="'Seleccione rol'"
                            title="Elija el rol que cumplirá esta cuenta" />
                        @error('roles')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        {!! Form::select('roles[]', $roles, $userRoles, [
                            'class' =>
                                'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm',
                        ]) !!}
                    </div>
                </div>
                {{-- informacion --}}
                <div class="w-full mt-2 p-2 border-b border-zinc-300">
                    <span class="block font-medium text-sm text-gray-600">mantenga el cursor sobre el icono <i
                            class="fa-solid fa-circle-info"></i> para mas informacion.</span>
                </div>
                {{-- buttons --}}
                <div class="w-full p-2 flex items-center justify-end">
                    <x-buttons.button-link-zinc-light href="{{ route('users.index') }}" class="mr-1">
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

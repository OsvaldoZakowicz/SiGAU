<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center justify-center">
                <h2 class="text-gray-800 text-xl font-semibold">SiGAU</h2>
                <span class="text-gray-600 text-base uppercase">{{__('Reset Password')}}</span>
                <span class="text-gray-600 text-base">Escriba una nueva contraseña para su cuenta.</span>
            </div>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-required-input-label for="email" :value="__('Email')" 
                                title="ingrese el correo electrónico con el que había creado cuenta"/>

                <x-text-input id="email" class="block mt-1 w-full" 
                                type="email" name="email" 
                                :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                {{-- <x-input-label for="password" :value="__('Password')" /> --}}
                <x-required-input-label for="password" :value="__('Password')" 
                                title="ingrese una contraseña nueva con minimo 8 caracteres"/>

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> --}}
                <x-required-input-label for="password_confirmation" :value="__('Confirm Password')" 
                                title="repita la misma contraseña que ingresó"/>

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <!-- informacion -->
            <div class="mt-4 mb-6 py-1 border-b border-gray-300">
                <span class="block font-medium text-sm text-gray-600" >mantenga el cursor sobre el icono <i class="fa-solid fa-circle-info"></i> para mas informacion.</span>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

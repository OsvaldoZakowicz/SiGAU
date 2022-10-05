<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center justify-center">
                <h2 class="text-gray-800 text-xl font-semibold">SiGAU</h2>
                <span class="text-gray-600 text-base uppercase">registrarse como estudiante</span>
                <a href="/" class="underline text-sm text-gray-600 hover:text-gray-900">{{__('Go Home')}}</a>
            </div>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-required-input-label for="name" :value="__('User Name')" 
                                title="ingrese un nombre de usuario o nickname"/>

                <x-text-input id="name" class="block mt-1 w-full" 
                                type="text" name="name" 
                                :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-required-input-label for="email" :value="__('Email')" 
                                title="ingrese un correo electrónico válido, ejemplo: micorreo@gmail.com"/>

                <x-text-input id="email" class="block mt-1 w-full" 
                                type="email" name="email" 
                                :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-required-input-label for="password" :value="__('Password')" 
                                title="ingrese una contraseña con minimo 8 caracteres"/>

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
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
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center justify-center">
                <h2 class="text-gray-800 text-xl font-semibold">SiGAU</h2>
                <span class="text-gray-600 text-base uppercase">{{__("Log in")}}</span>
                <a href="/" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{__("Go Home")}}
                </a>
                <a href="/register" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{__("Register")}}
                </a>
            </div>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-required-input-label for="email" :value="__('Email')" 
                                title="correo electrónico válido" />

                <x-text-input id="email" class="block mt-1 w-full" 
                                type="email" name="email" 
                                :value="old('email')" 
                                required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-required-input-label for="password" :value="__('Password')"
                                title="contraseña de su cuenta" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- informacion -->
            <div class="mt-4 mb-6 py-1 border-b border-gray-300">
                <span class="block font-medium text-sm text-gray-600" >mantenga el cursor sobre el icono <i class="fa-solid fa-circle-info"></i> para mas informacion.</span>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

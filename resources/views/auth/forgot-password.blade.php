<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center justify-center">
                <h2 class="text-gray-800 text-xl font-semibold">SiGAU</h2>
                <span class="text-gray-600 text-base uppercase">{{__('Forgot your password?')}}</span>
                <a href="/" class="underline text-sm text-gray-600 hover:text-gray-900">{{__('Go Home')}}</a>
            </div>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-required-input-label for="email" :value="__('Email')"
                                title="ingrese el correo electrónico con el que había creado cuenta"/>

                <x-text-input id="email" class="block mt-1 w-full" 
                                type="email" name="email" 
                                :value="old('email')" required autofocus />
            </div>

            <!-- informacion -->
            <div class="mt-4 mb-6 py-1 border-b border-gray-300">
                <span class="block font-medium text-sm text-gray-600" >mantenga el cursor sobre el icono <i class="fa-solid fa-circle-info"></i> para mas informacion.</span>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

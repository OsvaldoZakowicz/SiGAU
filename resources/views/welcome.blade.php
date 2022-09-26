<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<title>SiGAU - Welcome</title>

			<!-- Fonts -->
			<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

			<!-- Scripts -->
			@vite(['resources/css/app.css', 'resources/js/app.js'])
			
	</head>
	<body class="antialiased">
		<nav class="bg-white border-b border-gray-100">
			{{-- primary navigatin menu --}}
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="flex justify-between h-16">
					<!-- Logo -->
					{{-- <div class="shrink-0 flex items-center">
							<a href="{{ route('dashboard') }}">
									<x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
							</a>
					</div> --}}

					<div class="flex justify-center items-center space-x-8 sm:-my-px sm:ml-10 text-gray-600">
						<h1>SiGAU</h1>
					</div>

					<!-- Navigation Links -->
					@if (Route::has('login'))
						<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
							@auth
								<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
									{{ __('Dashboard') }}
								</x-nav-link>
							@else
								<x-nav-link :href="route('login')">{{__('Log in')}}</x-nav-link>
								@if (Route::has('register'))
									<x-nav-link :href="route('register')">{{__('Register')}}</x-nav-link>
								@endif
							@endauth
						</div>
					@endif
				</div>
			</div>
		</nav>
		<main>
			{{-- Bienvenida/landing pendiente --}}
		</main>
	</body>
</html>

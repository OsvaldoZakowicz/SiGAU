<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-l text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- vista dashboard de administracion -->
		<div class="flex flex-row">
			<aside class="flex-none w-24 bg-white border-r-2 border-gray-200">
				<p>aside</p>
			</aside>
			<div class="flex-initial bg-white border-gray-200">
				<p>main</p>
			</div>
		</div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<a {{ $attributes->merge(['class' => 'flex items-center justify-center px-2 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
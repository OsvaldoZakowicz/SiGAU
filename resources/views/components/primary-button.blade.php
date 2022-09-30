<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex items-center justify-center px-2 py-1 bg-zinc-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-zinc-700 active:bg-zinc-800 focus:outline-none focus:border-zinc-900 focus:ring ring-zinc-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

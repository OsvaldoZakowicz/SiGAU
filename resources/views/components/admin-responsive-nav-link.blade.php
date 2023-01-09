<a {{ $attributes->merge(['class' => 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-zinc-800 hover:text-zinc-700 hover:bg-zinc-100 hover:border-zinc-300 focus:outline-none focus:text-zinc-800 focus:bg-zinc-100 focus:border-zinc-300 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>
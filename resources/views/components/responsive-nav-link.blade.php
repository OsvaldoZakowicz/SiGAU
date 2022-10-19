@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-zinc-400 text-base font-medium text-zinc-700 bg-zinc-50 focus:outline-none focus:text-zinc-800 focus:bg-zinc-100 focus:border-zinc-700 transition duration-150 ease-in-out'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-zinc-600 hover:text-zinc-800 hover:bg-zinc-50 hover:border-zinc-300 focus:outline-none focus:text-zinc-800 focus:bg-zinc-50 focus:border-zinc-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

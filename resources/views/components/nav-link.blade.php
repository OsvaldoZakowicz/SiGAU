@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center h-6 px-1 pt-1 border-b border-zinc-300 text-sm font-medium text-zinc-700 focus:outline-none focus:border-zinc-300 transition duration-150 ease-in-out'
            : 'flex items-center h-6 px-1 pt-1 border-b border-transparent text-sm font-medium text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 focus:outline-none focus:text-zinc-700 focus:border-zinc-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

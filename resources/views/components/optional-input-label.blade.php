@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium capitalize text-sm text-zinc-700']) }}>
    <div>
        <span>{{ $value ?? $slot }}</span>
        <i class="fa-solid fa-circle-info ml-1"></i>
    </div>
</label>
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium capitalize text-sm text-gray-700']) }}>
    <div>
        <span class="text-red-700">*</span>
        <span>{{ $value ?? $slot }}</span>
        <i class="fa-solid fa-circle-info ml-1"></i>
    </div>
</label>
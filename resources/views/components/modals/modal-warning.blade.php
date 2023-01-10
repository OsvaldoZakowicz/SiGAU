@props(['name','question','message'])
<div x-cloak x-show="dialog" class="absolute inset-x-1/4 w-1/2 flex overflow-hidden bg-white rounded-lg shadow-md">
    {{-- icono --}}
    <div class="flex items-center justify-center w-12 bg-yellow-200 text-zinc-600 text-xl">
        <i class="fa-solid fa-triangle-exclamation"></i>
    </div>
    {{-- cuerpo --}}
    <div class="w-full">
        {{-- datos --}}
        <div class="px-3 py-2 w-full">
            <span class="font-semibold text-lg text-yellow-600">Atención!</span>
            <p class="text-base text-zinc-700 font-bold">{{$question}} <span class="uppercase">{{ $name }}</span> ?</p>
            <p class="text-sm text-zinc-700 mt-1 font-semibold">{{$message}} !</p>
        </div>
        {{$slot}}
    </div>
</div>
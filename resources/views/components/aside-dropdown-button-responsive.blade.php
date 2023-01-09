<button
    x-data="{ toggleIcon : false }"
    x-on:click="toggleIcon = ! toggleIcon"
    x-on:click.outside="toggleIcon = false"
    class="w-full flex items-center justify-center text-md font-medium text-zinc-800 hover:text-zinc-100 hover:border-zinc-300 focus:outline-none focus:text-zinc-100 focus:border-zinc-300 transition duration-150 ease-in-out">
    {{-- titulo e icono del boton --}}
    <div class="w-1/2 flex justify-center items-center">
        {{$slot}}
    </div>
    {{-- boton responsive con el icono dropdown --}}
    <div class="ml-1">
        {{-- dropdown cerrado --}}
        <span x-show="! toggleIcon">
            <i class="fa-solid fa-caret-left"></i>
        </span>
        {{-- dropdown abierto --}}
        <span x-show="toggleIcon">
            <i class="fa-solid fa-caret-down"></i>
        </span>
    </div>
</button>
<button
    x-data="{ toggleIcon : true }"
    x-on:click="toggleIcon = ! toggleIcon"
    title="click para abrir y cerrar"
    class="w-full flex items-center justify-between text-md font-medium text-zinc-800 hover:text-zinc-100 hover:border-zinc-300 focus:outline-none focus:text-zinc-100 focus:border-zinc-300 transition duration-150 ease-in-out">
    {{$slot}}
    <div class="ml-1">
        <span x-show="toggleIcon">
            <i class="fa-solid fa-caret-left"></i>
        </span>
        <span x-show="! toggleIcon">
            <i class="fa-solid fa-caret-down"></i>
        </span>
    </div>
</button>
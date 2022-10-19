<div x-data="{ open: true }">
    <div x-show="open" class="absolute top-0 inset-x-1/4 w-1/2 px-1 p-b-1 z-30 border rounded-md bg-green-300 text-zinc-800">
        <div class="flex items-center justify-between text-base">
            <div>
                <span class="ml-1 font-bold">éxito!:</span>
                {{$slot}}
            </div>
            <span class="mr-1 w-6 flex items-center justify-center">
                <button x-on:click="open = false">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </span>
        </div>
    </div>
</div>
@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- encabezado --}}
        <div class="bg-zinc-300">
            {{-- titulo de seccion --}}
            <div class="p-1 flex justify-center items-center bg-zinc-400">
                <h3 class="text-sm font-bold text-zinc-800 uppercase inline-block">tipos de servicio: editar tipo</h3>
            </div>
        </div>
        {{-- formulario --}}
        <div class="my-2 mx-auto w-full border bg-white border-zinc-200">
            <form action="{{ route('servicetypes.update', $tipoServicio->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-col items-center justify-center">
                    {{-- nombre --}}
                    <div class="w-full mt-2 p-2">
                        <x-required-input-label for="name" :value="'nombre del tipo de servicio'"
                            title="ingrese el nombre del tipo de servicio" />
                        @error('name')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <input name="name" value="{{$tipoServicio->name}}" type="text" required
                            class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                    </div>
                    {{-- descripcion --}}
                    <div class="w-full mt-2 p-2">
                        <x-required-input-label for="description" :value="'descripcion del tipo de servicio'"
                            title="ingrese una descripcion corta sobre el tipo de servicio" />
                        @error('description')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <input name="description" value="{{$tipoServicio->description}}" type="text" required
                            class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                    </div>
                    {{-- informacion --}}
                    <div class="w-full mt-2 p-2 border-b border-zinc-300">
                        <span class="block font-medium text-sm text-gray-600">mantenga el cursor sobre el icono <i class="fa-solid fa-circle-info"></i> para mas informacion.</span>
                        <span class="block font-medium text-sm text-gray-600">el símbolo <span class="text-red-600">*</span> indica datos obligatorios.</span>
                    </div>
                    {{-- buttons --}}
                    <div class="w-full p-2 flex items-center justify-end">
                        <x-buttons.button-link-zinc-light href="{{ route('servicetypes.index') }}" class="mr-2">
                            <i class="fa-solid fa-ban mr-1"></i>
                            <span>cancelar</span>
                        </x-buttons.button-link-zinc-light>
                        <x-buttons.button-submit-green>
                            <i class="fa-solid fa-floppy-disk mr-1"></i>
                            <span>guardar</span>
                        </x-buttons.button-submit-green>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
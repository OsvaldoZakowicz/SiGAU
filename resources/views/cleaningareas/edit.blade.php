@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- encabezado --}}
        <div class="bg-zinc-300">
            {{-- titulo de seccion --}}
            <div class="p-1 flex justify-center items-center bg-zinc-400">
                <h3 class="text-sm font-bold text-zinc-800 uppercase inline-block">área de limpieza: editar área</h3>
            </div>
        </div>
        {{-- formulario --}}
        <div class="my-2 mx-auto w-full border bg-white border-zinc-200">
            <form action="{{ route('cleaningareas.update', $area->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-col items-center justify-center">
                    {{-- nombre --}}
                    <div class="w-full mt-2 p-2">
                        <x-required-input-label for="name" :value="'nombre del área'"
                            title="ingrese el nombre del área de limpieza a crear" />
                        @error('name')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <input name="name" value="{{ $area->name }}" type="text" required
                            class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                    </div>
                    {{-- descripcion --}}
                    <div class="w-full mt-2 p-2">
                        <x-required-input-label for="cleaning_description" :value="'descripcion del área de limpieza'"
                            title="ingrese una descripcion sobre el área de limpieza que va a crear" />
                        @error('cleaning_description')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <textarea required name="cleaning_description" id="cleaning_description" cols="20" rows="10"
                            class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">{{ $area->cleaning_description }}</textarea>
                    </div>
                    <div class="flex w-full mt-2 p-2">
                        <div class="flex w-full">
                            <div class="w-1/2">
                                <x-required-input-label for="cleaning_frequency" :value="'frecuencia esperada de la limpieza'"
                                    title="ingrese la frecuncia con la cual se debe limpiar el área de limpieza." />
                                @error('cleaning_frequency')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input type="number" name="cleaning_frequency" id="cleaning_frequency" min="1" max="10" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm" value="{{$area->cleaning_frequency}}">
                            </div>
                            <div class="w-1/2 ml-2">
                                <x-required-input-label for="cleaning_points" :value="'puntaje obtenible (de 5 pts. a 50 pts.)'"
                                    title="ingrese el puntaje obtenible por completar el área de limpieza." />
                                @error('cleaning_points')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                               <input type="number" step="5" max="50" min="5" name="cleaning_points" id="cleaning_points" value="{{$area->cleaning_points}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                    </div>
                    {{-- informacion --}}
                    <div class="w-full mt-2 p-2 border-b border-zinc-300">
                        <span class="block font-medium text-sm text-gray-600">mantenga el cursor sobre el icono <i
                                class="fa-solid fa-circle-info"></i> para mas informacion.</span>
                    </div>
                    {{-- buttons --}}
                    <div class="w-full p-2 flex items-center justify-end">
                        <x-buttons.button-link-zinc-light href="{{ route('cleaningareas.index') }}" class="mr-2">
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
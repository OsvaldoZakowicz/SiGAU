@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- encabezado --}}
        <div class="bg-zinc-300">
            {{-- titulo de seccion --}}
            <div class="p-1 flex justify-center items-center bg-zinc-400">
                <h3 class="text-sm font-bold text-zinc-800 uppercase inline-block">tdescripcion de ambiente: crear descripcion</h3>
            </div>
        </div>
        {{-- formulario --}}
        <div class="my-2 mx-auto w-full border bg-white border-zinc-200">
            <form action="{{ route('ambientdescriptions.store') }}" method="POST">
                @csrf
                <div class="flex flex-col items-center justify-center">
                    <div class="flex flex-wrap w-full">
                        <div class="flex w-full">
                            {{-- tipo de ambiente --}}
                            <div class="w-1/3 mt-2 p-2">
                                <x-required-input-label 
                                    for=""
                                    :value="'Tipo de Ambiente'"
                                    title="Seleccione el tipo de Ambiente."
                                />
                                @error('ambient_types_id')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <select required name="ambient_types_id" id="" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    {{-- opcion vacia primero --}}
                                    {{-- !OJO, no usar old(''), mezcla la clave y valor del genero en el front --}} 
                                    {{-- !se trata de un key=>value distinto al select de tipo de id donde $key = $value --}}
                                    <option value=""></option>
                                    {{-- listar los generos --}}
                                    @foreach ($tiposAmbiente as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- tama??o del ambiente --}}
                            <div class="w-1/3 mt-2 p-2">
                                <x-required-input-label 
                                    for=""
                                    :value="'Tama??o del Ambiente'"
                                    title="Seleccione un tama??o adecuado para el Ambiente."
                                />
                                @error('size')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <select name="size" id="" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <option value="chico">chico</option>
                                    <option value="mediano">mediano</option>
                                    <option value="grande">grande</option>
                                </select>
                            </div>
                            {{-- cantidad de plazas --}}
                            <div class="w-1/3 mt-2 p-2">
                                <x-required-input-label 
                                    for=""
                                    :value="'Cantidad de lugares del ambiente'"
                                    title="Seleccione la cantidad de becados que caben en el Ambiente, para ambientes habitacion, otros ambientes tienen un espacio de 1 por defecto."
                                />
                                @error('places_quantity')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="number" name="places_quantity" min="1" max="10" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap w-full">
                        <div class="flex w-full">
                            {{-- cantidad de luces --}}
                            <div class="w-1/2 mt-2 p-2">
                                <x-required-input-label 
                                    for=""
                                    :value="'Cantidad de luces'"
                                    title="Seleccione la cantidad de luces que tiene el Ambiente."
                                />
                                @error('lights_quantity')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="number" name="lights_quantity" min="1" max="10" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            {{-- cantidad de tomas de corriente --}}
                            <div class="w-1/2 mt-2 p-2">
                                <x-required-input-label 
                                    for=""
                                    :value="'Cantidad de tomas de corriente'"
                                    title="Seleccione la cantidad de tomas de corriente que tiene el Ambiente."
                                />
                                @error('plugs_quantity')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="number" name="plugs_quantity" min="1" max="10" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
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
                        <x-buttons.button-link-zinc-light href="{{route('ambientdescriptions.index')}}" class="mr-2">
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
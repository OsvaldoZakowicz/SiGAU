@extends('dashboard')
@section('dashboard-content')
<div class="w-full h-max flex flex-col p-1">
    {{-- encabezado --}}
    <div class="bg-zinc-300">
        {{-- titulo de seccion --}}
        <div class="p-1 flex justify-center items-center bg-zinc-400">
            <h3 class="text-sm font-bold text-zinc-800 uppercase inline-block">ambiente: editar un ambiente</h3>
        </div>
    </div>
    {{-- cabecera de informacion general --}}
    <div class="my-2 p-2 mb-4 flex flex-row items-start justify-start border border-zinc-300 border-collapse">
        {{-- casa --}}
        <div class="mr-1 p-2">
            <h4 class="block text-sm uppercase font-semibold tracking-wider text-zinc-600">Informacion de la casa:</h4>
            <div class="flex">
                <div>
                    <div class="flex my-1">
                        <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">casa | edificio:</h4>
                        <span class="text-sm font-bold mx-1 px-1 text-zinc-800">N° {{ $casa->address->house_number }}</span>
                    </div>
                    <div class="flex my-1">
                        <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">dpto. y piso:</h4>
                        <span class="text-sm font-bold mx-1 px-1 text-zinc-800">
                            @if ($casa->address->department_number !== null)
                                <span>dpto:</span>
                                {{ $casa->address->department_number }}
                            @else
                                <span>dpto: - </span>
                            @endif
                            @if ($casa->address->floor_number !== null)
                                <span>piso:</span>
                                {{ $casa->address->floor_number }}
                            @else
                                <span>piso: - </span>
                            @endif
                        </span>
                    </div>
                    <div class="flex my-1">
                        <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">calle y número:</h4>
                        <span class="text-sm font-bold mx-1 px-1 text-zinc-800">
                            {{ $casa->address->street }}
                            {{ $casa->address->street_number }}
                        </span>
                    </div>
                    <div class="flex my-1">
                        <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">cuadra:</h4>
                        <span class="text-sm font-bold mx-1 px-1 text-zinc-800">
                            {{ $casa->block }}
                        </span>
                    </div>
                </div>
                <div>
                    <div class="flex my-1">
                        <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">barrio:</h4>
                        <span class="text-sm font-bold mx-1 px-1 text-zinc-800">
                            {{ $casa->neighborhood }}
                        </span>
                    </div>
                    <div class="flex my-1">
                        <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">direccion:</h4>
                        <span class="text-sm font-bold mx-1 px-1 text-zinc-800">
                            {{ $casa->address->location->name }}
                            {{ $casa->address->location->postal_code }}
                            {{ $casa->address->location->province->name }}
                            {{ $casa->address->location->province->country->name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-2 mx-auto w-full border bg-white border-zinc-200">
        {{-- formulario --}}
        <form action="{{ route('ambients.update', $ambiente->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex flex-col items-center justify-center">
                <div class="flex flex-wrap w-full">
                    <div class="flex w-full">
                        {{-- casa (hidden) --}}
                        <input type="text" name="house_id" value="{{$ambiente->house->id}}" class="hidden">
                        {{-- descripcion de ambiente --}}
                        <div class="w-full mt-2 p-2">
                            <x-required-input-label 
                                for="ambient_description_id"
                                :value="'Tipo de Ambiente'"
                                title="Seleccione el tipo de ambiente que describe al ambiente a crear."
                            />
                            @error('ambient_description_id')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                            <select required name="ambient_description_id" id="ambient_description_id" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                <option selected value="{{$ambiente->id}}">
                                    <span><span>Ambiente:</span>{{$ambiente->ambient_description->ambient_type->name}},</span>
                                    <span><span>tamaño:</span>{{$ambiente->ambient_description->size}},</span>
                                    <span><span>plazas:</span>{{$ambiente->ambient_description->places_quantity}},</span>
                                    <span><span>luces:</span>{{$ambiente->ambient_description->lights_quantity}},</span>
                                    <span><span>tomas:</span>{{$ambiente->ambient_description->plugs_quantity}}.</span>
                                </option>
                                {{-- listar las descripciones de ambiente --}}
                                @foreach ($descripcionesDeAmbiente as $descripcion)
                                    <option value="{{$descripcion->id}}">
                                        <span><span>Ambiente:</span>{{$descripcion->ambient_type->name}},</span>
                                        <span><span>tamaño:</span>{{$descripcion->size}},</span>
                                        <span><span>plazas:</span>{{$descripcion->places_quantity}},</span>
                                        <span><span>luces:</span>{{$descripcion->lights_quantity}},</span>
                                        <span><span>tomas:</span>{{$descripcion->plugs_quantity}}.</span>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                         {{-- cantidad del ambiente--}}
                         <div class="w-1/2 mt-2 p-2">
                            <x-required-input-label 
                                for="quantity"
                                :value="'cantidad'"
                                title="cantidad de ocurrencias de este ambientes en la casa"
                            />
                            @error('quantity')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                            <input type="number" name="quantity" id="quantity" min="1" max="10" value="{{$ambiente->quantity}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
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
                    <x-buttons.button-link-zinc-light href="{{route('houses.show',$casa->id)}}" class="mr-2">
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
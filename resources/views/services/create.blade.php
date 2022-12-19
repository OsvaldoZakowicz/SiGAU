@extends('dashboard')
@section('dashboard-content')
<div class="w-full h-max flex flex-col p-1">
    <div class="mx-2 flex flex-col items-start justify-start">
        <h3 class="text-base text-zinc-800 capitalize">servicio: crear un servicio</h3>
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
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="flex flex-col items-center justify-center">
                <div class="flex flex-wrap w-full">
                    <div class="flex w-full">
                        {{-- casa (hidden) --}}
                        <input type="text" name="house_id" value="{{$casa->id}}" class="hidden">
                        {{-- descripcion de servicio --}}
                        <div class="w-full mt-2 p-2">
                            <x-required-input-label 
                                for="service_description_id"
                                :value="'Tipo de Servicio'"
                                title="Seleccione el tipo de servicio que describe al servicio doméstico a crear."
                            />
                            @error('service_description_id')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                            <select required name="service_description_id" id="service_description_id" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                {{-- opcion vacia primero --}}
                                {{-- !OJO, no usar old(''), mezcla la clave y valor del genero en el front --}} 
                                {{-- !se trata de un key=>value distinto al select de tipo de id donde $key = $value --}}
                                <option value=""></option>
                                {{-- listar las descripciones de servicio --}}
                                @foreach ($descripcionesDeServicio as $descripcion)
                                    <option value="{{$descripcion->id}}">servicio de {{$descripcion->service_type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                         {{-- numero conexion--}}
                         <div class="w-1/2 mt-2 p-2">
                            <x-required-input-label 
                                for="connection_number"
                                :value="'numero de conexión'"
                                title="Ingrese el número de conexión del servicio."
                            />
                            @error('connection_number')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                            <input required type="text" name="connection_number" value="{{old('connection_number')}}" id="connection_number" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                        </div>
                    </div>
                    <div class="flex w-full">
                        {{-- titular de la conexión --}}
                        <div class="w-1/2 mt-2 p-2">
                            <x-required-input-label 
                                for="service_owner"
                                :value="'titular de la conexión'"
                                title="Nombre completo del titular de la conexión."
                            />
                            @error('service_owner')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            <input required type="text" name="service_owner" id="service_owner" value="{{old('service_owner')}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                        </div>
                        {{-- cuit --}}
                        <div class="w-1/2 mt-2 p-2">
                            <x-required-input-label 
                                for="cuit"
                                :value="'CUIT'"
                                title="Clave Única de Identificación Tributaria del Titular"
                            />
                            @error('cuit')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                            <input required type="text" name="cuit" id="cuit" value="{{old('cuit')}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
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
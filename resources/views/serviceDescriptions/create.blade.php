@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">descripcion de servicio: crear descripcion</h3>
        </div>
        <div class="my-2 mx-auto w-full border bg-white border-zinc-200">
            {{-- formulario --}}
            {{-- TODO calculos de dias con JS --}}
            <form action="{{ route('servicedescriptions.store') }}" method="POST">
                @csrf
                <div class="flex flex-col items-center justify-center">
                    <div class="flex flex-wrap w-full">
                        <div class="flex w-full">
                            {{-- tipo de servicio --}}
                            <div class="w-full mt-2 p-2">
                                <x-required-input-label 
                                    for="service_types_id"
                                    :value="'Tipo de Servicio'"
                                    title="Seleccione el tipo de servicio doméstico."
                                />
                                @error('service_types_id')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <select required name="service_types_id" id="" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    {{-- opcion vacia primero --}}
                                    {{-- !OJO, no usar old(''), mezcla la clave y valor del genero en el front --}} 
                                    {{-- !se trata de un key=>value distinto al select de tipo de id donde $key = $value --}}
                                    <option value=""></option>
                                    {{-- listar los tipos de servicio --}}
                                    @foreach ($tiposServicio as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex w-full">
                            {{-- dia de llegada de la boleta --}}
                            <div class="w-1/2 mt-2 p-2">
                                <x-required-input-label 
                                    for="dia_llegada_boleta"
                                    :value="'Dia de llegada de la boleta'"
                                    title="Dia estimado del mes en que llega la boleta a pagar."
                                />
                                @error('dia_llegada_boleta')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <div class="flex justify-start items-center w-full text-xs text-gray-600 uppercase">
                                    <div class="mr-2">
                                        <span>Día: </span>
                                    </div>
                                    <input type="number" name="dia_llegada_boleta" min="1" max="31" class="my-1 p-1 w-64 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <div class="ml-2">
                                        <span> de cada mes.</span>
                                    </div>
                                </div>
                            </div>
                            {{-- dia de pago de la boleta --}}
                            <div class="w-1/2 mt-2 p-2">
                                <x-required-input-label 
                                    for="dia_pago_servicio"
                                    :value="'dia de pago de la boleta'"
                                    title="Dia estimado del mes en que se debe pagar la boleta."
                                />
                                @error('dia_pago_servicio')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <div class="flex justify-start items-center w-full text-xs text-gray-600 uppercase">
                                    <div class="mr-2">
                                        <span>Día: </span>
                                    </div>
                                    <input type="number" name="dia_pago_servicio" min="1" max="31" class="my-1 p-1 w-64 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <div class="ml-2">
                                        <span> de cada mes.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full">
                            {{-- periodo de recaudacion --}}
                            <div class="w-1/2 mt-2 p-2">
                                <x-required-input-label 
                                    for="periodo_recaudacion"
                                    :value="'período de recaudación estimado'"
                                    title="dias estimados desde la llegada de la boleta para la organizacion de los bacados en la recaudación del dinero."
                                />
                                @error('periodo_recaudacion')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <div class="flex justify-start items-center w-full text-xs text-gray-600 uppercase">
                                    <div class="mr-2">
                                        <span>Día: </span>
                                    </div>
                                    <input type="number" name="periodo_recaudacion" min="1" max="31" class="my-1 p-1 w-64 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <div class="ml-2">
                                        <span> de cada mes.</span>
                                    </div>
                                </div>
                            </div>
                            {{-- maximo de boletas adeudables --}}
                            <div class="w-1/2 mt-2 p-2">
                                <x-required-input-label 
                                    for="maximo_pagos_adeudados"
                                    :value="'máximo de boletas adeudables'"
                                    title="Cantidad máxima de boletas adeudables hasta el corte del servicio doméstico"
                                />
                                @error('maximo_pagos_adeudados')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <div class="flex justify-start items-center w-full text-xs text-gray-600 uppercase">
                                    <div class="mr-2">
                                        <span>Máximo de:</span>
                                    </div>
                                    <input type="number" name="maximo_pagos_adeudados" min="1" max="10" class="my-1 p-1 w-64 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <div class="ml-2">
                                        <span>boletas</span>
                                    </div>
                                </div>
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
                        <x-buttons.button-link-zinc-light href="{{route('servicedescriptions.index')}}" class="mr-2">
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
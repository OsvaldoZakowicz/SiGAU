@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- encabezado --}}
        <div class="bg-zinc-300">
            {{-- titulo de seccion --}}
            <div class="p-1 flex justify-center items-center bg-zinc-400">
                <h3 class="text-sm font-bold text-zinc-800 uppercase inline-block">Casas: crear casa</h3>
            </div>
        </div>
        </div>
        {{-- formulario: tiene todo el ancho, hasta un maximo de 1280px --}}
        <div class="my-2 mx-auto w-full max-w-7xl border bg-white border-zinc-200">
            <form action="{{route('houses.store')}}" method="POST">
                @csrf
                <div class="flex flex-col items-center justify-center">
                    <div class="flex flex-col w-full p-1">
                        {{-- direccion numero de casa, piso, departamento --}}
                        <div class="flex flex-col md:flex-row w-full">
                            <div class="w-full px-1">
                                <x-required-input-label 
                                    for="house_number" 
                                    :value="'nro. casa | nro. edificio'"
                                    title="número de casa o edificio."
                                />
                                @error('house_number')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input type="text" name="house_number" id="house_number" value="{{old('house_number')}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            <div class="w-full px-1">
                                <x-optional-input-label 
                                    for="department_number" 
                                    :value="'nro. departamento'"
                                    title="número de departamento o habitación, si vive en un edificio o área de alquileres."
                                />
                                @error('department_number')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input type="text" name="department_number" id="department_number" value="{{old('department_number')}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            <div class="w-full px-1">
                                <x-optional-input-label 
                                    for="floor_number" 
                                    :value="'nro. piso'"
                                    title="número de piso, si vive en un edificio."
                                />
                                @error('floor_number')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input type="text" name="floor_number" id="floor_number" value="{{old('floor_number')}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                        {{-- direccion calle, numero de calle, manzana --}}
                        <div class="flex flex-col md:flex-row w-full">
                            <div class="w-1/2 px-1">
                                <x-required-input-label 
                                    for="street" 
                                    :value="'calle'"
                                    title="nombre de la calle."
                                />
                                @error('street')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="text" name="street" id="street" value="{{old('street')}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            <div class="w-full md:w-1/4 px-1">
                                <x-required-input-label
                                    for="street_number" 
                                    :value="'nro. calle'"
                                    title="número o altura de la calle."
                                />
                                @error('street_number')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="text" name="street_number" id="street_number" value="{{old('street_number')}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            <div class="w-full md:w-1/4 px-1">
                                <x-optional-input-label
                                    for="block" 
                                    :value="'manzana'"
                                    title="número o letra de la manzana."
                                />
                                @error('block')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="text" name="block" id="block" value="{{old('block')}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-1">
                        {{-- barrio --}}
                        <div class="flex flex-col md:flex-row w-full">
                            <div class="w-2/3 px-1">
                                <x-required-input-label 
                                    for="neighborhood"
                                    :value="'barrio | vecindario'"
                                    title="Barrio o vecindario donde está la casa o edificio."
                                />
                                @error('neighborhood')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="text" name="neighborhood" id="neighborhood" value="{{old('neighborhood')}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-1">
                        {{-- localidad, provincia, pais --}}
                        <div class="flex flex-col md:flex-row w-full">
                            <div class="w-2/3 px-1">
                                <x-required-input-label 
                                    for="select_localidad"
                                    :value="'localidad, provincia y pais'"
                                    title="Busque su localidad ingresando su nombre o codigo postal."
                                />
                                @error('location_id')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <select required name="location_id" id="select_localidad" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    {{-- NOTA: debe estar vacio de opciones --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- informacion --}}
                    <div class="w-full mt-2 p-2 border-b border-zinc-300">
                        <span class="block font-medium text-sm text-gray-600">mantenga el cursor sobre el icono <i class="fa-solid fa-circle-info"></i> para mas informacion.</span>
                        <span class="block font-medium text-sm text-gray-600">el símbolo <span class="text-red-600">*</span> indica datos obligatorios.</span>
                    </div>
                    {{-- botones de opcion --}}
                    <div class="w-full p-2 flex items-center justify-end">
                        <x-buttons.button-link-zinc-light href="{{ route('houses.index') }}" class="mr-1">
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

            {{-- scripts select2 --}}
            <script type="text/javascript">
                // CSRF Token
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $(document).ready(function(){
                    $( "#select_localidad" ).select2({
                        ajax: { 
                        url: "{{route('buscar-localidad')}}",
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                _token: CSRF_TOKEN,
                                search: params.term // search term
                            };
                        },
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                        }
                    });
                });
            </script>
        </div>
    </div>
@endsection
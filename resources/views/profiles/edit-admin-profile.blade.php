@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- titulo: --}}
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">mi perfil: editar</h3>
        </div>
        {{-- formulario: tiene todo el ancho, hasta un maximo de 1280px --}}
        <div class="my-2 mx-auto w-full max-w-7xl border bg-white border-zinc-200">

            <form action="{{route('update-profile-admin', $user)}}" method="POST">
                @csrf 
                @method('PUT')
                <div class="flex flex-col items-center justify-center">
                    <div class="flex items-center justify-start w-full p-2">
                        <span class="capitalize text-base text-zinc-600">
                            actualice sus datos personales.
                        </span>
                    </div>
                    <div class="flex w-full p-1">
                        {{-- tipo y numero de identificacion, genero --}}
                        <div class="flex flex-col md:flex-row w-full">
                            <div class="w-full px-1">
                                <x-required-input-label 
                                    for=""
                                    :value="'Tipo de Identificacion'"
                                    title="Seleccione su tipo de identificación personal."
                                />
                                @error('tipo_id')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <select required name="tipo_id" id="" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    {{-- mantener seleccionado el tipo de id establecido --}}
                                    <option selected value="{{$profile->profile_id_type}}">{{$profile->profile_id_type}}</option>
                                    {{-- listar los otros tipos de id --}}
                                    @foreach ($idTypes as $key => $value)
                                        @if ($key !== $profile->profile_id_type)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full px-1">
                                <x-required-input-label 
                                    for=""
                                    :value="'Numero de identificacion'"
                                    title="ingrese su numero de identificación personal completo." 
                                />
                                @error('number_id')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="text" name="number_id" id="" value="{{$profile->profile_id_number}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            <div class="w-full px-1">
                                <x-required-input-label 
                                    for=""
                                    :value="'Género'"
                                    title="Seleccione su genero según está establecido en su identificación personal." 
                                />
                                @error('gender')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <select required name="gender" id="" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    {{-- mantener seleccionado el genero establecido --}}
                                    <option selected value="{{$profile->profile_gender_id}}">{{$profile->profile_gender_name}}</option>
                                    {{-- listar los otros generos --}}
                                    @foreach ($genders as $key => $value)
                                        @if ($key !== $profile->profile_gender_id)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-1">
                        {{-- apellidos, nombres y numero de telefono --}}
                        <div class="flex flex-col md:flex-row w-full">
                            <div class="w-full px-1">
                                <x-required-input-label 
                                    for=""
                                    :value="'apellidos'"
                                    title="ingrese todos sus apellidos."
                                />
                                @error('last_name')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="text" name="last_name" id="" value="{{$profile->profile_last_name}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            <div class="w-full px-1">
                                <x-required-input-label 
                                    for=""
                                    :value="'nombres'"
                                    title="ingrese todos sus nombres."
                                />
                                @error('first_name')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="text" name="first_name" id="" value="{{$profile->profile_first_name}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            <div class="w-full px-1">
                                <x-required-input-label 
                                    for=""
                                    :value="'número de teléfono móvil'"
                                    title="ingrese un numero de teléfono."
                                />
                                @error('phone_number')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="tel" name="phone_number" id="" value="{{$profile->profile_phone_number}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full p-1">
                        {{-- direccion calle y numero --}}
                        <div class="flex flex-col md:flex-row w-full">
                            <div class="w-full px-1">
                                <x-required-input-label 
                                    for="" 
                                    :value="'calle'"
                                    title="nombre de la calle."
                                />
                                @error('street')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="text" name="street" id="" value="{{$profile->profile_address_street}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            <div class="w-full md:w-1/2 px-1">
                                <x-required-input-label
                                    for="" 
                                    :value="'nro. calle'"
                                    title="número o altura de la calle."
                                />
                                @error('street_number')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input required type="text" name="street_number" id="" value="{{$profile->profile_address_number}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                        {{-- direccion numero de casa, piso, departamento --}}
                        <div class="flex flex-col md:flex-row w-full">
                            <div class="w-full px-1">
                                <x-optional-input-label 
                                    for="" 
                                    :value="'nro. casa'"
                                    title="número de casa."
                                />
                                @error('house_number')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input type="text" name="house_number" id="" value="{{$profile->profile_address_house_number}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            <div class="w-full px-1">
                                <x-optional-input-label 
                                    for="" 
                                    :value="'nro. departamento'"
                                    title="número de departamento o habitación, si vive en un edificio o área de alquileres."
                                />
                                @error('department_number')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input type="text" name="department_number" id="" value="{{$profile->profile_address_department_number}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            <div class="w-full px-1">
                                <x-optional-input-label 
                                    for="" 
                                    :value="'nro. piso'"
                                    title="número de piso, si vive en un edificio."
                                />
                                @error('floor_number')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input type="text" name="floor_number" id="" value="{{$profile->profile_address_floor_number}}" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-1">
                        {{-- localidad, provincia, pais --}}
                        <div class="flex flex-col md:flex-row w-full">
                            <div class="w-2/3 px-1">
                                <x-required-input-label 
                                    for=""
                                    :value="'localidad, provincia y pais'"
                                    title="Busque su localidad ingresando su nombre o codigo postal."
                                />
                                @error('localidad')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <select required name="location" id="select_localidad" class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <option value="{{$localidad['id']}}">{{$localidad['value']}}</option>
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
                        <x-buttons.button-link-zinc-light href="{{ route('show-profile') }}" class="mr-1">
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
                $(document).ready(function() {
                    $("#select_localidad").select2({
                        ajax: {
                            url: "{{ route('buscar-localidad') }}",
                            type: "post",
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    _token: CSRF_TOKEN,
                                    search: params.term // search term
                                };
                            },
                            processResults: function(response) {
                                return {
                                    results: response
                                };
                            },
                            cache: false
                        }
                    });
                });
            </script>
        </div>
    </div>
@endsection

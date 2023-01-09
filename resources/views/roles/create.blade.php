@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        {{-- encabezado --}}
        <div class="bg-zinc-300">
            {{-- titulo de seccion --}}
            <div class="p-1 flex justify-center items-center bg-zinc-400">
                <h3 class="text-sm font-bold text-zinc-800 uppercase inline-block">roles: crear rol</h3>
            </div>
        </div>
        {{-- formulario --}}
        <div class="my-2 mx-auto w-full border bg-white border-zinc-200">
            {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
            <div class="flex flex-col items-center justify-center">
                {{-- nombre --}}
                <div class="w-full mt-2 p-2">
                    <x-required-input-label for="name" :value="'nombre del rol'" title="ingrese el nombre del rol a crear" />
                    @error('name')
                        <span class="text-xs text-red-600">{{ $message }}</span>
                    @enderror
                    {!! Form::text('name', null, [
                        'class' =>
                            'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm',
                    ]) !!}
                </div>
                {{-- descripcion --}}
                <div class="w-full mt-2 p-2">
                    <x-required-input-label for="description" :value="'descripcion del rol'"
                        title="ingrese una breve descripcion del rol a crear" />
                    @error('description')
                        <span class="text-xs text-red-600">{{ $message }}</span>
                    @enderror
                    {!! Form::text('description', null, [
                        'class' =>
                            'my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm',
                    ]) !!}
                </div>
                {{-- permisos --}}
                <div class="w-full mt-2 p-2">
                    <x-required-input-label for="" :value="'seleccione los permisos'"
                        title="elija que permisos tendrá el rol a crear, los permisos dan acceso a partes del sistema" />
                    @error('permission')
                        <span class="text-xs text-red-600">{{$message}}</span>
                    @enderror
                    <div class="flex flex-col max-h-48 flex-wrap items-start justify-start mt-1">
                        @foreach ($permission as $item)
                            <div>
                                {!! Form::checkbox('permission[]', $item->id, null, [
                                    'class' =>
                                        'rounded border-zinc-300 text-indigo-600 shadow-sm focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50',
                                ]) !!}
                                <span class="text-sm">{{ $item->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- informacion --}}
                <div class="w-full mt-2 p-2 border-b border-zinc-300">
                    <span class="block font-medium text-sm text-gray-600">mantenga el cursor sobre el icono <i
                            class="fa-solid fa-circle-info"></i> para mas informacion.</span>
                </div>
                {{-- buttons --}}
                <div class="w-full p-2 flex items-center justify-end">
                    <x-buttons.button-link-zinc-light href="{{ route('roles.index') }}" class="mr-2">
                        <i class="fa-solid fa-ban mr-1"></i>
                        <span>cancelar</span>
                    </x-buttons.button-link-zinc-light>
                    <x-buttons.button-submit-green>
                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                        <span>guardar</span>
                    </x-buttons.button-submit-green>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

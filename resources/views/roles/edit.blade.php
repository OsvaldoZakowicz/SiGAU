@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">roles: editar rol</h3>
            <span class="text-sm text-red-500">Al editar el rol <b>{{$role->name}}</b> este cambiará para todos los usuarios que lo tengan, sea cuidadoso!</span>
        </div>
        <div class="my-2 mx-auto w-full border border-zinc-200">
            {{-- formulario, model --}}
            {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}
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
                    <div class="flex flex-col max-h-48 flex-wrap items-start justify-start">
                        @foreach ($permission as $item)
                            <label>
                                {!! Form::checkbox('permission[]', $item->id, in_array($item->id, $rolePermissions) ? true : false, [
                                    'class' =>
                                        'rounded border-zinc-300 text-indigo-600 shadow-sm focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50',
                                ]) !!}
                                <span class="text-sm">{{ $item->name }}</span>
                            </label>
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

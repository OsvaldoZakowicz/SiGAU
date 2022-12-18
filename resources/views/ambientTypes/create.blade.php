@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">tipos de ambiente: crear tipo</h3>
        </div>
        <div class="my-2 mx-auto w-2/3 border bg-white border-zinc-200">
            {{-- formulario --}}
            <form action="{{ route('ambienttypes.store') }}" method="POST">
                @csrf
                <div class="flex flex-col items-center justify-center">
                    {{-- nombre --}}
                    <div class="w-full mt-2 p-2">
                        <x-required-input-label for="name" :value="'nombre del tipo de ambiente'"
                            title="ingrese el nombre del tipo de ambiente a crear" />
                        @error('name')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <input name="name" value="{{old('name')}}" type="text" required
                            class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                    </div>
                    {{-- descripcion --}}
                    <div class="w-full mt-2 p-2">
                        <x-required-input-label for="description" :value="'descripcion del tipo de ambiente'"
                            title="ingrese una descripcion sobre el tipo de ambiente que va a crear" />
                        @error('description')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <input name="description" value="{{old('description')}}" type="text" required
                            class="my-1 p-1 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                    </div>
                    {{-- informacion --}}
                    <div class="w-full mt-2 p-2 border-b border-zinc-300">
                        <span class="block font-medium text-sm text-gray-600">mantenga el cursor sobre el icono <i
                                class="fa-solid fa-circle-info"></i> para mas informacion.</span>
                    </div>
                    {{-- buttons --}}
                    <div class="w-full p-2 flex items-center justify-end">
                        <x-buttons.button-link-zinc-light href="{{ route('ambienttypes.store') }}" class="mr-2">
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

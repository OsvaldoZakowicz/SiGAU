@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">registro de auditoria: cambios</h3>
            <div class="w-full flex items-center justify-end">
                <x-buttons.button-link-zinc-light href="{{ route('audits.index') }}" class="mr-1">
                    <i class="fa-solid fa-rotate-left mr-1"></i>
                    <span>volver al listado</span>
                </x-buttons.button-link-zinc-light>
            </div>
        </div>
        {{-- cabecera de informacion general --}}
        <div class="mx-2 my-2 p-2 mb-4 flex flex-row items-start justify-start border border-zinc-300 border-collapse">
            {{-- informacion de operacion --}}
            <div class="mr-1 p-2">
                <h4 class="block text-sm uppercase font-semibold tracking-wider text-zinc-600">Informacion de la operación:</h4>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">operacion:</h4>
                    <span class="text-sm mx-1 px-1 text-zinc-800 bg-green-300">{{ __($audit->event)}} de datos.</span>
                </div>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">fecha de operación:</h4>
                    <span class="text-sm mx-1 px-1 text-zinc-800">
                        {{ \Carbon\Carbon::parse($audit->created_at)->locale('es_Ar')->format('d-m-Y H:i') }} Hrs.
                    </span>
                </div>
                <div class="flex my-1">
                    <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">tabla afectada:</h4>
                    <span class="text-sm mx-1 px-1 text-zinc-800">
                        {{ __(Str::plural(Str::lower(Str::substr($audit->auditable_type, 11)))) }}
                    </span>
                </div>
            </div>
            {{-- informacion del responsable --}}
            <div class="mr-1 p-2 border-l border-zinc-300">
                @if ($responsable !== null)
                    <h4 class="block text-sm uppercase font-semibold tracking-wider text-zinc-600">Responsable de operación:</h4>
                    <div class="flex my-1">
                        <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">apellido y nombre:</h4>
                        <span class="text-sm mx-1 px-1 text-zinc-800">
                            @if ($responsable->last_name !== null && $responsable->first_name !== null)
                                <span>{{ $responsable->last_name }}, {{ $responsable->first_name }}</span>
                            @else
                                <span class="italic">Este usuario aún no completó su perfil.</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex my-1">
                        <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">cuenta de acceso:</h4>
                        <span class="text-sm mx-1 px-1 text-zinc-800">{{ __($responsable->email) }}</span>
                    </div>
                    <div class="flex my-1">
                        <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">rol:</h4>
                        <span class="text-sm mx-1 px-1 text-zinc-800">{{ __($responsable->role_name) }}</span>
                    </div>
                @else
                    <h4 class="block text-sm uppercase font-semibold tracking-wider text-zinc-600">Responsable de operación:</h4>
                    <div class="flex my-1">
                        <h4 class="block text-sm font-semibold tracking-wider text-zinc-600">apellido y nombre:</h4>
                        <span class="text-sm mx-1 px-1 text-zinc-800">esta operacion no tiene responsable.</span>
                    </div>
                @endif
            </div>
        </div>
        {{-- estado actual del registro a la fecha --}}
        <div class="mx-2 my-1 flex flex-col items-start justify-start">
            <span class="block text-sm font-semibold tracking-wider text-zinc-600"
                title="esta primera tabla detalla el estado de cada atributo del registro segun la fecha de operación">Estado
                del registro a la fecha de cambio: <i class="fa-solid fa-circle-info"></i></span>
        </div>
        <table class="m-2 border border-zinc-300 border-collapse">
            @if (count($audit->new_values) !== 0)
                @foreach ($audit->new_values as $attribute => $value)
                    <tr>
                        <x-tables.th-cell class="text-left w-1/4">{{ __($attribute) }}</x-tables.th-cell>
                        <x-tables.td-cell>{{ $value }}</x-tables.td-cell>
                    </tr>
                @endforeach
            @else
                <tr>
                    <x-tables.td-cell>no existe un estado nuevo.</x-tables.td-cell>
                </tr>
            @endif
        </table>
        {{-- estado anterior del registro --}}
        <div class="mx-2 flex flex-col items-start justify-start">
            <span class="block text-sm font-semibold tracking-wider text-zinc-600"
                title="esta segunda tabla detalla el estado de cada atributo antes de la operación, si existiere">Estado
                anterior: <i class="fa-solid fa-circle-info"></i></span>
        </div>
        <table class="m-2 border border-zinc-300 border-collapse">
            @if (count($audit->old_values) !== 0)
                @foreach ($audit->old_values as $attribute => $value)
                    <tr>
                        {{-- cabecera con estilos especiales --}}
                        <th
                            class="px-1 text-xs text-left w-1/4 border border-zinc-300 uppercase font-bold bg-zinc-400 text-white">
                            {{ __($attribute) }}</th>
                        <x-tables.td-cell>{{ $value }}</x-tables.td-cell>
                    </tr>
                @endforeach
            @else
                <tr>
                    <x-tables.td-cell>no existe un estado anterior.</x-tables.td-cell>
                </tr>
            @endif
        </table>
    </div>
@endsection

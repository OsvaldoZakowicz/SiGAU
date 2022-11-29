@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-zinc-800 capitalize">auditoria: listado de los últimos movimientos</h3>
            {{-- menu de recargar, filtros, busqueda, reporte --}}
            <div class="w-full flex items-end justify-between">
                <x-buttons.button-link-zinc-light href="{{ route('audits.index') }}" class="mr-1" title="refrescar lista">
                    <i class="fa-solid fa-rotate text-zinc-600 mr-1"></i>
                    <span>recargar</span>
                </x-buttons.button-link-zinc-light>
                {{-- formulario de busqueda --}}
                <div class="w-full">
                    <form action="{{route('audits.index')}}" method="GET">
                        <div class="flex items-end">
                            {{-- evento --}}
                            <div class="flex flex-col items-start">
                                <label for="" class="text-sm">Evento</label>
                                <select name="event"
                                    class="w-36 p-0.5 mr-1 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <option value="all">todos</option>
                                    <option value="created">creado</option>
                                    <option value="updated">actualizado</option>
                                    <option value="deleted">eliminado</option>
                                    <option value="restored">restaurado</option>
                                </select>
                            </div>
                            {{-- tabla --}}
                            <div class="flex flex-col items-start">
                                <label for="" class="text-sm">Tabla</label>
                                <select name="table"
                                    class="w-36 p-0.5 mr-1 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <option value="all">todas</option>
                                    @foreach ($tables as $key => $value)
                                        <option value="{{$key}}">{{__($value)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- responsable --}}
                            <div class="flex flex-col items-start">
                                <label for="" class="text-sm">Responsable</label>
                                <select name="responsible"
                                    class="w-36 p-0.5 mr-1 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <option value="all">todos</option>
                                    @foreach ($roles as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- busqueda --}}
                            <div class="flex flex-col items-start w-full mr-1">
                                <label for="" class="text-sm">Buscar por id de registro</label>
                                @error('search')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                <input type="text" name="search" placeholder="buscar ..."
                                    class="p-0.5 w-full rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                            </div>
                            {{-- orden de listado --}}
                            <div class="flex flex-col items-start mr-1">
                                <label for="" class="text-sm">Orden</label>
                                <select name="order"
                                    class="w-36 p-0.5 rounded-md shadow-sm border-zinc-300 focus:border-zinc-300 focus:ring focus:ring-zinc-200 focus:ring-opacity-50 text-sm">
                                    <option value="asc">a&rarr;z</option>
                                    <option value="desc">z&rarr;a</option>
                                </select>
                            </div>
                            {{-- submit --}}
                            <x-buttons.button-submit-green class="ml-1">
                                <i class="fa-solid fa-magnifying-glass mr-1"></i>
                                <span>buscar</span>
                            </x-buttons.button-submit-green>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- informe de busqueda --}}
        @if (count($validated) !== 0)
            <div
                class="mx-2 p-1 flex items-center justify-between mt-2 text-md text-zinc-700 border border-zinc-300 bg-zinc-200">
                <div>
                    <span>filtrado por eventos:
                        <span class="ml-1 font-bold">
                            {{ __($validated['event']) }}
                        </span>
                        <span class="ml-1">sobre tablas:</span>
                        <span class="ml-1 font-bold">
                            @if ($validated['table'] === 'all')
                                {{__($validated['table'])}}
                            @else
                                {{ __(Str::plural(Str::lower(Str::substr($validated['table'], 11)))) }}
                            @endif
                        </span>
                        <span class="ml-1">con responsable:</span>
                        <span class="ml-1 font-bold">
                            {{ __($validated['responsible']) }}
                        </span>
                        @if (array_key_exists('search', $validated))
                            @if ($validated['search'] !== null)
                                <span class="ml-1">con valor de busqueda:</span>
                                <span class="ml-1 font-bold">
                                    {{ $validated['search'] }}
                                </span>
                            @endif
                        @endif
                        <span class="ml-1">ordenado de forma:</span>
                        <span class="ml-1 font-bold">
                            {{ __($validated['order']) }}
                        </span>
                        <span class="ml-1">por fecha de evento</span>
                    </span>
                </div>
                <div>
                    {{-- si hay resultados de busqueda o filtro --}}
                    @if (count($audits) !== 0)
                        {{-- formulario oculto para enviar parametros de reporte --}}
                        <form action="{{route('report-audits')}}" method="GET">
                            <input type="text" name="event" value="{{ $validated['event'] }}" class="hidden">
                            <input type="text" name="table" value="{{ $validated['table'] }}" class="hidden">
                            <input type="text" name="responsible" value="{{ $validated['responsible'] }}" class="hidden">
                            @if (array_key_exists('search', $validated))
                                <input type="text" name="search" value="{{ $validated['search'] }}" class="hidden">
                            @endif
                            <input type="text" name="order" value="{{ $validated['order'] }}" class="hidden">
                            <button type="submit" title="reporte PDF de la tabla">
                                <i class="fa-solid fa-file-pdf text-xl text-red-600"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endif
        {{-- tabla --}}
        <table class="table-auto m-2 border border-zinc-300 border-collapse">
            <thead>
                <tr>
                    <x-tables.th-cell>id</x-tables.th-cell>
                    <x-tables.th-cell>evento</x-tables.th-cell>
                    <x-tables.th-cell>tabla</x-tables.th-cell>
                    <x-tables.th-cell title="indica el identificador del registro afectado por el evento">
                        <span>id registro</span>
                        <i class="fa-solid fa-circle-info ml-1"></i>
                    </x-tables.th-cell>
                    <x-tables.th-cell title="dia-mes-año hora-minuto" >
                        <span>fecha del evento</span>
                        <i class="fa-solid fa-circle-info ml-1"></i>
                    </x-tables.th-cell>
                    {{-- mostrar rol del responsable --}}
                    <x-tables.th-cell title="indica el rol del responsable del evento">
                        <span>responsable</span>
                        <i class="fa-solid fa-circle-info ml-1"></i>
                    </x-tables.th-cell>
                    <x-tables.th-cell>acciones</x-tables.th-cell>
                </tr>
            </thead>
            @if (count($audits) !== 0)
                <tbody>
                    @foreach ($audits as $audit)
                        <tr class="text-sm text-zinc-800">
                            <x-tables.td-cell>{{$audit->id}}</x-tables.td-cell>
                            <x-tables.td-cell>{{__($audit->event)}}</x-tables.td-cell>
                            <x-tables.td-cell>
                                {{__(Str::plural(Str::lower(Str::substr($audit->auditable_type, 11))))}}
                            </x-tables.td-cell>
                            <x-tables.td-cell>{{$audit->auditable_id}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$audit->created_at}}</x-tables.td-cell>
                            <x-tables.td-cell>{{$audit->role_name}}</x-tables.td-cell>
                            <x-tables.td-cell>
                                <a href="{{route('audits.show',$audit->id)}}"
                                    class="mr-1 text-xs uppercase hover:text-sky-500">
                                    <i class="fa-solid fa-eye" title="ver este evento"></i>
                                    <span>ver</span>
                                </a>
                            </x-tables.td-cell>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <tbody>
                    <tr class="text-sm text-red-600">
                        <x-tables.td-cell colspan="6">Sin resultados de busqueda.</x-tables.td-cell>
                    </tr>
                </tbody>
            @endif
        </table>
        {{-- paginacion --}}
        <div class="mx-2">
            {{ $audits->links() }}
        </div>
    </div>
@endsection
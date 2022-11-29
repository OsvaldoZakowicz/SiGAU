@extends('reports.report')
@section('report-content')
    {{-- cabecera y pie fijos, definidos antes del contenido --}}
    <header>
        <table class="header-table border">
            <tr class="header-row border">
                <td rowspan="6" class="header-cell border logo-container" style="width: 120px;">
                    <div class="logo-wrapper">
                        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi0.wp.com%2Fwww.groovytakeon.com%2Fwp-content%2Fuploads%2F2016%2F04%2FHERE.jpg%3Fssl%3D1&f=1&nofb=1&ipt=f187506094c2146a1a7526e707b2a30e07f1c7f7407709446333acbd5179f769&ipo=images"
                            alt="logo" width="100px" height="100px">
                    </div>
                </td>
                <td colspan="3" class="header-cell border title">
                    SiGAU - Sistema de Gestión de Albergues Universitarios.
                </td>
            </tr>
            <tr class="header-row border">
                <td colspan="3" class="header-cell border subtitle">
                    Secretaria de Bienestar Estudiantil - FCEQyN - UNaM.
                </td>
            </tr>
            <tr class="header-row border">
                <td colspan="3" class="header-cell border subtitle">
                    Titulo del reporte: {{$cabeceraReporte['titulo']}}
                </td>
            </tr>
            <tr class="header-row border">
                <td class="header-cell border enphasis">fecha de emision:</td>
                <td colspan="2" class="header-cell border data">
                    {{ $cabeceraReporte['fecha'] }} hrs.
                </td>
            </tr>
            <tr class="header-row border">
                <td class="header-cell border enphasis">emitido por:</td>
                <td colspan="2" class="header-cell border data">
                    <span style="font-weight: 700;">Nombre:</span>{{ $cabeceraReporte['nombre-usuario'] }}, 
                    <span style="font-weight: 700;">Correo: </span>{{ $cabeceraReporte['email-usuario'] }}, 
                    <span style="font-weight: 700;">Rol:</span>
                    <span>
                        @if (count($cabeceraReporte['rol-usuario']) !== 0)
                            <span>{{$cabeceraReporte['rol-usuario'][0]}}</span>
                        @else
                            <span>Super Administrador</span>
                        @endif
                    </span>
                </td>
            </tr>
            <tr class="header-row border">
                <td class="header-cell border enphasis">filtros de busqueda:</td>
                <td colspan="2" class="header-cell border data">
                    <span style="font-weight: 700;">filtrado por eventos:</span>
                    <span style="text-transform: uppercase;">
                        {{ __($validated['event']) }}
                    </span>
                    <span style="font-weight: 700;">sobre tablas:</span>
                    <span style="text-transform: uppercase;">
                        @if ($validated['table'] === 'all')
                            {{__($validated['table'])}}
                        @else
                            {{ __(Str::plural(Str::lower(Str::substr($validated['table'], 11)))) }}
                        @endif
                    </span>
                    <span style="font-weight: 700;">con responsable:</span>
                    <span style="text-transform: uppercase;">
                        {{ __($validated['responsible']) }}
                    </span>
                    @if (array_key_exists('search', $validated))
                        <span style="font-weight: 700;">con valor de busqueda:</span>
                        <span style="text-transform: uppercase;">
                            {{ $validated['search'] }}
                        </span>
                    @endif
                    <span style="font-weight: 700;">ordenado de forma:</span>
                    <span style="text-transform: uppercase;">
                        {{ __($validated['order']) }}
                    </span>
                    <span style="font-weight: 700;">por fecha de evento</span>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <p> SiGAU - Sistema de Gestion de Albergues Universitarios - Copyright &copy; <?php echo date("Y");?></p>
    </footer>

    {{-- espacio de datos dentro de la etiqueta main --}}
    <main>
        <table class="data-table border">
            <thead class="data-table-head border">
                <tr class="data-table__row border">
                    <th class="data-table__row-head border">id</th>
                    <th class="data-table__row-head border">evento</th>
                    <th class="data-table__row-head border">tabla</th>
                    <th class="data-table__row-head border">id registro</th>
                    <th class="data-table__row-head border">fecha del evento</th>
                    <th class="data-table__row-head border">responsable</th>
                </tr>
            </thead>
            <tbody class="data-table-body">
                @foreach ($audits as $audit)
                    <tr class="data-table__row border">
                        <td class="data-table__row-data border">{{$audit->id}}</td>
                        <td class="data-table__row-data border">{{__($audit->event)}}</td>
                        <td class="data-table__row-data border">
                            {{__(Str::plural(Str::lower(Str::substr($audit->auditable_type, 11))))}}
                        </td>
                        <td class="data-table__row-data border">{{$audit->auditable_id}}</td>
                        <td class="data-table__row-data border">{{$audit->created_at}}</td>
                        <td class="data-table__row-data border">{{$audit->role_name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
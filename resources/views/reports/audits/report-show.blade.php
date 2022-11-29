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
                    <span style="font-weight: 700;">ninguno</span>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <p> SiGAU - Sistema de Gestion de Albergues Universitarios - Copyright &copy; <?php echo date("Y");?></p>
    </footer>

    {{-- espacio de datos dentro de la etiqueta main --}}
    <main>
        {{-- cabecera de infornacion general --}}
        <table class="data-table border">
            <thead class="data-table-head border">
                <tr class="data-table__row border">
                    {{-- informacion de operacion --}}
                    <th class="data-table__row-head border">informacion de la operacion</th>
                    {{-- informacion de responsable --}}
                    <th class="data-table__row-head border">informacion del responsable</th>
                </tr>
            </thead>
            <tbody class="data-table-body">
                <tr class="data-table__row border">
                    <td class="data-table__row-data border">
                        <span class="enphasis">operacion:</span>
                        <span>{{__($audit->event)}} de datos.</span>
                    </td>
                    <td class="data-table__row-data border">
                        <span class="enphasis">apellido y nombre:</span>
                        <span class="text-sm mx-1 px-1 text-zinc-800">
                        @if ($responsable !== null)
                            @if ($responsable->last_name !== null && $responsable->first_name !== null)
                                <span>{{ $responsable->last_name }}, {{ $responsable->first_name }}</span>
                            @else
                                <span>Este usuario aún no completó su perfil.</span>
                            @endif
                        @else
                            <span>Esta operacion no tiene responsable.</span>
                        @endif
                        </span>
                    </td>
                </tr>
                <tr class="data-table__row border">
                    <td class="data-table__row-data border">
                        <span class="enphasis">fecha de operacion:</span>
                        <span>{{ \Carbon\Carbon::parse($audit->created_at)->locale('es_Ar')->format('d-m-Y H:i') }} Hrs.</span>
                    </td>
                    <td class="data-table__row-data border">
                        @if ($responsable !== null)
                            <span class="enphasis">cuenta de acceso:</span>
                            <span>{{ __($responsable->email) }}</span>
                        @endif
                    </td>
                </tr>
                <tr class="data-table__row border">
                    <td class="data-table__row-data border">
                        <span class="enphasis">tabla afectada:</span>
                        <span>{{ __(Str::plural(Str::lower(Str::substr($audit->auditable_type, 11)))) }}</span>
                    </td>
                    <td class="data-table__row-data border">
                        @if ($responsable !== null)
                            <span class="enphasis">rol:</span>
                            <span>{{ __($responsable->role_name) }}</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- estado actual del registro a la fecha --}}
        <div style="margin: 10px 0 5px;">
            <span class="data" style="font-size: 12px;">Estado del registro a la fecha de cambio:</span>
        </div>
        <table class="data-table border">
            @if (count($audit->new_values) !== 0)
                @foreach ($audit->new_values as $attribute => $value)
                    <tr class="data-table__row border">
                        <th class="data-table__row-head border" style="width: 30%;">{{ __($attribute) }}</th>
                        <td class="data-table__row-data border data-table-body">{{ $value }}</td>
                    </tr>
                @endforeach
            @else
                <tr class="data-table__row border">
                    <td class="data-table__row-data border data-table-body">no existe un estado nuevo.</td>
                </tr>
            @endif
        </table>

        {{-- estado anterior del registro --}}
        <div style="margin: 10px 0 5px;">
            <span class="data" style="font-size: 12px;">Estado anterior:</span>
        </div>
        <table class="data-table border">
            @if (count($audit->old_values) !== 0)
                @foreach ($audit->old_values as $attribute => $value)
                    <tr class="data-table__row border">
                        <th class="data-table__row-head border" style="width: 30%;">{{ __($attribute) }}</th>
                        <td class="data-table__row-data border data-table-body">{{ $value }}</td>
                    </tr>
                @endforeach
            @else
                <tr class="data-table__row border">
                    <td class="data-table__row-data border data-table-body">no existe un estado anterior.</td>
                </tr>
            @endif
        </table>
    </main>
@endsection
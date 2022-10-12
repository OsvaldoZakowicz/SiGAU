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
                <td colspan="3" class="header-cell border title">SiGAU - Sistema de Gestión de Albergues Universitarios.
                </td>
            </tr>
            <tr class="header-row border">
                <td colspan="3" class="header-cell border subtitle">Secretaria de Bienestar Estudiantil - FCEQyN - UNaM.
                </td>
            </tr>
            <tr class="header-row border">
                <td colspan="3" class="header-cell border subtitle">Titulo del reporte: {{ $cabeceraReporte['titulo'] }}</td>
            </tr>
            <tr class="header-row border">
                <td class="header-cell border enphasis">fecha de emision:</td>
                <td colspan="2" class="header-cell border data">{{ $cabeceraReporte['fecha'] }} hrs.</td>
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
                    <span style="font-weight: 700;">filtrado por columna:</span>
                    <span style="text-transform: uppercase;">{{ __($validated['filtro']) }}</span>
                    @if (array_key_exists('valor', $validated))
                        <span style="font-weight: 700;">con valor de busqueda:</span>
                        <span style="font-style:italic;">"{{ $validated['valor'] }}"</span>
                    @endif
                    <span style="font-weight: 700;">ordenado de forma:</span>
                    <span style="text-transform: uppercase;">{{ __($validated['orden']) }}</span>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <p>SiGAU - Sistema de Gestion de Albergues Universitarios - Copyright &copy; <?php echo date('Y'); ?></p>
    </footer>

    {{-- espacio de datos dentro de la etiqueta main --}}
    <main>
        <table class="data-table border">
            <thead class="data-table-head border">
                <tr class="data-table__row border">
                    <th class="data-table__row-head border">nombre</th>
                    <th class="data-table__row-head border">descripcion</th>
                    <th class="data-table__row-head border">fecha de creacion</th>
                </tr>
            </thead>
            <tbody class="data-table-body">
                @foreach ($roles as $role)
                    <tr class="data-table__row border">
                        <td class="data-table__row-data border">{{ $role->name }}</td>
                        <td class="data-table__row-data border">{{ $role->description }}</td>
                        <td class="data-table__row-data border">{{ $role->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection

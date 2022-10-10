<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- estilos de reporte --}}
    {{-- <style>
        :root {
            --fondo-logo: #e0e1dd;
            --fondo-descripcion: #adb5bd;
            --fondo-cabecera-tabla: #ced4da;
            --fondo-filas-tabla: #dee2e6;
            --bordes: #adb5bd;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        body {
            padding: 1rem;
        }

        .cabecera,
        .descripcion,
        .pie {
            display: block;
            width: 100%;
            border: 1px solid var(--bordes);
            padding: .5rem;
        }

        .cabecera {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .cabecera-logo-wrapper {
            width: 200px;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--fondo-logo);
        }

        .cabecera-informacion {
            width: 100%;
            padding: .5rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .renglon-cabecera {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .datos-cabecera {
            margin: 5px 0;
        }

        .cabecera-informacion__titulo,
        .cabecera-informacion__subtitulo,
        .cabecera-informacion__datos {
            font-weight: 700;
            margin: 5px 0;
        }

        .tabla,
        .descripcion {
            margin: .5rem 0;
        }

        .descripcion {
            background-color: var(--fondo-descripcion);
        }

        .tabla {
            width: 100%;
        }

        .tabla,
        th,
        td {
            border: 1px solid var(--bordes);
            border-collapse: collapse;
        }

        tr {
            height: 1.5rem;
        }

        /* patron cebra por filas (tr), a partir de la cabecera */
        /* usando even: colorea las filas pares */
        /* usando odd: colorea las filas impares */
        tr:nth-child(even) {
            background-color: var(--fondo-filas-tabla);
        }

        th {
            font-size: 1rem;
            background-color: var(--fondo-cabecera-tabla);
        }

        td {
            font-size: .9rem;
            padding: 0 5px;
        }

        .pie {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
    </style> --}}

    <title>SiGAU - Reporte</title>

</head>

<body>
    {{-- cabecera de reporte --}}
    <heder class="cabecera">
        <div class="cabecera-logo-wrapper">
            <div>logo</div>
        </div>
        <div class="cabecera-informacion">
            <div class="renglon-cabecera">
                <h2 class="cabecera-informacion__titulo">Si.G.A.U.</h2>
            </div>
            <div class="renglon-cabecera">
                <h4 class="cabecera-informacion__subtitulo">Reporte de Usuarios&nbsp;</h4>
                {{-- <span class="datos-cabecera">datos</span> --}}
            </div>
            <div class="renglon-cabecera">
                <h4 class="cabecera-informacion__subtitulo">Usuarios Internos del Sistema&nbsp;</h4>
                {{-- <span class="datos-cabecera">datos</span> --}}
            </div>
            <div class="renglon-cabecera">
                <span class="cabecera-informacion__datos">Fecha de Emision:&nbsp;</span>
                <span class="datos-cabecera">datos</span>
            </div>
            <div class="renglon-cabecera">
                <span class="cabecera-informacion__datos">Emitido Por:&nbsp;</span>
                <span
                    class="datos-cabecera">{{ Auth()->user()->name }},&nbsp;{{ Auth()->user()->email }},&nbsp;rol:&nbsp;{{ Auth()->user()->getRoleNames() }}</span>
            </div>
        </div>
    </heder>
    {{-- cuerpo del reporte --}}
    <div class="descripcion">
        <span></span>
    </div>
    @yield('report-content')
    {{-- pie del reporte --}}
    <footer class="pie">
        <p></p>
    </footer>
</body>

</html>

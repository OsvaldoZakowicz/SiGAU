<html>
    {{-- html minimo para un reporte --}}

<head>
    {{-- estilos de reporte --}}
    <style>
        /* margenes de la pagina */
        /* espacios reservados donde incluir la cabecera y pie */
        @page {
            margin: 200px 25px 80px 25px;
        }

        * {
            font-family: Arial, Helvetica, sans-serif;
            color: #353535;
        }

        header {
            position: fixed;
            top: -160px;
            left: 0px;
            right: 0px;
            height: 120px;
            /* border: 1px solid tomato; */
        }

        .header-table {
            width: 100%;
            height: 120px;
            font-size: 14px;
            line-height: 120%;
            border: none;
            padding: 0;
        }

        .logo-container {
            padding: 0;
            border: none;
            box-sizing: border-box;
        }

        .logo-wrapper {
            padding: 0;
            width: 100%;
            height: inherit;
            text-align: center;
        }

        .border {
            border: 1px solid #495057;
            border-collapse: collapse;
        }

        .title {
            background-color: #adb5bd;
            color: #212529;
            font-weight: 700;
        }

        .subtitle {
            background-color: #e9ecef;
            color: #212529;
            font-weight: 700;
        }

        .enphasis {
            font-weight: 700;
        }

        .enphasis,
        .data {
            font-size: 12px;
        }

        footer {
            position: fixed;
            bottom: -40px;
            left: 0px;
            right: 0px;
            height: 30px;
            border: 1px solid #e9ecef;
            text-align: center;
            vertical-align: middle;
            font-weight: 700;
            font-size: 12px;
            text-align: left;
        }

        footer p {
            font-size: 10px;
            margin-left: 25px;
            letter-spacing: .2px;
            color: #495057;
        }

        .data-table {
            width: 100%;
        }

        .data-table-head {
            font-size: 10px;
        }

        .data-table__row-head {
            font-size: 10px;
            letter-spacing: .3px;
            text-transform: uppercase;
            padding: 3px 5px;
            text-align: left;
            background-color: #adb5bd;
        }

        .data-table-body {
            font-size: 12px;
        }

        .data-table tr:nth-child(even) {
            background-color: #e9ecef;
        }

        .data-table__row-data {
            padding: 3px 5px;
            letter-spacing: .2px;
        }
    </style>
</head>

<body>
    {{-- contenido dinamico del reporte --}}
    @yield('report-content')

    {{-- dompdf page number --}}
    {{-- mantener etiqueta script --}}
    <script type="text/php">

        if (isset($pdf)) { 
            //Shows number center-bottom of A4 page with $x,$y values
            $x = 490;  //X-axis i.e. vertical position 
            $y = 795; //Y-axis horizontal position
            $text = "Pagina {PAGE_NUM} de {PAGE_COUNT}";  //format of display message
            $font =  $fontMetrics->get_font("helvetica", "bold");
            $size = 9;
            $color = array(0.2, 0.094, 0.0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }

    </script>
</body>

</html>

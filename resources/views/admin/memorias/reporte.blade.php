<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 200px 25px 50px 50px; /** arriba derecha abajo izquierda**/
            }

            header {
                position: fixed;
                top: -150px;
                left: 0px;
                /*right: 0px;
                height: 150px;
                bottom: 100px;*/
            }
            
        </style>
    </head>
    <body>
        <header>
            <img style="width:30%;" src="data:image/png;base64,{{ $image }}">
            <h2 style="text-align: center;">Reporte de Memorias de las Cátedras</h2>
        </header>

        <main>
            <table style="width: 700px;">
                <?php $c = ""; ?>
                @foreach ($memorias as $m)
                @if($m['anio_academico'].$m['sede'].$m['carrera'] != $c)
                <tr>
                    <td colspan="3" style="text-align:center;  border-width:1px;">
                        <b>AÑO ACADEMICO:    </b> {{ $m['anio_academico']}}
                        <br><b>CARRERA:   </b> {{$m['carrera']}}
                        <br><b>SEDE:   </b> {{$m['sede']}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center; border:1px solid #000;"><b>MATERIA</b> </td>
                    <td style="text-align:center; border:1px solid #000;"><b>EQUIPO DOCENTE </b></td>
                    <td style="text-align:center; border:1px solid #000;"><b>ESTADO</b> </td>
                </tr>
            @endif
            <tr>
            <td style="text-align:left; border:1px solid #000;"> {{$m['catedra']}}</td>
            <td style="text-align:left; border:1px solid #000;"> {{$m['equipo_docente']}}</td>
            <td style="text-align:center; border:1px solid #000;"> {{$m['estado']}}</td>
            </tr>
            <?php 
                $c = $m['anio_academico'].$m['sede'].$m['carrera'];
            ?>
                @endforeach
            </table> 
        </main>
    </body>
</html>
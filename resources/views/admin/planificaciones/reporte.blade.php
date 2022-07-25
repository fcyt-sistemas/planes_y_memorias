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
                @foreach ($plani as $p)
                @if($p['anio_academico'].$p['sede'].$p['carrera'] != $c)
                <tr>
                    <td colspan="3" style="text-align:center;  border-width:1px;">
                        <b>AÑO ACADEMICO:    </b> {{ $p['anio_academico']}}
                        <br><b>CARRERA:   </b> {{$p['carrera']}}
                        <br><b>SEDE:   </b> {{$p['sede']}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center; border:1px solid #000;"><b>MATERIA</b> </td>
                    <td style="text-align:center; border:1px solid #000;"><b>EQUIPO DOCENTE </b></td>
                    <td style="text-align:center; border:1px solid #000;"><b>ESTADO</b> </td>
                </tr>
            @endif
            <tr>
            <td style="text-align:left; border:1px solid #000;"> {{$p['catedra']}}</td>
            <td style="text-align:left; border:1px solid #000;"> {{$p['equipo_docente']}}</td>
            <td style="text-align:center; border:1px solid #000;"> {{$p['estado']}}</td>
            </tr>
            <?php 
                $c = $p['anio_academico'].$p['sede'].$p['carrera'];
            ?>
                @endforeach
            </table> 
        </main>
    </body>
</html>
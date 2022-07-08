<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Programa de contenidos extraído de la Planinificación de cátedra</title>
        <img style="width:30%;" src="data:image/png;base64,{{ $image }}"></img>
    </head>
<body>
    <h3 style="text-align: center;"><b>Reporte de Planificaciones de las Cátedras</b></h3>
    @if(count($plani) === 0)
        <div class="alert alert-success" role="alert">
            No hay elementos cargados
        </div>
    @endif  
    @foreach($plani as $p)
        <br>
        @while(!@empty($p))
            @if($p['anio_academico']==$p['anio_academico'-1] && $p['sede']== $p['sede'-1] &&  $p['carrera']== $p['carrera'-1])
                <table border="1px" style="width: 700px; background: #d3d5db;">
                    <tr>
                        <td style="text-align:center;"><b>MATERIA</b> </td>
                        <td style="text-align:center;"><b>EQUIPO DOCENTE </b></td>
                        <td style="text-align:center;"><b>ESTADO:</b> </td>
                    </tr>
                    <tr> 
                       <td style="text-align:center;"> {{$p['catedra']}}</td>
                       <td style="text-align:center;"> {{$p['equipo_docente']}}</td>
                       <td style="text-align:center;"> {{$p['estado']}}</td>
                    </tr>
                </table>
            @else
                <table border="1px" style="width: 700px; background: #d3d5db;">
                    <tr><td colspan="3" style="text-align:center;"><b>AÑO ACADEMICO:    </b> {{$p['anio_academico']}}</td></tr>
                    <tr><td colspan="3" style="text-align:center;"><b>CARRERA:   </b> {{$p['carrera']}}</td></tr>
                    <tr><td colspan="3" style="text-align:center;"><b>SEDE:   </b> {{$p['sede']}}</td></tr>
                    <tr>
                        <td style="text-align:center;"><b>MATERIA</b> </td>
                        <td style="text-align:center;"><b>EQUIPO DOCENTE </b></td>
                        <td style="text-align:center;"><b>ESTADO:</b> </td>
                    </tr>
                    <tr> 
                       <td style="text-align:center;"> {{$p['catedra']}}</td>
                       <td style="text-align:center;"> {{$p['equipo_docente']}}</td>
                       <td style="text-align:center;"> {{ $p['estado'] }}</td>
                    </tr>
                </table>   
            @endif 
            @endempty
        @endwhile
    @endforeach

</body>
</html>

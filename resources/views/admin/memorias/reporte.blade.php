<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Programa de contenidos extraído de las Memorias de cátedra</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <img style="width:30%;" src="data:image/png;base64,{{ $image }}"></img>
    </head>
    <body>   
        @foreach($memorias as $m)
            <table style="border-width: black">
                <tr><td colspan="3"><b>ESTADO:</b>   
                    @if($m->entregado) {!!link_to_action('MemoriaController@reporte', $title = 'ENTREGADA', $parameters = $m->id, $attributes = ['class'=>'entreg'])!!} @endif
                    @if($m->observado) {!!link_to_action('MemoriaController@reporte', $title = 'REVISADA', $parameters = $m['id'], $attributes = ['class'=>'rev'])!!} @endif 
                    @if($m->aprobado) {!!link_to_action('MemoriaController@reporte', $title = 'APROBADA', $parameters = $m['id'], $attributes = ['class'=>'aprob'])!!} @endif 
                 <br>
                </td></tr>
                <tr><td colspan="3"><b>Carrera:</b> {{$m->carrera->nombre}}<br></td></tr>
                <tr><td colspan="3"><b>Sede:</b> {{$m->sede->nombre}}<br></td></tr>
                <tr>
                    <td><b>Materia:</b> {{$m->catedra->nombre}}<br></td>
                    <td><b>Equipo Docente: </b> {{$m->equipo_docente}}<br></td>
                    <td><b>Año Academico:</b> {{$m->anio_academico}}<br></td>
                </tr>
            </table>      
        @endforeach      
    </body>
</html>

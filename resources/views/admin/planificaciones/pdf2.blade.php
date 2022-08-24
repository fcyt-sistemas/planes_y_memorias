@php
$allowable_tags = '<a><b><i><strong><br><p><em><code><cite><h4><h5><h6><table><th><tr><td>'
@endphp

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Programa de contenidos extraído de la Planinificación de cátedra</title>
    </head>
<body>

<div class="container">
    <img src="{{ asset('images/logo-tr.png') }}">
    &nbsp;&nbsp;&nbsp;{{ config('app.name', 'Laravel') }}
    <br><br>
    <div class="card">
        <div class="card-header">
            Planificación cargada por el docente: {{ $planificaciones->docente->apellidos}}, {{ $planificaciones->docente->nombres}}!<br>
            Carrera: {{$planificaciones->carrera->nombre}} (Plan {{$planificaciones->plan->nombre}}, Resol {{$planificaciones->plan->nro_resolucion}})<br>
            Cátedra: <b>{{$planificaciones->catedra->nombre}}</b><br>
            Año Académico: <b>{{$planificaciones->anio_academico}}</b><br>
            Equipo docente: {{strip_tags($planificaciones->equipo_docente)}}
            <hr><br>
        </div>
        <div class="card-body">
            <strong>Programa de contenidos:</strong><br>
            {!!strip_tags($planificaciones->programa_contenidos, $allowable_tags)!!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Sistema de Evaluación:</strong><br>
            {!!strip_tags($planificaciones->sistema_evaluacion, $allowable_tags)!!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Programa de trabajos prácticos::</strong><br>
            {!!strip_tags($planificaciones->programa_practicos, $allowable_tags)!!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Bibliografía:</strong><br>
            {!!strip_tags($planificaciones->bibliografia, $allowable_tags)!!}
        </div>
    </div>
</div>

</body>
</html>

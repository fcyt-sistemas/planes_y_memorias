@php
$allowable_tags = '<a><b><i><strong><br><p><em><code><cite><table><th><tr><td>'
@endphp

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Reporte completo de Planinificación de cátedra</title>
        
    </head>
<body>
<header><img src="data:image/png;base64,{{ $image }}"></img></header>
<div class="container">
    &nbsp;&nbsp;&nbsp;{{ config('app.name', 'Laravel') }}
    <br><hr>
    <div class="card">
        <div class="card-header">
            Planificación cargada por el docente: {{ $planificaciones->docente->apellidos}}, {{ $planificaciones->docente->nombres}}!<br>
            Sede: {{$planificaciones->sede->nombre}}<br>
            Carrera: {{$planificaciones->carrera->nombre}} (Plan {{$planificaciones->plan->nombre}}, Resol {{$planificaciones->plan->nro_resolucion}})<br>
            Cátedra: <b>{{$planificaciones->catedra->nombre}}</b><br>
            Año Académico: <b>{{$planificaciones->anio_academico}}</b><br>
            Equipo docente: {{strip_tags($planificaciones->equipo_docente)}}
            <hr>
        </div>
        <div class="card-body">
            Año de la carrera a la que pertenece la cátedra: {!!$planificaciones->anio_carrera!!}
        </div>
        <div class="card-body">
        Regimen de la materia: {!!$planificaciones->regimen_materia!!}
        </div>
        <div class="card-body">
            Carga horaria semanal: {!!$planificaciones->carga_horaria!!} horas
        </div><br>
        <div class="card-body">
            <strong>Fundamentación:</strong> {!!$planificaciones->fundamentacion ? '<br>'.strip_tags($planificaciones->fundamentacion, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <div class="card-body">
             <strong>Objetivos: </strong> {!!$planificaciones->objetivos ? '<br>'.strip_tags($planificaciones->objetivos, $allowable_tags) : '<i>'.'No presenta'.'</i>'!!}
        </div>
        <div class="card-body">
            <strong>Programa de contenidos:</strong>
            {!!$planificaciones->programa_contenidos ? '<br>'.strip_tags($planificaciones->programa_contenidos, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Metodología de trabajo y estrategias pedagógicas:</strong>
            {!!$planificaciones->metodologia_trabajo ? '<br>'.strip_tags($planificaciones->metodologia_trabajo, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Sistema de Evaluación:</strong>
            {!!$planificaciones->sistema_evaluacion ? '<br>'.strip_tags($planificaciones->sistema_evaluacion, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Programa de trabajos prácticos:</strong>
            {!!$planificaciones->programa_practicos ? '<br>'.strip_tags($planificaciones->programa_practicos, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Bibliografía:</strong>
            {!!$planificaciones->bibliografia ? '<br>'.strip_tags($planificaciones->bibliografia, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <div class="card-body">
            <strong>Requisitos para rendir como estudiantes regulares, promocionales y libres:</strong>
            {!!$planificaciones->requisitos_rendir ? '<br>'.strip_tags($planificaciones->requisitos_rendir, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Cronograma de trabajo:</strong>
            {!!$planificaciones->cronograma_trabajo ? '<br>'.strip_tags($planificaciones->cronograma_trabajo, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Funciones de cada integrante del equipo de cátedra:</strong>
            {!!$planificaciones->funciones_equipo ? '<br>'.strip_tags($planificaciones->funciones_equipo, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Cronograma de actividades de investigación y/o extensión:</strong>
            {!!$planificaciones->cronograma_actividades ? '<br>'.strip_tags($planificaciones->cronograma_actividades, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Mecanismos de autoevaluación de cátedra:</strong>
            {!!$planificaciones->mecanismos_autoeval ? '<br>'.strip_tags($planificaciones->mecanismos_autoeval, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-footer">
            <i>Revisada en fecha: {!!$planificaciones->fecha_aprobado!!}</i>
        </div>
        <hr><br>
    </div>
</div>
</body>
</html>

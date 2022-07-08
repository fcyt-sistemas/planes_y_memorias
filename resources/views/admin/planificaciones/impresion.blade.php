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
        <img src="data:image/png;base64,{{ $image }}"></img>
    </head>
<body>

<div class="container">
    &nbsp;&nbsp;&nbsp;{{ config('app.name', 'Laravel') }}
    <br><hr>
    <div class="card">
        <div class="card-header">
            Planificación cargada por el docente: {{ $planificacion->docente->apellidos}}, {{ $planificacion->docente->nombres}}!<br>
            Sede: {{$planificacion->sede->nombre}}<br>
            Carrera: {{$planificacion->carrera->nombre}} (Plan {{$planificacion->plan->nombre}}, Resol {{$planificacion->plan->nro_resolucion}})<br>
            Cátedra: <b>{{$planificacion->catedra->nombre}}</b><br>
            Año Académico: <b>{{$planificacion->anio_academico}}</b><br>
            Equipo docente: {{strip_tags($planificacion->equipo_docente)}}
            <hr>
        </div>
        <div class="card-body">
            Año de la carrera a la que pertenece la cátedra: {!!$planificacion->anio_carrera!!}
        </div>
        <div class="card-body">
        Regimen de la materia: {!!$planificacion->regimen_materia!!}
        </div>
        <div class="card-body">
            Carga horaria semanal: {!!$planificacion->carga_horaria!!} horas
        </div><br>
        <div class="card-body">
            <strong>Fundamentación:</strong> {!!$planificacion->fundamentacion ? '<br>'.strip_tags($planificacion->fundamentacion, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <div class="card-body">
             <strong>Objetivos: </strong> {!!$planificacion->objetivos ? '<br>'.strip_tags($planificacion->objetivos, $allowable_tags) : '<i>'.'No presenta'.'</i>'!!}
        </div>
        <div class="card-body">
            <strong>Programa de contenidos:</strong>
            {!!$planificacion->programa_contenidos ? '<br>'.strip_tags($planificacion->programa_contenidos, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Metodología de trabajo y estrategias pedagógicas:</strong>
            {!!$planificacion->metodologia_trabajo ? '<br>'.strip_tags($planificacion->metodologia_trabajo, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Sistema de Evaluación:</strong>
            {!!$planificacion->sistema_evaluacion ? '<br>'.strip_tags($planificacion->sistema_evaluacion, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Programa de trabajos prácticos:</strong>
            {!!$planificacion->programa_practicos ? '<br>'.strip_tags($planificacion->programa_practicos, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Bibliografía:</strong>
            {!!$planificacion->bibliografia ? '<br>'.strip_tags($planificacion->bibliografia, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <div class="card-body">
            <strong>Requisitos para rendir como estudiantes regulares, promocionales y libres:</strong>
            {!!$planificacion->requisitos_rendir ? '<br>'.strip_tags($planificacion->requisitos_rendir, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Cronograma de trabajo:</strong>
            {!!$planificacion->cronograma_trabajo ? '<br>'.strip_tags($planificacion->cronograma_trabajo, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Funciones de cada integrante del equipo de cátedra:</strong>
            {!!$planificacion->funciones_equipo ? '<br>'.strip_tags($planificacion->funciones_equipo, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Cronograma de actividades de investigación y/o extensión:</strong>
            {!!$planificacion->cronograma_actividades ? '<br>'.strip_tags($planificacion->cronograma_actividades, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-body">
            <strong>Mecanismos de autoevaluación de cátedra:</strong>
            {!!$planificacion->mecanismos_autoeval ? '<br>'.strip_tags($planificacion->mecanismos_autoeval, $allowable_tags) : '<i>'.'No presenta'.'</i>' !!}
        </div>
        <hr><br>
        <div class="card-footer">
            <i>Revisada en fecha: {!!$planificacion->fecha_aprobado!!}</i>
        </div>
        <hr><br>
    </div>
</div>
</body>
</html>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Reporte de impresión completa de Memoria de Cátedra</title>
    </head>
<body>

<div class="container">
    <img src="{{ asset('images/logo-tr.png') }}">
    &nbsp;&nbsp;&nbsp;{{ config('app.name', 'Laravel') }}
    <br><br>
    <div class="card">
        <div class="card-header">
            Memoria de cátedra cargada por el docente: {{ $memoria->docente->apellidos}}, {{ $memoria->docente->nombres}}!<br>
            Sede: {{$memoria->sede->nombre}}<br>
            Carrera: {{$memoria->carrera->nombre}} (Plan {{$memoria->plan->nombre}}, Resol {{$memoria->plan->nro_resolucion}})<br>
            Cátedra: <b>{{$memoria->catedra->nombre}}</b><br>
            Año Académico: <b>{{$memoria->anio_academico}}</b><br>
            Equipo docente: {{strip_tags($memoria->equipo_docente)}}<hr>
        </div>
        <div class="card-body">
            Año de la carrera a la que pertenece la cátedra: {!!$memoria->anio_carrera!!} <br>
            Regimen de la materia: {!!$memoria->regimen_materia!!}<br>
            Carga horaria semanal: {!!$memoria->carga_horaria!!} horas<hr>
        </div>
        <div class="card-body">
            Ajustes a la planificación original: <br> {!!$memoria->ajus_plani_original!!} <hr>
        </div>
        <div class="card-body">
            Datos de organización y promoción de la Cátedra: <hr>
        </div>
        <div class="card-body">
            Nº de alumnos que cursaron la asignatura:
            {!!$memoria->alu_cursaron!!}
        </div>
        <br>
        <div class="card-body">
            Nº de alumnos que iniciaron el año como alumnos regulares:
            {!!$memoria->alu_ini_regulares!!}
        </div>
        <br>
        <div class="card-body">
            Nº de alumnos que regularizaron la materia al finalizar el periodo lectivo:
            {!!$memoria->alu_regularizaron!!}
        </div>
        <br>
        <div class="card-body">
            Nº de alumnos que abandonaron la materia al finalizar el periodo lectivo:
            {!!$memoria->alu_abndonaron!!}
        </div>
        <br>
        <div class="card-body">
            Nº de alumnos que promocionaron la materia al finalizar el periodo lectivo:
            {!!$memoria->alu_promocionaron!!}
        </div>
        <br>
        <div class="card-body">
            Nº de clases desarrolladas en el periodo lectivo:
            {!!$memoria->clases_desarrolladas!!}
        </div>
        <br>
        <div class="card-body">
            Nº de recuperatorios realizados en el periodo lectivo:
            {!!$memoria->recup_realizadas!!}
        </div>
        <hr><br>
        <div class="card-body">
            Consideraciones sobre el régimen de cursado y promoción:<br>
            {!!$memoria->regimen_curs_promo!!}
        </div>
        <div class="card-body">
            Consideraciones sobre condiciones de desarrollo de los espacios curriculares:<br>
            {!!$memoria->cond_des_esp_curri!!}
        </div>
        <hr><br>
        <div class="card-body">
            Requisitos para rendir como estudiantes regulares, promocionales y libres:<br>
            {!!$memoria->cumpl_req_rendir!!}
        </div>
        <hr><br>
        <div class="card-body">
           Cronograma de trabajo:<br>
            {!!$memoria->cumpl_cron_trabajo!!}
        </div>
        <hr><br>
        <div class="card-body">
            Funciones de cada integrante del equipo de cátedra:<br>
            {!!$memoria->cumpl_equipo_catedra!!}
        </div>
        <hr><br>
        <div class="card-body">
            Mecanismos de autoevaluación de cátedra:<br>
            {!!$memoria->cumpl_mecan_autoeval!!}
        </div>
        <hr><br>
    </div>
</div>
</body>
</html>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-12">
        <style>
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }
            
            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                /** Extra personal styles **/
                color: black;
            }
            footer {
                position: fixed;
                bottom: 0cm;
                right: 0cm;
                /**height: 2cm;
                /** Extra personal styles **/
                color: black;
            }
        </style>
    </head>
<body>
    <header>
        <table style="width:100%;">
            <tr>
                <td><img style="width:30%;" src="data:image/png;base64,{{ $image }}"></img></td>
                <td style="width:48%; text-align: right; font-size:12px;">
                        <b>Sede:</b> {{$memoria->sede->nombre}}<br>
                        <b>Carrera:</b> {{$memoria->carrera->nombre}}<br>
                        <b>Cátedra:</b> {{$memoria->catedra->nombre}}<br>
                </td>
            </tr>
        </table>
        
    </header>
    <footer>
        <table style="width:100%;">
            <tr>
                <td style="width:48%; text-align: left; font-size:12px;">
                    <b>Equipo docente:</b> {{strip_tags($memoria->equipo_docente)}}
                </td style="width:48%; text-align: right; font-size:12px;">
                
            </tr>
        </table>
    </footer>
    <div class="container">
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
        </div>
        <hr><br>
    </div>
    
</div>

</body>

</html>

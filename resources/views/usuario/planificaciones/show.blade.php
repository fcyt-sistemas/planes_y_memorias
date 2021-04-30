@extends('layouts.app')
@section('content')
<script>
	tinymce.init({
	    selector:'textarea', 
	    menubar: false,
	    language: 'es',
	    branding: false,
	    //toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	    toolbar:false,
	    readonly: 1
	});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Planificación cargada por el docente {{ $planificacion->docente->apellidos}}, {{ $planificacion->docente->nombres}}! </div>
                  <div class="card-body">
					{!! Form::model($planificacion,['route'=>['planificacion.index',$planificacion->id], 'method' => 'PUT'])!!}
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Sede:</label>
					  </div>
					  {!! Form::select('sede_id',$sedes, null,['placeholder'=>'Seleccione una sede...','disabled' => 'disabled'] ) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Carrera:</label>
					  </div>
					  {!! Form::select('carrera_id',$carreras, null,['placeholder'=>'Seleccione una carrera','disabled' => 'disabled'] ) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Plan de estudios:</label>
					  </div>
					  {!! Form::select('plan_id',$planes,null, ['placeholder'=>'Seleccione un plan','disabled' => 'disabled']) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Catedra:</label>
					  </div>
					  {!! Form::select('catedra_id', $catedras,null, ['placeholder'=>'Seleccione una cátedra','disabled' => 'disabled']) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Año académico:</label>
					  </div>
					  {!! Form::number('anio_academico',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('equipo_docente', 'Equipo docente:') !!}
						{!! Form::textarea('equipo_docente', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!}
						@if ($planificacion->equipo_docente_obs) {!!Form::text('equipo_docente_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text">Año de la carrera a la que pertenece la cátedra:</span>
						  </div>
						  {!! Form::number('anio_carrera',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						  @if ($planificacion->anio_carrera_obs) {!!Form::text('anio_carrera_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="regimen_materia">Regimen de la materia:</label>
					  </div>
					  {!! Form::select('regimen_materia', ['Trimestral','Cuatrimestral','Semestral','Anual'],null, ['class'=>'form-control','disabled' => 'disabled','placeholder'=>'Seleccione...']) !!}
					  @if ($planificacion->regimen_materia_obs) {!!Form::text('regimen_materia_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text">Carga horaria semanal:</span>
						  </div>
						  {!! Form::number('carga_horaria',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						  @if ($planificacion->carga_horaria_obs) {!!Form::text('carga_horaria_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					
					<div class="form-group">
						{!! Form::label('fundamentacion', 'Fundamentación:') !!}
						{!! Form::textarea('fundamentacion', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->fundamentacion_obs) {!!Form::text('fundamentacion_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('objetivos', 'Objetivos:') !!}
						{!! Form::textarea('objetivos', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->objetivos_obs) {!!Form::text('objetivos_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('programa_contenidos', 'Programa de contenidos:') !!}
						{!! Form::textarea('programa_contenidos', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->programa_contenidos_obs) {!!Form::text('programa_contenidos_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('metodologia_trabajo', 'Metodología de trabajo y estrategias pedagógicas:') !!}
						{!! Form::textarea('metodologia_trabajo', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->metodologia_trabajo_obs) {!!Form::textarea('metodologia_trabajo_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('sistema_evaluacion', 'Sistema de evaluación:') !!}
						{!! Form::textarea('sistema_evaluacion', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->sistema_evaluacion_obs) {!!Form::text('sistema_evaluacion_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('programa_practicos', 'Programa de trabajos prácticos:') !!}
						{!! Form::textarea('programa_practicos', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->programa_practicos_obs) {!!Form::text('programa_practicos_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('bibliografia', 'Bibliografía:') !!}
						{!! Form::textarea('bibliografia', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->bibliografia_obs) {!!Form::text('bibliografia_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('requisitos_rendir', 'Requisitos para rendir como estudiantes regulares, promocionales y libres:') !!}
						{!! Form::textarea('requisitos_rendir', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->requisitos_rendir_obs) {!!Form::text('requisitos_rendir_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cronograma_trabajo', 'Cronograma de trabajo:') !!}
						{!! Form::textarea('cronograma_trabajo', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->cronograma_trabajo_obs) {!!Form::text('cronograma_trabajo_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('funciones_equipo', 'Funciones de cada integrante del equipo de cátedra:') !!}
						{!! Form::textarea('funciones_equipo', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->funciones_equipo_obs) {!!Form::text('funciones_equipo_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cronograma_actividades', 'Cronograma de actividades de investigación y/o extensión:') !!}
						{!! Form::textarea('cronograma_actividades', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->cronograma_actividades_obs) {!!Form::text('cronograma_actividades_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('mecanismos_autoeval', 'Mecanismos de autoevaluación de cátedra:') !!}
						{!! Form::textarea('mecanismos_autoeval',null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($planificacion->mecanismos_autoeval_obs) {!!Form::text('mecanismos_autoeval_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="btn-group" role="group">
			            <div class="btn">
  				        	{!!link_to_route('planificacion.index', $title = 'Aceptar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
			            <div class="btn">
  				        @if ($planificacion->observado and !$planificacion->aprobado and !$planificacion->prox_version<>null)
  				        {!!link_to_action('PlanificacionController@duplicar', $title = 'Generar una Nueva Versión', $parameters = $planificacion->id, $attributes = ['class'=>'btn btn-primary'])!!} @endif
						</div>
		            </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>

@endsection

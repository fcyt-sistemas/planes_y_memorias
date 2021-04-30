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
                <div class="card-header">Memoria de cátedra cargada por el docente {{ $memoria->docente->apellidos}}, {{ $memoria->docente->nombres}}! </div>
                  <div class="card-body">
                  	{!! Form::model($memoria,['route'=>['memorias.update',$memoria->id], 'method' => 'PUT'])!!}
							
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Sede:</label>
					  </div>
					  {!! Form::select('sede_id',$sedes, null,['disabled' => 'disabled'] ) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="carrera_id">Carrera:</label>
					  </div>
					  {!! Form::select('carrera_id',$carreras, null,['disabled' => 'disabled'] ) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="plan_id">Plan de estudios:</label>
					  </div>
					  {!! Form::select('plan_id',$planes,null, ['disabled' => 'disabled']) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="catedra_id">Catedra:</label>
					  </div>
					  {!! Form::select('catedra_id', $catedras,null, ['disabled' => 'disabled']) !!}
					</div>
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Anio académico de la Memoria:</span>
						  </div>
						  {!! Form::number('anio_academico',null, ['class'=>'form-control', 'disabled' => 'disabled']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('equipo_docente', 'Equipo docente:') !!}
						{!! Form::textarea('equipo_docente',null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!}
						@if ($memoria->equipo_docente_obs) {!!Form::text('equipo_docente_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Anio año de la carrera en que se dictó:</span>
						  </div>
						  {!! Form::number('anio_carrera',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						  @if ($memoria->anio_carrera_obs) {!!Form::text('anio_carrera_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="regimen_materia">Regimen de la materia:</label>
					  </div>
					  {!! Form::select('regimen_materia', ['Trimestral','Cuatrimestral','Semestral','Anual'],null, ['class'=>'form-control','disabled' => 'disabled']) !!}
					  @if ($memoria->regimen_materia_obs) {!!Form::text('regimen_materia_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Carga horaria semanal:</span>
						  </div>
						  {!! Form::number('carga_horaria',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						  @if ($memoria->carga_horaria_obs) {!!Form::text('carga_horaria_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('ajus_plani_original', 'Ajustes a la planificación original:') !!}
						{!! Form::textarea('ajus_plani_original',null, ['class'=>'form-control', 'rows'=>'6', 'disabled' => 'disabled']) !!}
						@if ($memoria->ajus_plani_original_obs) {!!Form::text('ajus_plani_original_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>

					<div class="card bg-light mb-3">
					  <div class="card-header">
					  	Datos de organización y promoción de la Cátedra:
					  </div>
					  <div class="card-body">
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que cursaron la asignatura:</span>
						  </div>
						  {!! Form::number('alu_cursaron',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						  @if ($memoria->alu_cursaron_obs) {!!Form::text('alu_cursaron_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que iniciaron el año como alumnos regulares:</span>
						  </div>
						  {!! Form::number('alu_ini_regulares',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						@if ($memoria->alu_ini_regulares_obs) {!!Form::text('alu_ini_regulares_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que regularizaron la materia al finalizar el periodo lectivo:</span>
						  </div>
						  {!! Form::number('alu_regularizaron',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						@if ($memoria->alu_regularizaron_obs) {!!Form::text('alu_regularizaron_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que abandonaron la materia al finalizar el periodo lectivo:</span>
						  </div>
						  {!! Form::number('alu_abndonaron',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						@if ($memoria->alu_abndonaron_obs) {!!Form::text('alu_abndonaron_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que promocionaron la materia al finalizar el periodo lectivo:</span>
						  </div>
						  {!! Form::number('alu_promocionaron',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						@if ($memoria->alu_promocionaron_obs) {!!Form::text('alu_promocionaron_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de clases desarrolladas en el periodo lectivo:</span>
						  </div>
						  {!! Form::number('clases_desarrolladas',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						@if ($memoria->clases_desarrolladas_obs) {!!Form::text('clases_desarrolladas_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de recuperatorios realizados en el periodo lectivo:</span>
						  </div>
						  {!! Form::number('recup_realizadas',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
							@if ($memoria->recup_realizadas_obs) {!!Form::text('recup_realizadas_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
					</div>
					</div>
					<div class="form-group">
						{!! Form::label('regimen_curs_promo', 'Consideraciones sobre el régimen de cursado y promoción:') !!}
						{!! Form::textarea('regimen_curs_promo',null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($memoria->regimen_curs_promo_obs) {!!Form::text('regimen_curs_promo_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cond_des_esp_curri', 'Consideraciones sobre condiciones de desarrollo de los espacios curriculares:') !!}
						{!! Form::textarea('cond_des_esp_curri',null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($memoria->cond_des_esp_curri_obs) {!!Form::text('cond_des_esp_curri_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_req_rendir', 'Requisitos para rendir como estudiantes regulares, promocionales y libres:') !!}
						{!! Form::textarea('cumpl_req_rendir',null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($memoria->cumpl_req_rendir_obs) {!!Form::text('cumpl_req_rendir_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_cron_trabajo', 'Cronograma de trabajo:') !!}
						{!! Form::textarea('cumpl_cron_trabajo',null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($memoria->cumpl_cron_trabajo_obs) {!!Form::text('cumpl_cron_trabajo_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_equipo_catedra', 'Funciones de cada integrante del equipo de cátedra:') !!}
						{!! Form::textarea('cumpl_equipo_catedra',null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($memoria->cumpl_equipo_catedra_obs) {!!Form::text('cumpl_equipo_catedra_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_mecan_autoeval', 'Mecanismos de autoevaluación de cátedra:') !!}
						{!! Form::textarea('cumpl_mecan_autoeval',null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						@if ($memoria->cumpl_mecan_autoeval_obs) {!!Form::text('cumpl_mecan_autoeval_obs', null, ['class'=>'form-control comment', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>

					<div class="btn-group" role="group">
			            <div class="btn-group">
  				        	{!!link_to_route('memorias', $title = 'Aceptar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
						<div class="btn-group">
  				        	{!!link_to_route('memoria.impresion', $title = 'Imprimir completa', $parameters = $memoria->id, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
		            </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>

@endsection

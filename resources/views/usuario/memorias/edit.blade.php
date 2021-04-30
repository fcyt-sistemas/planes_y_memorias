@extends('layouts.app')
@section('content')
<script>
    tinymce.init({
        selector:'textarea', 
        menubar: false,
        language: 'es',
        branding: false,
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    });
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Memoria de cátedra para el Docente: {{ Auth::user()->name}}!</div>
                  <div class="card-body">
					@include('errors')
					{!! Form::model($memoria,['route'=>['memorias.update',$memoria->id], 'method' => 'PUT'])!!}
					{!! Form::hidden('docente_id', Auth::user()->docente->id) !!}
					
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Sede:</label>
					  </div>
					  {!! Form::select('sede_id',$sedes, null,['placeholder'=>'Seleccione una sede...'] ) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="carrera_id">Carrera:</label>
					  </div>
					  {!! Form::select('carrera_id',$carreras, null,['placeholder'=>'Seleccione una carrera...'] ) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="plan_id">Plan de estudios:</label>
					  </div>
					  {!! Form::select('plan_id',$planes,null, ['placeholder'=>'Seleccione un plan...']) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="catedra_id">Catedra:</label>
					  </div>
					  {!! Form::select('catedra_id', $catedras,null, ['placeholder'=>'Seleccione una cátedra']) !!}
					</div>
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Anio académico de la Memoria:</span>
						  </div>
						  {!! Form::number('anio_academico',null, ['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('equipo_docente', 'Equipo docente:') !!}
						{!! Form::textarea('equipo_docente',null, ['class'=>'form-control', 'rows'=>'3']) !!}
						@if ($memoria->equipo_docente_obs) {!!Form::textarea('equipo_docente_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Anio año de la carrera en que se dictó:</span>
						  </div>
						  {!! Form::number('anio_carrera',1, ['class'=>'form-control']) !!}
						  @if ($memoria->anio_carrera_obs) {!!Form::textarea('anio_carrera_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="regimen_materia">Regimen de la materia:</label>
					  </div>
					  {!! Form::select('regimen_materia', ['Trimestral','Cuatrimestral','Semestral','Anual'],null, ['class'=>'form-control','placeholder'=>'Seleccione...']) !!}
					  @if ($memoria->regimen_materia_obs) {!!Form::textarea('regimen_materia_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Carga horaria semanal:</span>
						  </div>
						  {!! Form::number('carga_horaria',null, ['class'=>'form-control']) !!}
						  @if ($memoria->carga_horaria_obs) {!!Form::textarea('carga_horaria_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('ajus_plani_original', 'Ajustes a la planificación original:') !!}
						{!! Form::textarea('ajus_plani_original',null, ['class'=>'form-control', 'rows'=>'6']) !!}
						@if ($memoria->ajus_plani_original_obs) {!!Form::textarea('ajus_plani_original_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
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
						  {!! Form::number('alu_cursaron',null, ['class'=>'form-control']) !!}
						  @if ($memoria->alu_cursaron_obs) {!!Form::textarea('alu_cursaron_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que iniciaron el año como alumnos regulares:</span>
						  </div>
						  {!! Form::number('alu_ini_regulares',null, ['class'=>'form-control']) !!}
						@if ($memoria->alu_ini_regulares_obs) {!!Form::textarea('alu_ini_regulares_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que regularizaron la materia al finalizar el periodo lectivo:</span>
						  </div>
						  {!! Form::number('alu_regularizaron',null, ['class'=>'form-control']) !!}
						@if ($memoria->alu_regularizaron_obs) {!!Form::textarea('alu_regularizaron_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que abandonaron la materia al finalizar el periodo lectivo:</span>
						  </div>
						  {!! Form::number('alu_abndonaron',null, ['class'=>'form-control']) !!}
						@if ($memoria->alu_abndonaron_obs) {!!Form::textarea('alu_abndonaron_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que promocionaron la materia al finalizar el periodo lectivo:</span>
						  </div>
						  {!! Form::number('alu_promocionaron',null, ['class'=>'form-control']) !!}
						@if ($memoria->alu_promocionaron_obs) {!!Form::textarea('alu_promocionaron_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de clases desarrolladas en el periodo lectivo:</span>
						  </div>
						  {!! Form::number('clases_desarrolladas',null, ['class'=>'form-control']) !!}
						@if ($memoria->clases_desarrolladas_obs) {!!Form::textarea('clases_desarrolladas_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de recuperatorios realizados en el periodo lectivo:</span>
						  </div>
						  {!! Form::number('recup_realizadas',null, ['class'=>'form-control']) !!}
							@if ($memoria->recup_realizadas_obs) {!!Form::textarea('recup_realizadas_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
						</div>
					</div>
					</div>
					<div class="form-group">
						{!! Form::label('regimen_curs_promo', 'Consideraciones sobre el régimen de cursado y promoción:') !!}
						{!! Form::textarea('regimen_curs_promo',null, ['class'=>'form-control', 'rows'=>'6']) !!}
						@if ($memoria->regimen_curs_promo_obs) {!!Form::textarea('regimen_curs_promo_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cond_des_esp_curri', 'Consideraciones sobre condiciones de desarrollo de los espacios curriculares:') !!}
						{!! Form::textarea('cond_des_esp_curri',null, ['class'=>'form-control', 'rows'=>'6']) !!}
						@if ($memoria->cond_des_esp_curri_obs) {!!Form::textarea('cond_des_esp_curri_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_req_rendir', 'Requisitos para rendir como estudiantes regulares, promocionales y libres:') !!}
						{!! Form::textarea('cumpl_req_rendir',null, ['class'=>'form-control', 'rows'=>'6']) !!}
						@if ($memoria->cumpl_req_rendir_obs) {!!Form::textarea('cumpl_req_rendir_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_cron_trabajo', 'Cronograma de trabajo:') !!}
						{!! Form::textarea('cumpl_cron_trabajo',null, ['class'=>'form-control', 'rows'=>'6']) !!}
						@if ($memoria->cumpl_cron_trabajo_obs) {!!Form::textarea('cumpl_cron_trabajo_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_equipo_catedra', 'Funciones de cada integrante del equipo de cátedra:') !!}
						{!! Form::textarea('cumpl_equipo_catedra',null, ['class'=>'form-control', 'rows'=>'6']) !!}
						@if ($memoria->cumpl_equipo_catedra_obs) {!!Form::textarea('cumpl_equipo_catedra_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_mecan_autoeval', 'Mecanismos de autoevaluación de cátedra:') !!}
						{!! Form::textarea('cumpl_mecan_autoeval',null, ['class'=>'form-control', 'rows'=>'6']) !!}
						@if ($memoria->cumpl_mecan_autoeval_obs) {!!Form::textarea('cumpl_mecan_autoeval_obs', null, ['class'=>'form-control', 'rows'=>'3','disabled' => 'disabled']) !!} @endif
					</div>
					
					<div class="btn-group" role="group">
  			        	<div class="btn-group">
                        	{!! Form::submit('Actualizar', ['class'=>'btn btn-primary']) !!}
			            </div>
			            <div class="btn-group">
  				        	{!!link_to_route('home', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
		            </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection

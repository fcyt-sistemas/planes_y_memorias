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
        <div class="col-md-13">
            <div class="card">
                <div class="card-header">Nueva memoria de cátedra</div>
                  <div class="card-body">
					@include('errors')
					{!! Form::open(['action' => 'MemoriaController@store','method' => 'POST'])!!}
					
					{!! Form::hidden('docente_id', Auth::user()->docente->id) !!}
					{!! Form::hidden('docente_id', Auth::user()->docente->id) !!}
					{!! Form::hidden('sede_id', $input['sede']) !!}
					{!! Form::hidden('carrera_id', $input['carrera']) !!}
					{!! Form::hidden('catedra_id', $input['catedra']) !!}
					{!! Form::hidden('anio_academico', $input['anio_academico']) !!}
					{!! Form::hidden('plan_id', $plan[0]->id) !!}
					  <div class="label">
						<b>Sede:</b> {{ $sedes->nombre }}
					  </div>
					  <div class="label">
						<b>Carrera:</b> {{ $carreras->nombre }} 
					  </div>
					  <div class="label">
						<b>Carrera:</b> {{ $catedras->nombre }} 
					  </div>
					  <div class="label">
						<b>Año Academico:</b> {{ $input['anio_academico'] }} 
					  </div>
					  <div class="label">
						<b>Plan:</b> {{ $plan[0]->nombre }} 
					  </div>
					  <br>
					<div class="form-group">
						{!! Form::label('equipo_docente', 'Equipo docente:') !!}
						{!! Form::textarea('equipo_docente',null, ['class'=>'form-control', 'rows'=>'3']) !!}
					</div>
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Anio año de la carrera en que se dictó:</span>
						  </div>
						  {!! Form::number('anio_carrera',1, ['class'=>'form-control']) !!}
					</div>
					
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="regimen_materia">Regimen de la materia:</label>
					  </div>
					  {!! Form::select('regimen_materia', ['Trimestral','Cuatrimestral','Semestral','Anual'],null, ['class'=>'form-control','placeholder'=>'Seleccione...']) !!}
					</div>
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Carga horaria semanal:</span>
						  </div>
						  {!! Form::number('carga_horaria',4, ['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('ajus_plani_original', 'Ajustes a la planificación original:') !!}
						{!! Form::textarea('ajus_plani_original',null, ['class'=>'form-control', 'rows'=>'6']) !!}
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
						</div>
	
						
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que iniciaron el año como alumnos regulares:</span>
						  </div>
						  {!! Form::number('alu_ini_regulares',null, ['class'=>'form-control']) !!}
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que regularizaron la materia al finalizar el periodo lectivo:</span>
						  </div>
						  {!! Form::number('alu_regularizaron',null, ['class'=>'form-control']) !!}
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que abandonaron la materia al finalizar el periodo lectivo:</span>
						  </div>
						  {!! Form::number('alu_abndonaron',null, ['class'=>'form-control']) !!}
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de alumnos que promocionaron la materia al finalizar el periodo lectivo:</span>
						  </div>
						  {!! Form::number('alu_promocionaron',null, ['class'=>'form-control']) !!}
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de clases desarrolladas en el periodo lectivo:</span>
						  </div>
						  {!! Form::number('clases_desarrolladas',null, ['class'=>'form-control']) !!}
						</div>
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Nº de recuperatorios realizados en el periodo lectivo:</span>
						  </div>
						  {!! Form::number('recup_realizadas',null, ['class'=>'form-control']) !!}
						</div>
					</div>
					</div>
					<div class="form-group">
						{!! Form::label('regimen_curs_promo', 'Consideraciones sobre el régimen de cursado y promoción:') !!}
						{!! Form::textarea('regimen_curs_promo',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('cond_des_esp_curri', 'Consideraciones sobre condiciones de desarrollo de los espacios curriculares:') !!}
						{!! Form::textarea('cond_des_esp_curri',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_req_rendir', 'Requisitos para rendir como estudiantes regulares, promocionales y libres:') !!}
						{!! Form::textarea('cumpl_req_rendir',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_cron_trabajo', 'Cronograma de trabajo:') !!}
						{!! Form::textarea('cumpl_cron_trabajo',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_equipo_catedra', 'Funciones de cada integrante del equipo de cátedra:') !!}
						{!! Form::textarea('cumpl_equipo_catedra',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('cumpl_mecan_autoeval', 'Mecanismos de autoevaluación de cátedra:') !!}
						{!! Form::textarea('cumpl_mecan_autoeval',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="btn-group" role="group">
  			        	<div class="btn-group">
                        	{!! Form::submit('Guardar memoria', ['class'=>'btn btn-primary']) !!}
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

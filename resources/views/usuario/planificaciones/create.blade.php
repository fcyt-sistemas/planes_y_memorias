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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Nueva Planificación</div>
                  <div class="card-body">
					@include('errors')
					{!! Form::open(['action' => 'PlanificacionController@store','method' => 'POST'])!!}
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
						    <span class="input-group-text" id="inputGroup-sizing-default">Año de la carrera a la que pertenece la cátedra:</span>
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
						  {!! Form::number('carga_horaria',null, ['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('fundamentacion', 'Fundamentación:') !!}
						{!! Form::textarea('fundamentacion',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('objetivos', 'Objetivos:') !!}
						{!! Form::textarea('objetivos',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('programa_contenidos', 'Programa de contenidos:') !!}
						{!! Form::textarea('programa_contenidos',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('metodologia_trabajo', 'Metodología de trabajo y estrategias pedagógicas:') !!}
						{!! Form::textarea('metodologia_trabajo',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('sistema_evaluacion', 'Sistema de evaluación:') !!}
						{!! Form::textarea('sistema_evaluacion',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('programa_practicos', 'Programa de trabajos prácticos:') !!}
						{!! Form::textarea('programa_practicos',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('bibliografia', 'Bibliografía:') !!}
						{!! Form::textarea('bibliografia',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('requisitos_rendir', 'Requisitos para rendir como estudiantes regulares, promocionales y libres:') !!}
						{!! Form::textarea('requisitos_rendir',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('cronograma_trabajo', 'Cronograma de trabajo:') !!}
						{!! Form::textarea('cronograma_trabajo',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('funciones_equipo', 'Funciones de cada integrante del equipo de cátedra:') !!}
						{!! Form::textarea('funciones_equipo',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('cronograma_actividades', 'Cronograma de actividades de investigación y/o extensión:') !!}
						{!! Form::textarea('cronograma_actividades',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('mecanismos_autoeval', 'Mecanismos de autoevaluación de cátedra:') !!}
						{!! Form::textarea('mecanismos_autoeval',null, ['class'=>'form-control', 'rows'=>'6']) !!}
					</div>
					<div class="btn-group" role="group">
  			        	<div class="btn-group">
                        	{!! Form::submit('Guardar planificación', ['class'=>'btn btn-primary']) !!}
			            </div>
			            <div class="btn-group">
  				        	{!!link_to_route('planificaciones.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
		            </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection

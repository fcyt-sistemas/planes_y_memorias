@extends('layouts.app')
@section('content')
<script>
	tinymce.init({
	    selector:'textarea', 
	    menubar: false,
	    language: 'es',
	    branding: false,
	    toolbar:false,
	    readonly: 1
	});
</script>
<div class="container">
	@include('admin.planificaciones.modal')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Planificación cargada por el docente {{ $planificaciones->docente->apellidos}}, {{ $planificaciones->docente->nombres}}! </div>
                  <div class="card-body">
                  	{!! Form::model($planificaciones,['route'=>['planificaciones.update',$planificaciones->id], 'method' => 'PUT'])!!}
					{!! Form::hidden('observado', null, array('id' => 'observado')) !!}
					{!! Form::hidden('aprobado', null, array('id' => 'aprobado')) !!}
					
	<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Sede:</label>
					  </div>
					  {!! Form::select('sede_id',$sedes, null,['disabled' => 'disabled']) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Carrera:</label>
					  </div>
					  {!! Form::select('carrera_id',$carreras, null,['disabled' => 'disabled'] ) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Plan de estudios:</label>
					  </div>
					  {!! Form::select('plan_id',$planes,null, ['disabled' => 'disabled']) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Catedra:</label>
					  </div>
					  {!! Form::select('catedra_id', $catedras,null, ['disabled' => 'disabled']) !!}
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
						<div class="input-group">
						  {!! Form::text('equipo_docente_obs', null, ['class'=>'form-control','placeholder'=>'Agregar una observación...']) !!}
						  <div class="input-group-append inline">
						  	{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
						  </div>
						</div>					
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Año de la carrera a la que pertenece la cátedra:</label>
					  </div>
					  {!! Form::text('anio_carrera', null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('anio_carrera_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>
					</div>
					
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="regimen_materia">Régimen de la materia:</label>
					  </div>
					  {!! Form::select('regimen_materia', ['Trimestral','Cuatrimestral','Semestral','Anual'],null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('regimen_materia_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>					
					</div>
					<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Carga horaria semanal:</span>
						  </div>
						  {!! Form::number('carga_horaria',null, ['class'=>'form-control','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('carga_horaria_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>							  
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Fundamentación:</span>
						</div>
						{!! Form::textarea('fundamentacion', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('fundamentacion_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>						
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Objetivos:</span>
						</div>
						{!! Form::textarea('objetivos', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('objetivos_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>						
					</div>
					
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Programa de contenidos:</span>
						</div>
						{!! Form::textarea('programa_contenidos', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('programa_contenidos_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>						
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Metodología de trabajo y estrategias pedagógicas:</span>
						</div>					
						{!! Form::textarea('metodologia_trabajo', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('metodologia_trabajo_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Sistema de evaluación:</span>
						</div>					
						{!! Form::textarea('sistema_evaluacion', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('sistema_evaluacion_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Programa de trabajos prácticos:</span>
						</div>					
						{!! Form::textarea('programa_practicos', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('programa_practicos_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Bibliografía:</span>
						</div>					
						{!! Form::textarea('bibliografia', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('bibliografia_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Requisitos para rendir como estudiantes regulares, promocionales y libres:</span>
						</div>					
						{!! Form::textarea('requisitos_rendir', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('requisitos_rendir_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Cronograma de trabajo:</span>
						</div>					
						{!! Form::textarea('cronograma_trabajo', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('cronograma_trabajo_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Funciones de cada integrante del equipo de cátedra:</span>
						</div>					
						{!! Form::textarea('funciones_equipo', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('funciones_equipo_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Cronograma de actividades de investigación y/o extensión:</span>
						</div>					
						{!! Form::textarea('cronograma_actividades', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('cronograma_actividades_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-default">Mecanismos de autoevaluación de cátedra:</span>
						</div>					
						{!! Form::textarea('mecanismos_autoeval', null, ['class'=>'form-control', 'rows'=>'6','disabled' => 'disabled']) !!}
						<div class="input-group">
							{!! Form::text('mecanismos_autoeval_obs', null, ['class'=>'form-control ','placeholder'=>'Agregar una observación...']) !!}
					  		<div class="input-group-append inline">
					  			{!! Form::submit('Observar', ['class'=>'btn btn-outline-success add-more']) !!}
					 		</div>
						</div>
					</div>
					<div class="btn-group" role="group">
			            <div class="btn-group">
                        	{!! Form::submit('Aceptar', ['class'=>'btn btn-primary']) !!}
			            </div>
			            <div class="btn-group">
  				          	{!!link_to_route('planificaciones.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
		            </div>
					{!! Form::close() !!}
					<div class="btn-group">
						{!!link_to_action('PlanificacionController@aprobar', $title = 'Aprobar Planificacion!', $parameters = $planificaciones->id, $attributes = ['class'=>'btn btn-success'])!!}
				    </div>
				</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
       $("body").on("click",".add-more",function(){ 
		  $("#observado").val("1");
      });
    });
</script>
@endsection

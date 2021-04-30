@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear docente!</div>
                  <div class="card-body">

					{!! Form::open(['action' => 'DocenteController@store','method' => 'POST'])!!}
					
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="apellidos">Apellidos:</label>
					  </div>
					{!! Form::text('apellidos') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="nombres">Nombres:</label>
					  </div>
					{!! Form::text('nombres') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="tipo_documento">Tipo de documento:</label>
					  </div>
					{!! Form::text('tipo_documento') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="nro_documento">Nº de documento:</label>
					  </div>
					{!! Form::text('nro_documento') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="e-mail">E-Mail:</label>
					  </div>
					{!! Form::text('e-mail') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="e-mail">Legajo:</label>
					  </div>
					{!! Form::text('legajo') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sexo">Sexo:</label>
					  </div>
					{!! Form::select('sexo', ['1'=>'Masculino','2'=>'Femenino', '3'=>'No definido'],'1',['class'=>'form-control','placeholder'=>'Seleccione...']) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="nacionalidad">Nacionalidad:</label>
					  </div>
					{!! Form::select('nacionalidad', ['1'=>'Argentino','2'=>'Extranjero','3'=>'Naturalizado','4'=>'Por Opción'],'1', ['class'=>'form-control','placeholder'=>'Seleccione...']) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="fecha_nacimiento">Fecha de Nacimiento:</label>
					  </div>
					{!! Form::date('fecha_nacimiento') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="domicilio">Domicilio:</label>
					  </div>
					{!! Form::text('domicilio') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="localidad">Localidad:</label>
					  </div>
					{!! Form::text('localidad') !!}
					</div>

					<div class="btn-group" role="group">
  			        	<div class="btn-group">
                        	{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
			            </div>
			            <div class="btn-group">
  				        	{!!link_to_route('docentes', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
		            </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection

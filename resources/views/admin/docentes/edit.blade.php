@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar datos del docente</div>
                  <div class="card-body">

					{!! Form::model($docente,['route'=>['docentes.update',$docente->id], 'method' => 'PUT'])!!}

					<div class="form-group">
						{!! Form::label('apellidos', 'Apellidos:') !!}
						{!! Form::text('apellidos') !!}
					</div>
					<div class="form-group">
						{!! Form::label('nombres', 'Nombres:') !!}
						{!! Form::text('nombres') !!}
					</div>
					<div class="form-group">
						{!! Form::label('nro_documento', 'Nº de documento:') !!}
						{!! Form::text('nro_documento') !!}
					</div>
					<div class="form-group">
						{!! Form::label('e-mail', 'E-Mail:') !!}
						{!! Form::text('e-mail') !!}
					</div>
					<div class="form-group">
						{!! Form::label('domicilio', 'Domicilio:') !!}
						{!! Form::text('domicilio') !!}
					</div>
					<div class="form-group">
						{!! Form::label('localidad', 'Localidad:') !!}
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

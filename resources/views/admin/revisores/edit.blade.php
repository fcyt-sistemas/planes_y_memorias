@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Asociar usuarios revisores </div>
                  <div class="card-body">

					{!! Form::model($revisor,['route'=>['revisores.update',$revisor->id], 'method' => 'PUT'])!!}

					<div class="form-group">
						{!! Form::label('sede_id', 'Sede:') !!}
						{!! Form::select('sede_id',$sedes, null,['placeholder'=>'Seleccione una Sede'] ) !!}
					</div>
					<div class="form-group">
						{!! Form::label('carrera_id', 'Carrera:') !!}
						{!! Form::select('carrera_id',$carreras, null,['placeholder'=>'Seleccione una carrera'] ) !!}
					</div>
					<div class="form-group">
						
						{!! Form::label('docente_id', 'Docente:') !!}
						
						{!! Form::select('docente_id',$docentes,null, ['placeholder'=>'Seleccione un docente']) !!}
					</div>
					<div class="btn-group" role="group">
  			        	<div class="btn-group">
                        	{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
			            </div>
			            <div class="btn-group">
  				        	{!!link_to_route('revisores', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
		            </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection

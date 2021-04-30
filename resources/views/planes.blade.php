{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('nombre', 'Nombre:') !!}
			{!! Form::text('nombre') !!}
		</li>
		<li>
			{!! Form::label('version', 'Version:') !!}
			{!! Form::text('version') !!}
		</li>
		<li>
			{!! Form::label('cant_materias', 'Cant_materias:') !!}
			{!! Form::text('cant_materias') !!}
		</li>
		<li>
			{!! Form::label('nro_resolucion', 'Nro_resolucion:') !!}
			{!! Form::text('nro_resolucion') !!}
		</li>
		<li>
			{!! Form::label('fecha_resolucion', 'Fecha_resolucion:') !!}
			{!! Form::text('fecha_resolucion') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
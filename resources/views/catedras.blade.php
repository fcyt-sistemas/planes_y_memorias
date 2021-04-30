{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('nombre', 'Nombre:') !!}
			{!! Form::text('nombre') !!}
		</li>
		<li>
			{!! Form::label('periodo_lectivo', 'Periodo_lectivo:') !!}
			{!! Form::text('periodo_lectivo') !!}
		</li>
		<li>
			{!! Form::label('carga_horaria', 'Carga_horaria:') !!}
			{!! Form::text('carga_horaria') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
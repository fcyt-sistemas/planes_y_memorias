{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('nombre', 'Nombre:') !!}
			{!! Form::text('nombre') !!}
		</li>
		<li>
			{!! Form::label('plan_vigente', 'Plan_vigente:') !!}
			{!! Form::text('plan_vigente') !!}
		</li>
		<li>
			{!! Form::label('tipo_carrera', 'Tipo_carrera:') !!}
			{!! Form::text('tipo_carrera') !!}
		</li>
		<li>
			{!! Form::label('resolucion', 'Resolucion:') !!}
			{!! Form::text('resolucion') !!}
		</li>
		<li>
			{!! Form::label('termino_anios', 'Termino_anios:') !!}
			{!! Form::text('termino_anios') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
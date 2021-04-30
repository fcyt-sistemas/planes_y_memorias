{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('apellidos', 'Apellidos:') !!}
			{!! Form::text('apellidos') !!}
		</li>
		<li>
			{!! Form::label('nombres', 'Nombres:') !!}
			{!! Form::text('nombres') !!}
		</li>
		<li>
			{!! Form::label('nro_documento', 'Nro_documento:') !!}
			{!! Form::text('nro_documento') !!}
		</li>
		<li>
			{!! Form::label('legajo', 'Legajo:') !!}
			{!! Form::text('legajo') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
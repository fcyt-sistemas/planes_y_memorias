@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


{!! Form::open(['action' => 'PlanificacionController@create'])!!}
	<ul>
		<li>
			{!! Form::label('catedra_id', 'Catedra_id:') !!}
			{!! Form::text('catedra_id') !!}
		</li>
		<li>
			{!! Form::label('plan_id', 'Plan_id:') !!}
			{!! Form::text('plan_id') !!}
		</li>
		<li>
			{!! Form::label('carrera_id', 'Carrera_id:') !!}
			{!! Form::text('carrera_id') !!}
		</li>
		<li>
			{!! Form::label('docente_id', 'Docente_id:') !!}
			{!! Form::text('docente_id') !!}
		</li>
		<li>
			{!! Form::label('anio_academico', 'Anio_academico:') !!}
			{!! Form::text('anio_academico') !!}
		</li>
		<li>
			{!! Form::label('equipo_docente', 'Equipo_docente:') !!}
			{!! Form::textarea('equipo_docente') !!}
		</li>
		<li>
			{!! Form::label('anio_carrera', 'Anio_carrera:') !!}
			{!! Form::text('anio_carrera') !!}
		</li>
		<li>
			{!! Form::label('regimen_materia', 'Regimen_materia:') !!}
			{!! Form::text('regimen_materia') !!}
		</li>
		<li>
			{!! Form::label('carga_horaria', 'Carga_horaria:') !!}
			{!! Form::text('carga_horaria') !!}
		</li>
		<li>
			{!! Form::label('fundamentacion', 'Fundamentacion:') !!}
			{!! Form::textarea('fundamentacion') !!}
		</li>
		<li>
			{!! Form::label('objetivos', 'Objetivos:') !!}
			{!! Form::textarea('objetivos') !!}
		</li>
		<li>
			{!! Form::label('programa_contenidos', 'Programa_contenidos:') !!}
			{!! Form::text('programa_contenidos') !!}
		</li>
		<li>
			{!! Form::label('metodologia_trabajo', 'Metodologia_trabajo:') !!}
			{!! Form::textarea('metodologia_trabajo') !!}
		</li>
		<li>
			{!! Form::label('sistema_evaluacion', 'Sistema_evaluacion:') !!}
			{!! Form::textarea('sistema_evaluacion') !!}
		</li>
		<li>
			{!! Form::label('programa_practicos', 'Programa_practicos:') !!}
			{!! Form::textarea('programa_practicos') !!}
		</li>
		<li>
			{!! Form::label('bibliografia', 'Bibliografia:') !!}
			{!! Form::textarea('bibliografia') !!}
		</li>
		<li>
			{!! Form::label('requisitos_rendir', 'Requisitos_rendir:') !!}
			{!! Form::textarea('requisitos_rendir') !!}
		</li>
		<li>
			{!! Form::label('cronograma_trabajo', 'Cronograma_trabajo:') !!}
			{!! Form::textarea('cronograma_trabajo') !!}
		</li>
		<li>
			{!! Form::label('funciones_equipo', 'Funciones_equipo:') !!}
			{!! Form::textarea('funciones_equipo') !!}
		</li>
		<li>
			{!! Form::label('cronograma_actividades', 'Cronograma_actividades:') !!}
			{!! Form::textarea('cronograma_actividades') !!}
		</li>
		<li>
			{!! Form::label('mecanismos_autoeval', 'Mecanismos_autoeval:') !!}
			{!! Form::text('mecanismos_autoeval') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection

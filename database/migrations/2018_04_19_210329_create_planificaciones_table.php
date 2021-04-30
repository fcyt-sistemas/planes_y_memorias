<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanificacionesTable extends Migration {

	public function up()
	{
		Schema::create('planificaciones', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('unidad_academica')->nullable()->unsigned();
			$table->integer('catedra_id')->nullable()->unsigned();
			$table->integer('plan_id')->nullable()->unsigned();
			$table->integer('carrera_id')->nullable()->unsigned();
			$table->integer('docente_id')->nullable()->unsigned();
			$table->integer('sede_id')->nullable()->unsigned();
			$table->string('anio_academico', 30)->nullable();
			$table->string('anio_academico_obs')->nullable();
			$table->longText('equipo_docente');
			$table->longText('equipo_docente_obs')->nullable();
			$table->string('anio_carrera', 30);
			$table->string('anio_carrera_obs')->nullable();
			$table->string('regimen_materia', 255);
			$table->string('regimen_materia_obs')->nullable();
			$table->integer('carga_horaria')->nullable();
			$table->string('carga_horaria_obs')->nullable();
			$table->longText('fundamentacion');
			$table->longText('fundamentacion_obs')->nullable();
			$table->longText('objetivos');
			$table->longText('objetivos_obs')->nullable();
			$table->longText('programa_contenidos');
			$table->longText('programa_contenidos_obs')->nullable();
			$table->longText('metodologia_trabajo');
			$table->longText('metodologia_trabajo_obs')->nullable();
			$table->longText('sistema_evaluacion');
			$table->longText('sistema_evaluacion_obs')->nullable();
			$table->longText('programa_practicos');
			$table->longText('programa_practicos_obs')->nullable();
			$table->longText('bibliografia');
			$table->longText('bibliografia_obs')->nullable();
			$table->longText('requisitos_rendir');
			$table->longText('requisitos_rendir_obs')->nullable();
			$table->longText('cronograma_trabajo');
			$table->longText('cronograma_trabajo_obs')->nullable();
			$table->longText('funciones_equipo');
			$table->longText('funciones_equipo_obs')->nullable();
			$table->longText('cronograma_actividades');
			$table->longText('cronograma_actividades_obs')->nullable();
			$table->longText('mecanismos_autoeval');
			$table->longText('mecanismos_autoeval_obs')->nullable();
			$table->integer('prev_version')->nullable()->unsigned();
			$table->integer('prox_version')->nullable()->unsigned();
			$table->boolean('entregado')->nullable()->default(false);
			$table->dateTime('fecha_entrega')->nullable();
			$table->boolean('observado')->nullable()->default(false);
			$table->dateTime('fecha_observado')->nullable();
			$table->boolean('aprobado')->nullable()->default(false);
			$table->dateTime('fecha_aprobado')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('planificaciones');
	}
}
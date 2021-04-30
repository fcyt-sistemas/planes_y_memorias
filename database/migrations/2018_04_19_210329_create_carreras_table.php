<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarrerasTable extends Migration {

	public function up()
	{
		Schema::create('carreras', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('unidad_academica', 30)->nullable();
			$table->string('codigo', 5);
			$table->string('nombre', 255);
			$table->integer('plan_vigente')->nullable();
			$table->string('tipo_carrera', 100)->nullable();
			$table->string('nro_resolucion', 50)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('carreras');
	}
}
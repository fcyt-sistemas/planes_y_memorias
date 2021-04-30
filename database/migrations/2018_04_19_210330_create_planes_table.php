<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanesTable extends Migration {

	public function up()
	{
		Schema::create('planes', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('unidad_academica', 30)->default('FCYT');			
			$table->integer('carrera_id')->unsigned();
			$table->string('nombre', 30);
			$table->tinyInteger('version')->nullable();
			$table->string('nro_resolucion', 100)->nullable();
			$table->tinyInteger('cant_materias')->nullable();
			$table->string('estado', 10)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('planes');
	}
}
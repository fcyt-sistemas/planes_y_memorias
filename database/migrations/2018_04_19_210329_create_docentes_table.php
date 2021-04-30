<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocentesTable extends Migration {

	public function up()
	{
		Schema::create('docentes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('unidad_academica')->nullable();
			$table->string('legajo', 30)->nullable();
			$table->string('tipo_documento')->nullable();
			$table->string('nro_documento', 30)->unique();
			$table->string('apellidos', 200);
			$table->string('nombres', 200);
			$table->integer('sexo')->nullable()->insigned();
			$table->integer('nacionalidad')->nullable()->insigned();
			$table->date('fecha_nacimiento')->nullable();
			$table->string('e-mail', 120)->nullable();
			$table->string('domicilio', 120)->nullable();
			$table->string('localidad')->nullable();
			$table->string('telefono', 20)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('docentes');
	}
}
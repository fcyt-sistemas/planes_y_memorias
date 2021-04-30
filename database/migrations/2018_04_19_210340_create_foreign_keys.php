<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('planificaciones', function(Blueprint $table) {
			$table->foreign('catedra_id')->references('id')->on('catedras')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('planificaciones', function(Blueprint $table) {
			$table->foreign('plan_id')->references('id')->on('planes')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('planificaciones', function(Blueprint $table) {
			$table->foreign('carrera_id')->references('id')->on('carreras')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('planificaciones', function(Blueprint $table) {
			$table->foreign('docente_id')->references('id')->on('docentes')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
/*		Schema::table('carreras', function(Blueprint $table) {
			$table->foreign('plan_vigente')->references('id')->on('planes')
						->onDelete('restrict')
						->onUpdate('cascade');
		});*/
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('docente_id')->references('id')->on('docentes')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('planificaciones', function(Blueprint $table) {
			$table->dropForeign('planificaciones_catedra_id_foreign');
		});
		Schema::table('planificaciones', function(Blueprint $table) {
			$table->dropForeign('planificaciones_plan_id_foreign');
		});
		Schema::table('planificaciones', function(Blueprint $table) {
			$table->dropForeign('planificaciones_carrera_id_foreign');
		});
		Schema::table('planificaciones', function(Blueprint $table) {
			$table->dropForeign('planificaciones_docente_id_foreign');
		});
/*		Schema::table('carreras', function(Blueprint $table) {
			$table->dropForeign('carreras_plan_vigente_foreign');
		});*/
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_docente_id_foreign');
		});
	}
}
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memorias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            
	        $table->integer('unidad_academica')->nullable()->unsigned();
            $table->integer('sede_id')->nullable()->unsigned();   
   			$table->integer('carrera_id')->nullable()->unsigned();
 			$table->integer('plan_id')->nullable()->unsigned();
 			$table->integer('catedra_id')->nullable()->unsigned();
 			$table->integer('docente_id')->nullable()->unsigned();
 			$table->integer('planificacion_id')->nullable()->unsigned();
 			$table->string('anio_academico', 30)->nullable();
 			$table->string('anio_academico_obs')->nullable();
 			$table->text('equipo_docente');
 			$table->text('equipo_docente_obs')->nullable();
 			$table->string('anio_carrera', 30);
 			$table->string('anio_carrera_obs')->nullable();
 			$table->string('regimen_materia', 255);
 			$table->string('regimen_materia_obs')->nullable();
 			$table->integer('carga_horaria')->nullable();
 			$table->string('carga_horaria_obs')->nullable();
			$table->text('ajus_plani_original');
			$table->text('ajus_plani_original_obs')->nullable();
			$table->integer('alu_cursaron');
			$table->integer('alu_ini_regulares');
			$table->integer('alu_regularizaron');
			$table->integer('alu_abndonaron');
			$table->integer('alu_promocionaron');
			$table->integer('clases_desarrolladas');
			$table->integer('recup_realizadas');
			$table->text('org_promo_catedra_obs')->nullable();
			$table->text('regimen_curs_promo');
			$table->text('regimen_curs_promo_obs')->nullable();
			$table->text('cond_des_esp_curri');
			$table->text('cond_des_esp_curri_obs')->nullable();
			$table->text('cumpl_req_rendir');
			$table->text('cumpl_req_rendir_obs')->nullable();
			$table->text('cumpl_cron_trabajo');
			$table->text('cumpl_cron_trabajo_obs')->nullable();
			$table->text('cumpl_equipo_catedra');
			$table->text('cumpl_equipo_catedra_obs')->nullable();
			$table->text('cumpl_mecan_autoeval');
			$table->text('cumpl_mecan_autoeval_obs')->nullable();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memorias');
    }
}

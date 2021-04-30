<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadAcademicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_academicas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			$table->softDeletes();            
            $table->string('codigo',3);
            $table->string('nombre',100);
            $table->string('direccion',100)->nullable();
            $table->string('localidad',100)->nullable();
            $table->integer('codigo_postal')->nullable();
            $table->string('telefono',30)->nullable();
            $table->string('email', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidad_academicas');
    }
}

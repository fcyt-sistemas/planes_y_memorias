<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catedra extends Model 
{

    protected $table = 'catedras';
    public $timestamps = true;
    protected $fillable = array('id','unidad_academica','codigo','nombre', 'tipo_materia', 'promovible', 'req_cursada','permite_libres','carga_horaria_total','tipo_periodo', 'horas_semanales');
    protected $visible = array('id','unidad_academica','codigo','nombre', 'tipo_materia', 'promovible', 'req_cursada','permite_libres','carga_horaria_total','tipo_periodo', 'horas_semanales');

    public function planes() {
        return $this
        ->belongsToMany('App\Plan','plan_catedra')
        ->withTimestamps();
    }


}
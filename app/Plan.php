<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model 
{

    protected $table = 'planes';
    public $timestamps = true;
    protected $fillable = array('id','unidad_academica','carrera_id','nombre', 'version', 'cant_materias', 'nro_resolucion', 'estado');
    protected $visible = array('id', 'unidad_academica', 'carrera_id', 'nombre', 'version', 'cant_materias', 'nro_resolucion', 'estado');

    public function catedras() {
        return $this
        ->belongsToMany('App\Catedra','plan_catedra')
        ->withTimestamps();
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model 
{

    protected $table = 'carreras';
    public $timestamps = true;
    protected $fillable = array('id','unidad_academica','codigo','nombre', 'plan_vigente', 'tipo_carrera', 'nro_resolucion');
    protected $visible = array('id','unidad_academica','codigo','nombre', 'plan_vigente', 'tipo_carrera', 'nro_resolucion');

    public function planVigente()
    {
        return $this->hasOne('Plan');
    }

    public function revisadaPor()
    {
        return $this->belongsToMany('App\Docente', 'revisores', 'carrera_id', 'docente_id');
    }
    
    public function sedes() {
        return $this
        ->belongsToMany('App\Sede')
        ->withTimestamps();
    }
    
    public function planes() {
        return $this->hasMany('App\Plan');
    }
    public function scopeNombre($query,$nombre){
        if(trim($nombre!="")){
            $query->where(\DB::raw("CONCAT(nombre)"),"LIKE","%$nombre%"); 
        }
    }
    
    
}
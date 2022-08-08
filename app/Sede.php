<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sede extends Model
{
    protected $table = 'sedes';
    public $timestamps = true;
    
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = array('codigo','nombre','unidad_academica_id','direccion','localidad','codigo_postal','telefono','email');
    protected $visible = array('codigo','nombre','unidad_academica_id','direccion','localidad','codigo_postal','telefono','email');

    public function unidadAcademica()
    {
        return $this->belongsTo('App\UnidadAcademica');
    }
    
    public function carreras() {
        return $this
        ->belongsToMany('App\Carrera')
        ->withTimestamps();
    }
    public function scopeNombre($query,$nombre){
        if(trim($nombre!="")){
            $query->where(\DB::raw("CONCAT(nombre)"),"LIKE","%$nombre%"); 
        }
    }
    public function scopeName($query, $sedes_id){
        if($sedes_id!=""){
            $query->where('id', $sedes_id);
                  //->select('nombre');
        }
    }

}

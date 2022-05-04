<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revisor extends Model
{
    protected $table = 'revisores';
    public $timestamps = true;

    protected $fillable = array(
        'sede_id',
        'carrera_id',
        'docente_id',
    );
    
    protected $visible = array(
        'sede_id',
        'carrera_id',
        'docente_id',
        );
        
    public function docente(){
        return $this->belongsTo('App\Docente');
    }
    
    public function sede(){
        return $this->belongsTo('App\Sede');
    }
    public function carrera() {
        return $this
        ->belongsTo('App\Carrera');
    }
    public function revisorDeCarreras(){
        return $this->belongsToMany('App\Carrera', 'revisores', 'docente_id', 'carrera_id');
    }
    public function revisorDeSedes(){
        return $this->belongsToMany('App\Sede', 'revisores', 'docente_id', 'sede_id');
    }
    public function scopeAnio($query,$anio_academico){
        if($anio_academico!=''){
            $query->where('memorias.anio_academico',$anio_academico);
        }
    }
    public function scopeCarrera_id($query,$carrera_id){
        if(trim($carrera_id!="")){
            $query->where(\DB::raw("CONCAT(carrera_id)"),"LIKE","%$carrera_id%"); 
        }
    }
   public function scopeSede_id($query,$sede_id){
        if(trim($sede_id!="")){
            $query->where(\DB::raw("CONCAT(sede_id)"),"LIKE","%$sede_id%"); 
        }
    }
    public function scopeDocente_id($query,$docente_id){
        if(trim($docente_id!="")){
            $query->where(\DB::raw("CONCAT(docente_id)"),"LIKE","%$docente_id%"); 
        }
    }
    public function scopeDocente($query, $docente){
        if(trim($docente!="")){
            $query->join('docentes','docentes.id', '=', 'revisores.docente_id')
                    ->where(\DB::raw('docentes.nombres'),"LIKE","%$docente%")
                    ->select('*');
        }
    }
    public function scopeSede($query, $sede){
        if(trim($sede="")){
            $query->join('sedes','sedes.id', '=', 'revisores.sede_id')
                    ->where('sedes.nombre',"LIKE","%$sede%")
                    ->select('sedes.*');
        }
    }
    public function scopeCarrera($query, $carrera){
        if(trim($carrera!="")){
            $query->join('carreras','carreras.id','=','revisores.carrera_id')
                    ->where('carreras.nombre', $carrera)
                    ->select('carreras.nombre');
        }
    }
   /* public function scopeAnio_academico($query,$anio_academico){
        if(trim($anio_academico!="")){
            //$query->where('planificaciones.anio_academico', $anio_academico);
            $query->join('planificaciones','planificaciones.docente_id' '=','revisores.docente_id')
            ->where(('planificaciones.anio_academico'),"LIKE","%$anio_academico%")
            ->select('revisores.*'); 
        }
    }*/
}

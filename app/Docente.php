<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
class Docente extends Model 
{

    protected $table = 'docentes';
    public $timestamps = true;
    protected $fillable = array(
        'unidad_academica',
        'legajo',
        'tipo_documento',
        'nro_documento',
        'apellidos',
        'nombres',
        'sexo',
        'nacionalidad',
        'fecha_nacimiento',
        'e-mail',
        'domicilio',
        'localidad');
    protected $visible = array(
        'unidad_academica',
        'legajo',
        'tipo_documento',
        'nro_documento',
        'apellidos',
        'nombres',
        'sexo',
        'nacionalidad',
        'fecha_nacimiento',
        'e-mail',
        'domicilio',
        'localidad'
        );

    public function revisorDeCarreras(){
        return $this->belongsToMany('App\Carrera', 'revisores', 'docente_id', 'carrera_id');
    }
    public function revisorDeSedes(){
        return $this->belongsToMany('App\Sede', 'revisores', 'docente_id', 'sede_id');
    }
    
    public function scopeNombre($query,$nombres){
        if(trim($nombres!="")){
            $query->where(\DB::raw("CONCAT(nombres)"),"LIKE","%$nombres%"); 
        }
    }

/*    public function scopeId($query, $id){
        if(trim($id!="")){
            $query->where(\DB::raw("CONCAT(id)"),"LIKE","%$id%");
        }
    }*/

    
    public function scopeId($query,$nro_documento){
        if($nro_documento!=''){
         return  $query->leftjoin('users','users.docente_id','=','docentes.id')
                  ->where('nro_documento',$nro_documento)
                  ->select('users.id'); 
        }
        
    }
        
    public function scopeApellidos($query,$apellidos){
        if(trim($apellidos!="")){
            $query->where(\DB::raw("CONCAT(apellidos)"),"LIKE","%$apellidos%%"); 
        }
    }
    public function scopeNya($query,$nya){
        if(trim($nya!="")){
            $query->where(\DB::raw("CONCAT(apellidos,nombres"),"LIKE","%$nya%");
        }
    }
     
    public function scopeNro_Documento($query,$nro_documento){
        if(trim($nro_documento!="")){
            $query->where(\DB::raw("CONCAT(nro_documento)"),"LIKE","%$nro_documento%"); 
        }
    }
    public function scopeLocalidad($query,$localidad){
        if(trim($localidad!="")){
            $query->where(\DB::raw("CONCAT(localidad)"),"LIKE","%$localidad%"); 
        }
    }
}
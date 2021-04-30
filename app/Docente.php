<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
    
    public function scopeNombre($query,$nombre){
        if(trim($nombre!="")){
            $query->where(\DB::raw("CONCAT(apellidos,' ',nombres)"),"LIKE","%$nombre%"); 
        }
    }
}
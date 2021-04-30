<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Memoria extends Model
{
    protected $table = 'memorias';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'unidad_academica',
        'sede_id',
        'carrera_id',
        'plan_id',
        'catedra_id',
        'docente_id',
        'planificacion_id',
        'anio_academico',
        'anio_academico_obs',
        'equipo_docente',
        'equipo_docente_obs',
        'anio_carrera',
        'anio_carrera_obs',
        'regimen_materia',
        'regimen_materia_obs',
        'carga_horaria',
        'carga_horaria_obs',
        'ajus_plani_original',
        'ajus_plani_original_obs',
        'alu_cursaron',
        'alu_ini_regulares',
        'alu_regularizaron',
        'alu_abndonaron',
        'alu_promocionaron',
        'clases_desarrolladas',
        'recup_realizadas',
        'org_promo_catedra_obs',
        'regimen_curs_promo',
        'regimen_curs_promo_obs',
        'cond_des_esp_curri',
        'cond_des_esp_curri_obs',
        'cumpl_req_rendir',
        'cumpl_req_rendir_obs',
        'cumpl_cron_trabajo',
        'cumpl_cron_trabajo_obs',
        'cumpl_equipo_catedra',
        'cumpl_equipo_catedra_obs',
        'cumpl_mecan_autoeval',
        'cumpl_mecan_autoeval_obs',
        'prev_version',
        'prox_version',
        'entregado',
        'fecha_entrega',
        'observado',
        'fecha_observado',
        'aprobado',
        'fecha_aprobado',
        );
    protected $visible = array(
       'unidad_academica',
        'sede_id',
        'carrera_id',
        'plan_id',
        'catedra_id',
        'docente_id',
        'planificacion_id',
        'anio_academico',
        'anio_academico_obs',
        'equipo_docente',
        'equipo_docente_obs',
        'anio_carrera',
        'anio_carrera_obs',
        'regimen_materia',
        'regimen_materia_obs',
        'carga_horaria',
        'carga_horaria_obs',
        'ajus_plani_original',
        'ajus_plani_original_obs',
        'org_promo_catedra',
        'alu_cursaron',
        'alu_ini_regulares',
        'alu_regularizaron',
        'alu_abndonaron',
        'alu_promocionaron',
        'clases_desarrolladas',
        'recup_realizadas',
        'org_promo_catedra_obs',
        'regimen_curs_promo',
        'regimen_curs_promo_obs',
        'cond_des_esp_curri',
        'cond_des_esp_curri_obs',
        'cumpl_req_rendir',
        'cumpl_req_rendir_obs',
        'cumpl_cron_trabajo',
        'cumpl_cron_trabajo_obs',
        'cumpl_equipo_catedra',
        'cumpl_equipo_catedra_obs',
        'cumpl_mecan_autoeval',
        'cumpl_mecan_autoeval_obs',
        'prev_version',
        'prox_version',
        'entregado',
        'fecha_entrega',
        'observado',
        'fecha_observado',
        'aprobado',
        'fecha_aprobado',
        );
        
    public function planificacion()
    {
        return $this->belongsTo('App\Planificacion');
    }

    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }

    public function catedra()
    {
        return $this->belongsTo('App\Catedra');
    }

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function carrera()
    {
        return $this->belongsTo('App\Carrera');
    }

    public function sede()
    {
        return $this->belongsTo('App\Sede');
    }

    public function scopeWhereSede($query,$sede){
        if($sede!=''){
            $query->where('memorias.sede_id',$sede);
        }
    }
    
    public function scopeCarrera($query,$carrera){
        if($carrera!=''){
            $query->where('memorias.carrera_id',$carrera);
        }
    }
   
    public function scopeAsignatura($query,$asignatura){
        if($asignatura!=''){
            $query->join('catedras','memorias.catedra_id','=','catedras.id')
                  ->where('catedras.nombre',"LIKE","%$asignatura%")
                  ->select('memorias.*'); 
        }
    }

    public function scopeProfesor($query,$profesor){
        if($profesor!=''){
            $query->join('docentes','memorias.docente_id','=','docentes.id')
                  ->where('docentes.apellidos',"LIKE","%$profesor%")
                  ->select('memorias.*'); 
        }
    }
    
    public function scopeAprobada($query,$aprobadas){
        if($aprobadas=='on'){
            $query->where('memorias.aprobado',true);
        }
    }
    public function scopeRevisada($query,$revisadas){
        if($revisadas=='on'){
            $query->where('memorias.observado',true);
        }
    }
    public function scopeEntregada($query,$entregadas){
        if($entregadas=='on'){
            $query->where('memorias.entregado',true);
        }
    }

}

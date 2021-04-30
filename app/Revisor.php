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
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateMemoriaRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        
        return [
        'sede_id'=>'required',
        'catedra_id'=>'required',
        'plan_id'=>'required',
        'carrera_id'=>'required',
        'docente_id'=>'required',
        'anio_academico'=>'required|numeric',
        'equipo_docente'=>'required',
        'anio_carrera'=>'required|numeric',
        'regimen_materia'=>'required',
        'carga_horaria'=>'required|numeric',
        'ajus_plani_original'=>'required',
        'alu_cursaron'=>'required|numeric',
        'alu_ini_regulares'=>'required|numeric',
        'alu_regularizaron'=>'required|numeric',
        'alu_abndonaron'=>'required|numeric',
        'alu_promocionaron'=>'required|numeric',
        'clases_desarrolladas'=>'required|numeric',
        'recup_realizadas'=>'required|numeric',
        'cumpl_req_rendir'=>'required',
        'cumpl_cron_trabajo'=>'required',
        'cumpl_equipo_catedra'=>'required',
        'cumpl_mecan_autoeval'=>'required',
        ];
    }
}

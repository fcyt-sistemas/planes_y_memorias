<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreatePlanificacionRequest extends FormRequest
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
    public function rules()
    {
        return [
        'sede_id'=>'required',
        'catedra_id'=>'required',
        'plan_id'=>'required',
        'carrera_id'=>'required',
        'docente_id'=>'required',
        'anio_academico'=>'required|numeric',
        'anio_academico_obs',
        'equipo_docente'=>'required',
        'equipo_docente_obs',
        'anio_carrera'=>'required|numeric',
        'anio_carrera_obs',
        'regimen_materia'=>'required',
        'regimen_materia_obs',
        'carga_horaria'=>'required|numeric',
        'carga_horaria_obs',
        'fundamentacion'=>'required',
        'fundamentacion_obs',
        'objetivos'=>'required',
        'objetivos_obs',
        'programa_contenidos'=>'required',
        'programa_contenidos_obs',
        'metodologia_trabajo',
        'metodologia_trabajo_obs',
        'sistema_evaluacion'=>'required',
        'sistema_evaluacion_obs',
        'programa_practicos',
        'programa_practicos_obs',
        'bibliografia'=>'required',
        'bibliografia_obs',
        'requisitos_rendir'=>'required',
        'requisitos_rendir_obs',
        'cronograma_trabajo',
        'cronograma_trabajo_obs',
        'funciones_equipo',
        'funciones_equipo_obs',
        'cronograma_actividades',
        'cronograma_actividades_obs',
        'mecanismos_autoeval',
        'mecanismos_autoeval_obs',
        'prev_version',
        'prox_version',
        'entregado',
        'fecha_entrega',
        'observado',
        'fecha_observado',
        'aprobado',
        'fecha_aprobado',
        ];
    }
}

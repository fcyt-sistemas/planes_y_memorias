<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterMemoriaRequest extends FormRequest
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
            'sede.'=>'reqired',
            'carrera'=>'reqired',
            'catedra'=>'reqired',
            'anio_academico'=>'reqired',
        ];
    }

    public function message()
    {
      return [
        'sede.required'=>'El :attribute es obligatorio.',
        'carrera.required'=>'El :attribute es obligatorio.',
        'catedra.required'=>'El :attribute es obligatorio.',
        'anio_academico.required'=>'El :attribute es obligatorio.',
      ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class createprofesionalRequest extends Request
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
            'nombresprof'  => 'required',
            'apellidosprof' => 'required',
            'tipodocprof' => 'required',
            'numdocprof' => 'required',
            'fnaciprof' => 'required',
            'generoprof' => 'required',
            'lugarnacprof' => 'required',
            'antigprof' => 'required',
            'estcivilprof' => 'required',
            'dirprof' => 'required',
            'telprof' => 'required',
            'mailprof' => 'required',
            'nivelprof' => 'required',
            'percarprof' => 'required'
        ];
    }
}

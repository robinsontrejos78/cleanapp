<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class editPersonaRequest extends Request
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
            'nombrePer'     => 'required',
            'apellidoPer'   => 'required',
            'celularPer'    => 'required',
            'direccionPer'  => 'required',
            'emailPer'      => 'required',
            'tipoPer'       => 'required',
            'ciudadPer'     => 'required',
            'generoPer'     => 'required'
        ];
    }
}

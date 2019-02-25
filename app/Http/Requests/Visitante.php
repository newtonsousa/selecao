<?php

namespace cadvisitante\Http\Requests;

use cadvisitante\Http\Requests\Request;

class Visitante extends Request
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
            'STR_NOME'            => 'required|max:200',
//            'INT_TIPO_DOCUMENTO'  => 'required',
//            'INT_NUMERO_DOCUMENTO'  => 'required'
            
        ];
    }
}

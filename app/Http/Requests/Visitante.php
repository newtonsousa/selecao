<?php

namespace selecao\Http\Requests;

use selecao\Http\Requests\Request;

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
            //'str_nome'            => 'required|max:200',
//             'int_tipo_documento'  => 'required',
//             'int_numero_documento'  => 'required'
            
        ];
    }
}

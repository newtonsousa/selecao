<?php

namespace selecao\Http\Requests;

use selecao\Http\Requests\Request;

class Historico extends Request
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
           /* 'STR_NOME'     => 'required|max:200'
            'STR_TIPO_DOCUMENTO'       => 'required|max:50',
            'STR_ENDERECO' => 'required',
            'STR_EMPRESA_ORGAO'      => 'required|max:200',
            'INT_NUMERO_DOCUMENTO'      => 'required|max:11',
            'INT_TELEFONE'     => 'required',
            'INT_CELULAR'      => 'required',
            'INT_CRACHA'     => 'required' 
            'STR_SIGLAUF'     => 'required'            */
        ];
    }
}

<?php

namespace cadvisitante\Http\Requests;

use cadvisitante\Http\Requests\Request;

class Destino extends Request
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
 
        ];
    }
}

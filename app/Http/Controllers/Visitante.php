<?php

namespace selecao\Http\Controllers;

use Illuminate\Http\Request;
use selecao\Http\Requests;

use selecao\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;

use selecao\Http\Requests\Visitante as VisitanteRequest;
use selecao\Models\LDAP\User as LDAPUser;

use selecao\Models\UF as Ufs;

use selecao\Models\Visitante as VisitanteModel;
use selecao\Models\TipoDocumento as TipoDocumentoModel;


class Visitante extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('visitante/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('visitante/create');
    }
    
    public function createExit()
    {
        return view('visitante/edit');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    
    public function edit()
    {
        return view('visitante/edit');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */

    public function store(VisitanteRequest $request)
    {
         $visitante = VisitanteModel::where('id', $request->input('id'));

        if($visitante->count() === 0){

            try {
                $visitante = new VisitanteModel;
                $visitante->str_nome             = $request->input('str_nome');
                $visitante->str_endereco         = $request->input('str_endereco');               
                $visitante->str_empresa_orgao    = $request->input('str_empresa_orgao');
                $visitante->int_tipo_documento   = $request->input('int_tipo_documento');
                $visitante->int_numero_documento = $request->input('int_numero_documento');
                $visitante->int_telefone         = $request->input('int_telefone');
                $visitante->int_celular          = $request->input('int_celular');
                $visitante->int_codigouf         = $request->input('int_codigouf');
              
                if($visitante->save()) {
                    return response()->json([
                        'type' => 'success',
                        'message' => trans('info.insert_success'), 
                        'visitante' => $visitante
                    ]);
                }
            } catch(Exception $e) {
                    return response()->json([
                        'type' => 'danger',
                        'message' => $e->getMessage()
                    ]);
            }
        } else {
            return response()->json([
                'type' => 'info',
                'message' => trans('errors.field_already_exists', ['field_name' => 'Visitante'])
            ]);
        }
        
    }
    
    
    function valida_cpf($cpf) {
        
        // verifica se e numerico
        if(!is_numeric($cpf)) {
        return false;
        }

        // verifica se esta usando a repeticao de um numero
        if( ($cpf == '11111111111') || ($cpf == '22222222222') || ($cpf == '33333333333') || ($cpf == '44444444444') || ($cpf == '55555555555') || ($cpf == '66666666666') || ($cpf == '77777777777') || ($cpf == '88888888888') || ($cpf == '99999999999') || ($cpf == '00000000000') ) {
        return false;
        }

        //PEGA O DIGITO VERIFIACADOR
        $dv_informado = substr($cpf, 9,2);

        for($i=0; $i<=8; $i++) {
        $digito[$i] = substr($cpf, $i,1);
        }

        //CALCULA O VALOR DO 10º DIGITO DE VERIFICAÇÂO
        $posicao = 10;
        $soma = 0;

        for($i=0; $i<=8; $i++) {
        $soma = $soma + $digito[$i] * $posicao;
        $posicao = $posicao - 1;
        }

        $digito[9] = $soma % 11;

        if($digito[9] < 2) {
        $digito[9] = 0;
        } else {
        $digito[9] = 11 - $digito[9];
        }

        //CALCULA O VALOR DO 11º DIGITO DE VERIFICAÇÃO
        $posicao = 11;
        $soma = 0;

        for ($i=0; $i<=9; $i++) {
        $soma = $soma + $digito[$i] * $posicao;
        $posicao = $posicao - 1;
        }

        $digito[10] = $soma % 11;

        if ($digito[10] < 2) {
        $digito[10] = 0;
        }
        else {
        $digito[10] = 11 - $digito[10];
        }

        //VERIFICA SE O DV CALCULADO É IGUAL AO INFORMADO
        $dv = $digito[9] * 10 + $digito[10];
        if ($dv != $dv_informado) {
        return false;
        }

        return true;
    } // function valida_cpf($cpf)
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function delete(VisitanteRequest $request)
    {
        $visitante = VisitanteModel::find($request->input('id'));
        
        foreach ($request->input() as $key => $value) {
            if($key !== 'id') {
                $visitante->$key = $value;
            }
        }
        
        $visitante->delete();
        
        dd($visitante);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(VisitanteRequest $request, $id)
    {
        $visitante = VisitanteModel::find($request->input('id'));

        foreach ($request->input() as $key => $value) {
            if($key !== 'id') {
                $visitante->$key = $value;
            }
        }

        //if( $visitante->int_tipo_documento == '3' ){
            
           $cpf = $this->valida_cpf($visitante->int_numero_documento);                    
           if( $cpf ==  false ){
                return response()->json([ 
                    'message' => trans('CPF inválido.')
                ]);
               die;     
           }else{
                if($visitante->save()) {
                    return response()->json([ 
                        'message' => trans('info.update_success')
                    ]);
                }
                $visitante->save();
                dd($visitante);    
           }
//         }else{
//             if($visitante->save()) {
//                 return response()->json([ 
//                     'message' => trans('info.update_success')
//                 ]);
//             }
//             dd($visitante);
//         }
 
//        $visitante = VisitanteModel::find($request->input('id'));

//        foreach ($request->input() as $key => $value) {
//            if($key !== 'id') {
//                $visitante->$key = $value;
//            }
//        }

//        if($visitante->save()) {
//                    return response()->json([ 
//                        'message' => trans('info.update_success')
//                    ]);
//                }
//        dd($visitante);
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }   
    
    public function getAllUFs() {
        return json_encode(Ufs::getAllUfs()) ;
    }
    
    
}

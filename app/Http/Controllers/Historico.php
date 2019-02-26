<?php

namespace selecao\Http\Controllers;

use Illuminate\Http\Request;
use selecao\Http\Requests;

use selecao\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;

use selecao\Http\Requests\Historico as HistoricoRequest;
use selecao\Models\Historico as HistoricoModel;


class Historico extends Controller
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
    
//    public function createHistorico()
//    {
//        return view('visitante/edit');
//    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */

    public function store(HistoricoRequest $request)
    {
       
//             try {
//                 $historico = new HistoricoModel;
//                 $historico->str_nome      = $request->input('str_nome');
//                 $historico->str_setor     = $request->input('str_setor');               
//                 $historico->str_evento    = $request->input('str_evento');
//                 $historico->int_fone      = $request->input('int_fone');
//                 $historico->int_codigo    = $request->input('int_codigo');               
//                 $historico->str_sala      = $request->input('str_sala');
//                 $historico->str_andar     = $request->input('str_andar');
//                 $historico->co_user       = $request->input('co_user');
//                 $historico->str_unidade   = $request->input('str_unidade');
//                 $historico->int_cracha = $request->input('int_cracha');
//                 $historico->str_responsavel_entrada = $request->session()->get('usuario');
              
//                 if($historico->save()) {
//                     return response()->json([
//                         //'type' => 'success',
//                         'message' => trans('info.insert_success')
//                     ]);
//                 }
//             } catch(Exception $e) {
//                     return response()->json([
//                         'type' => 'danger',
//                         'message' => $e->getMessage()
//                     ]);
//             }

    }

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
       
    public function update(Request $request, $id)
    {

         try {
             $date = date('Y-m-d H:i:s');
            
             $historico = HistoricoModel::findOrFail($id);
             $historico->dt_saida = $date;
             $historico->str_nome = $request->input('str_nome');
             $historico->int_fone = $request->input('int_telefone');
             $historico->dt_entrada = $date;
//             $historico->co_user = $request->input('co_user');
//             $historico->str_responsavel_saida = $request->session()->get('usuario');

            if($historico->save()) {
                return response()->json([
                    'type' => 'success',
                    'message' => trans('info.update_success')
                ]);
             }

        } catch(Exception $e) {
            return response()->json([
                'type' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
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

}

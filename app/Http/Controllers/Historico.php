<?php

namespace cadvisitante\Http\Controllers;

use Illuminate\Http\Request;
use cadvisitante\Http\Requests;

use cadvisitante\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;

use cadvisitante\Http\Requests\Historico as HistoricoRequest;
use cadvisitante\Models\Historico as HistoricoModel;


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
        $historico = HistoricoModel::where('id', $request->input('id'));
        if($historico->count() === 0){

            try {
                $historico = new HistoricoModel;
                $historico->STR_NOME      = 'teste';//$request->input('STR_NOME');
                $historico->INT_TELEFONE  = '61977665654';  // $request->input('INT_TELEFONE');
              
                if($historico->save()) {
                    return response()->json([
                        //'type' => 'success',
                        'message' => trans('info.insert_success')
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
                'message' => trans('errors.field_already_exists', ['field_name' => 'Historico'])
            ]);
        }
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

            if($historico->save()) {
                return response()->json([
                    //'type' => 'success',
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
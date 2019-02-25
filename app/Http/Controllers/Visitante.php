<?php

namespace cadvisitante\Http\Controllers;

use Illuminate\Http\Request;
use cadvisitante\Http\Requests;
use cadvisitante\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;
use cadvisitante\Http\Requests\Visitante as VisitanteRequest;
use cadvisitante\Models\UF as Ufs;
use cadvisitante\Models\Visitante as VisitanteModel;

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
    
    /*
     * $visitante = Visitante::findOrfail(40);
//        var_dump($visitante);die;
//        
//        return view('visitante/edit.blade.php', compact($visitante));
     */

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
                $visitante->STR_NOME             = $request->input('STR_NOME');
                $visitante->STR_ENDERECO         = $request->input('STR_ENDERECO');               
                $visitante->STR_EMPRESA_ORGAO    = $request->input('STR_EMPRESA_ORGAO');
                $visitante->INT_TIPO_DOCUMENTO   = $request->input('INT_TIPO_DOCUMENTO');
                $visitante->INT_NUMERO_DOCUMENTO = $request->input('INT_NUMERO_DOCUMENTO');
                $visitante->INT_TELEFONE         = $request->input('INT_TELEFONE');
                $visitante->INT_CELULAR          = $request->input('INT_CELULAR');  
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
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $visitante = VisitanteModel::find($request->input('id'));

        foreach ($request->input() as $key => $value) {
            if($key !== 'id') {
                $visitante->$key = $value;
            }
        }

        if($visitante->save()) {
                    return response()->json([ 
                        'message' => trans('info.update_success')
                    ]);
                }
        dd($visitante);

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

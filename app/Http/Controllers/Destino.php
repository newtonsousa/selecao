<?php

namespace cadvisitante\Http\Controllers;

use Illuminate\Http\Request;
use cadvisitante\Http\Requests;

use cadvisitante\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;

use cadvisitante\Http\Requests\Destino as DestinoRequest;
use cadvisitante\Models\LDAP\User as LDAPUser;
use cadvisitante\Models\Destino as DestinoModel;

class Destino extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('destino/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('destino/create');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */

    public function store(DestinoRequest $request)
    {
       
        $visitante = DestinoModel::where('STR_NOME', $request->input('STR_NOME'));

        if($destino->count() === 0){

            try {
                $destino = new DestinoModel;
//                $visitante->STR_NOME             = $request->input('STR_NOME');
//                $visitante->STR_ENDERECO         = $request->input('STR_ENDERECO');               
//                $visitante->STR_EMPRESA_ORGAO    = $request->input('STR_EMPRESA_ORGAO');
//                $visitante->INT_TIPO_DOCUMENTO   = $request->input('INT_TIPO_DOCUMENTO');
//                $visitante->INT_NUMERO_DOCUMENTO = $request->input('INT_NUMERO_DOCUMENTO');
//                $visitante->INT_TELEFONE         = $request->input('INT_TELEFONE');
//                $visitante->INT_CELULAR          = $request->input('INT_CELULAR');
//                $visitante->INT_CRACHA           = $request->input('INT_CRACHA');   
//                $visitante->STR_SIGLAUF          = $request->input('STR_SIGLAUF');
              
                if($visitante->save()) {
                    return response()->json([
                        'type' => 'success',
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
                'message' => trans('errors.field_already_exists', ['field_name' => 'Destino'])
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
    public function update(DestinoRequest $request)
    {
        $destino = DestinoModel::find($request->input('id'));

        foreach ($request->input() as $key => $value) {
            if($key !== 'id') {
                $destino->$key = $value;
            }
        }

        $destino->save();

        dd($destino);
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
    
    public function getAllDestino() {
        return json_encode(Destino::all()->toArray()) ;
    }
    
    
}

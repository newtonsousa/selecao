<?php

namespace selecao\Http\Controllers;

use Illuminate\Http\Request;
use selecao\Http\Requests;

use selecao\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;

use selecao\Http\Requests\TipoDocumento as TipoDocumentoRequest;
use selecao\Models\TipoDocumento as TipoDocumentoModel;

class TipoDocumento extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('tipoDocumento/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipoDocumento/create');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */

    public function store(TipoDocumentoRequest $request)
    {
       
        $tipoDocumento = TipoDocumentoModel::where('str_tipo_documento', $request->input('str_tipo_documento'));

        if($tipoDocumento->count() === 0){

            try {
                $tipoDocumento = new SetorModel;

              
                if($tipoDocumento->save()) {
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
                'message' => trans('errors.field_already_exists', ['field_name' => 'TipoDocumento'])
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
    public function update(SetorRequest $request)
    {
        $tipoDocumento = TipoDocumentoModel::find($request->input('id'));

        foreach ($request->input() as $key => $value) {
            if($key !== 'id') {
                $tipoDocumento->$key = $value;
            }
        }

        $tipoDocumento->save();

        dd($tipoDocumento);
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

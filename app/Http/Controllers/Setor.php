<?php

namespace selecao\Http\Controllers;

use Illuminate\Http\Request;
use selecao\Http\Requests;

use selecao\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;

use selecao\Http\Requests\Setor as SetorRequest;
use selecao\Models\LDAP\User as LDAPUser;
use selecao\Models\Setor as SetorModel;

class Setor extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('setor/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('setor/create');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */

    public function store(SetorRequest $request)
    {
       
        $setor = SetorModel::where('str_nome', $request->input('str_nome'));

        if($setor->count() === 0){

            try {
                $setor = new SetorModel;

              
                if($setor->save()) {
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
                'message' => trans('errors.field_already_exists', ['field_name' => 'Setor'])
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
        $setor = SetorModel::find($request->input('id'));

        foreach ($request->input() as $key => $value) {
            if($key !== 'id') {
                $destino->$key = $value;
            }
        }

        $setor->save();

        dd($setor);
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
    
    public function getAllSetor() {
        return json_encode(Setor::select('co_department', 'no_department', 'no_acronym')->where('no_acronym', '!=' , '')->toArray());
    }
    
    
}

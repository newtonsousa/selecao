<?php
use cadvisitante\Models\Visitante;
use cadvisitante\Models\LDAP\User;
use cadvisitante\Models\UF as UF;
use cadvisitante\Models\Destino as Destino;
use cadvisitante\Models\Setor as Setor;
use cadvisitante\Models\Historico as Historico;
use cadvisitante\Models\Historico as HistoricoVisitante;
use cadvisitante\Models\TipoDocumento as TipoDocumento;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [ 'as' => 'Home', 'uses' => 'Application@index']);

Route::group(['prefix' => 'api'], function () {
    
    Route::group(['prefix' => 'visitante'], function () {
        Route::get('/', function() { 
            return response()->json(
                    Visitante::select('id', 'visitante.STR_NOME', 'visitante.STR_ENDERECO', 'visitante.STR_EMPRESA_ORGAO', 'tipo_documento.STR_TIPO_DOCUMENTO', 'visitante.INT_NUMERO_DOCUMENTO', 'visitante.INT_TELEFONE', 'visitante.INT_CELULAR' )
                    ->join('tipo_documento', 'tipo_documento.INT_TIPO_DOCUMENTO', '=', 'visitante.INT_TIPO_DOCUMENTO') 
                    ->get()
                    ->toArray()    
                );          
        });
        
        Route::get('/{id}', function($id) {
            return response()->json(Visitante::findOrFail($id));
        });
        Route::post('/', ['uses' => 'Visitante@store']);
        Route::put('/{id}', ['uses' => 'Visitante@update']);
    });
    
    
    Route::group(['prefix' => 'historico'], function () {
        Route::get('/', function() { 
            return response()->json(Historico::all());       
        });
        
        Route::get('/{id}', function($id) {
            return response()->json(Historico::findOrFail($id));
        });
        
        Route::post('/', ['uses' => 'Historico@store']);
        Route::put('/{id}', ['uses' => 'Historico@update']);
    });
       
    Route::group(['prefix' => 'historicoVisitante'], function () {       
        Route::get('/{id}', function($id) {
            return response()->json(HistoricoVisitante::select('historico.*' )
                ->join('visitante', 'historico.INT_CODIGO', '=', 'visitante.id')
                ->where('visitante.id', '=', $id )  
                ->get()
                ->toArray()
            );
        });
        
        Route::post('/', ['uses' => 'Historico@store']);
        Route::put('/{id}', ['uses' => 'Historico@update']);
    });
         
    Route::group(['prefix' => 'uf'], function () {
        Route::get('/', function() { 
            return response()->json(UF::all());          
        });
    });
       
    Route::group(['prefix' => 'tipoDocumento'], function () {
        Route::get('/', function() { 
            return response()->json(
                    TipoDocumento::all()->toArray());           
        });
        Route::get('/{id}', function($id) {
            return response()->json(TipoDocumento::findOrFail($id));
        });
    });
       
    Route::group(['prefix' => 'destino'], function () {
        Route::get('/', function() { 
            return response()->json(
                DB::connection('postgres')->select('
                        SELECT tu.co_user, tu.no_user, tumd.ds_value as Andar, tumd1.ds_value as Sala, p.nu_phone 
                        FROM  tb_user_meta_data as tumd
                        INNER JOIN tb_user_meta_data as tumd1 ON tumd.co_user = tumd1.co_user AND tumd1.co_dynamic_form_field = 125
                        INNER JOIN  tb_user as tu ON tu.co_user = tumd.co_user
                        INNER JOIN tb_phone as p  ON p.co_user = tu.co_user
                         WHERE tumd.co_dynamic_form_field = 124 ')      
                );
//                Destino::select('tb_user.co_user', 'no_user', 'fl_active', 'nu_phone' )
//                    ->join('tb_phone', 'tb_phone.co_user', '=', 'tb_user.co_user')
//                    ->where('no_user', '!=' , '', ' and ', 'fl_active', ' != ' , 'false' )  
//                    ->get()
//                    ->toArray()
//                );           
        });
    });
    
    Route::group(['prefix' => 'relatorio'], function () {
        Route::get('/', function() { 
            return response()->json(
                Visitante::select('historico.str_nome', 'historico.STR_SETOR', 'historico.STR_EVENTO', 'historico.INT_FONE', 'historico.created_at', 'historico.dt_saida', 'visitante.STR_NOME', 
                        'visitante.STR_ENDERECO', 'visitante.STR_EMPRESA_ORGAO', 'tipo_documento.STR_TIPO_DOCUMENTO', 'visitante.INT_NUMERO_DOCUMENTO', 'visitante.INT_TELEFONE', 'visitante.INT_CELULAR',
                        'visitante.INT_CRACHA', 'visitante.int_codigouf', 'historico.str_sala', 'historico.str_andar' )
                    ->join('historico', 'historico.INT_CODIGO', '=', 'visitante.id') 
                    ->join('tipo_documento', 'tipo_documento.INT_TIPO_DOCUMENTO', '=', 'visitante.INT_TIPO_DOCUMENTO') 
                    ->get()
                    ->toArray()     
                );           
        });
        
        Route::get('pdf', [ 'as' => 'homeRelatorio', 'uses' => 'Relatorio@show']);
    });
    
    Route::group(['prefix' => 'setor'], function () {
        Route::get('/', function() { 
            return response()->json(
                Setor::select('co_department', 'no_department', 'no_acronym')
                    ->where('no_acronym', '!=' , '')
                    ->get()
                    ->toArray()
                );
        });
    });
    
    Route::group(['prefix' => 'ldap'], function () {
        Route::get('/', function() { return response()->json(User::getAllUsers());});
    });

});

Route::group(['prefix' => 'layout'], function () {
    Route::get('/modal-with-confirmation', function() {
        return view('layout/modal-with-confirmation');
    });
});

Route::group(['prefix' => 'visitante'], function () {
    Route::get('/modal-with-confirmation', function() {
        return view('visitante/modal');
    });
});

Route::group(['prefix' => 'visitante'], function () {
    Route::get('/', [ 'as' => 'homeVisitante', 'uses' => 'Visitante@index']);
    Route::get('create', [ 'as' => 'createVisitante', 'uses' => 'Visitante@create']);
    Route::get('createExit', [ 'as' => 'createExitVisitante', 'uses' => 'Visitante@createExit']);
    Route::get('edit', [ 'as' => 'updateVisitante', 'uses' => 'Visitante@edit']);
    Route::post('create', [ 'as' => 'storeVisitante', 'uses' => 'Visitante@store']);
    Route::get('ldap_users', [ 'as' => 'LDAPUsers', 'uses' => 'Visitante@getAllLDAPUsers']);
});

Route::group(['prefix' => 'relatorio'], function () {
    Route::get('/', [ 'as' => 'homeRelatorio', 'uses' => 'Relatorio@index']);
    Route::get('create', [ 'as' => 'createRelatorio', 'uses' => 'Relatorio@create']);  
});


//Route::group(['prefix' => 'login'], function () {
//    Route::get('/', [ 'as' => 'homeLogin', 'uses' => 'Login@index']);
//    Route::get('create', [ 'as' => 'createLogin', 'uses' => 'Login@create']);
//});

Route::group(['prefix' => 'historico'], function () {
    Route::get('/', [ 'as' => 'homeHistorico', 'uses' => 'Historico@index']);
    Route::get('create', [ 'as' => 'createHistorico', 'uses' => 'Historico@create']);
    Route::post('create', [ 'as' => 'storeHistorico', 'uses' => 'Historico@store']);  
});


<?php
use selecao\Models\Visitante;
use selecao\Models\LDAP\User;
use selecao\Models\UF as UF;
use selecao\Models\Setor as Setor;
use selecao\Models\Historico as Historico;
use selecao\Models\Historico as HistoricoVisitante;
use selecao\Models\TipoDocumento as TipoDocumento;
use Illuminate\Http\Request;


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

Route::group(['prefix' => 'login'], function () {       
    Route::get('/', [ 'as' => 'homeLogin', 'uses' => 'Login@index']);
    Route::get('/sair', [ 'as' => 'sairLogin', 'uses' => 'Login@sair']);
    Route::post('/', [ 'as' => 'homeCredencial', 'uses' => 'Login@validar']);
});


Route::group(['prefix' => 'api', 'middleware' => 'ValidaLogin'], function () {

    Route::group(['prefix' => 'visitante'], function () {
        Route::get('/', function() { 
            return response()->json(
                    Visitante::select('id', 'visitante.str_nome', 'visitante.str_endereco', 'visitante.str_empresa_orgao', 'visitante.int_numero_documento', 'visitante.int_telefone', 'visitante.int_celular' )
                    ->get()
                    ->toArray()    
                );          
        });
        
        Route::get('/{id}', function($id) {
            return response()->json(Visitante::findOrFail($id));
        });
        Route::post('/', ['uses' => 'Visitante@store']);
        Route::put('/{id}', ['uses' => 'Visitante@update']);
        Route::delete('/{id}', ['uses' => 'Visitante@delete']);
    });
    
    
    Route::group(['prefix' => 'historico'], function () {
        Route::get('/', function() { 
            return response()->json(Historico::select('historico.*','historico.int_cracha')
                    ->join('visitante', 'historico.int_codigo', '=', 'visitante.id')
                    ->get()
                    ->toArray()
                    );       
        });
        
        Route::get('/{id}', function($id) {
            return response()->json(Historico::findOrFail($id));
        });
        
        Route::post('/', ['uses' => 'Historico@store']);
        Route::put('/{id}', ['uses' => 'Historico@update']);
    });
       
    Route::group(['prefix' => 'historicoVisitante'], function () {       
        Route::get('/{id}', function($id) {
            return response()->json(Visitante::findOrFail($id));
        });
        
        Route::post('/', ['uses' => 'Historico@store']);
        Route::put('/{id}', ['uses' => 'Historico@update']);
    });
         
    Route::group(['prefix' => 'uf'], function () {
        Route::get('/', function() { 
            return response()->json(UF::all());          
        });
    });
          
    Route::group(['prefix' => 'relatorio'], function () {
        Route::get('/', function() {
                           
            return response()->json(
                Visitante::select('visitante.str_nome', 
                        'visitante.str_endereco', 'visitante.str_empresa_orgao', 'visitante.int_numero_documento', 'visitante.int_telefone', 'visitante.int_celular' )
                    ->get()
                    ->toArray()     
            );           
        });
        
        Route::get('pdf', [ 'as' => 'homeRelatorio', 'uses' => 'Relatorio@show']);
        Route::get('pdf/{dtIni}', [ 'as' => 'homeRelatorio', 'uses' => 'Relatorio@show']);
        Route::get('pdf/{dtFim}', [ 'as' => 'homeRelatorio', 'uses' => 'Relatorio@show']);
        Route::get('pdf/{dtIni}/{dtFim}', [ 'as' => 'homeRelatorio', 'uses' => 'Relatorio@show']);
  
        
    });
    
    
    Route::group(['prefix' => 'ldap'], function () {
        Route::get('/', function() { 
            return response()->json(User::getAllUsers());
        });
    });

});

Route::group(['prefix' => 'layout', 'middleware' => 'ValidaLogin'], function () {
    Route::get('/modal-with-confirmation', function() {
        return view('layout/modal-with-confirmation');
    });
});

Route::group(['prefix' => 'visitante', 'middleware' => 'ValidaLogin'], function () {
    Route::get('/modal-with-confirmation', function() {
        return view('visitante/modal');
    });
});

Route::group(['prefix' => 'visitante', 'middleware' => 'ValidaLogin'], function () {
    Route::get('/', [ 'as' => 'homeVisitante', 'uses' => 'Visitante@index']);
    Route::get('create', [ 'as' => 'createVisitante', 'uses' => 'Visitante@create']);
    Route::get('createExit', [ 'as' => 'createExitVisitante', 'uses' => 'Visitante@createExit']);
    Route::get('edit', [ 'as' => 'updateVisitante', 'uses' => 'Visitante@edit']);
    Route::delete('delete', [ 'as' => 'deleteVisitante', 'uses' => 'Visitante@delete']);
    Route::post('create', [ 'as' => 'storeVisitante', 'uses' => 'Visitante@store']);
    Route::get('ldap_users', [ 'as' => 'LDAPUsers', 'uses' => 'Visitante@getAllLDAPUsers']);
});

Route::group(['prefix' => 'relatorio', 'middleware' => 'ValidaLogin'], function () {
    Route::get('/', [ 'as' => 'homeRelatorio', 'uses' => 'Relatorio@index']);
    Route::get('create', [ 'as' => 'createRelatorio', 'uses' => 'Relatorio@create']);  
});


Route::group(['prefix' => 'historico', 'middleware' => 'ValidaLogin'], function () {
    Route::get('/', [ 'as' => 'homeHistorico', 'uses' => 'Historico@index']);
    Route::get('create', [ 'as' => 'createHistorico', 'uses' => 'Historico@create']);
    Route::post('create', [ 'as' => 'storeHistorico', 'uses' => 'Historico@store']);  
});


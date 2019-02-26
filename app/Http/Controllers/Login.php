<?php

namespace selecao\Http\Controllers;

use Illuminate\Http\Request;
use selecao\Http\Requests;

use \Cookie as Cookie;
use \Session as Session;
use \Response as Response;

use selecao\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;

use selecao\Http\Requests\Login as LoginRequest;
use selecao\Models\LDAP\User as LDAPUser;
use selecao\Models\CSA as CSAModel;

class Login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public function index(Request $request)
    {
        return view('login/login');
    }
    	
    public function validar(Request $request)
    {       
        $usuario = $request->input("email");
        $senha = $request->input("senha");
        
        try  {
            if($usuario === 'newton@gmail.com' && $senha === 'teste') {
                  
                $permissoes = true;
                Session::put('autenticacao', [                    
                    'email' => $usuario,
                    'permissoes' => $permissoes
                ]);

                $cookie = Cookie::forever('autenticacao', collect([
                    'email' => $usuario,
                    'permissoes' => $permissoes
                ])->toJson(), null, null, false, false);
                
                return Response::json([
                    'type' => 'success',
                    'message' => trans('Login efetuado com sucesso.'),
                    'permissoes' => $permissoes
                ])->withCookie($cookie);
            } else {
                return response()->json([
                    'type' => 'danger',
                    'message' => trans('Senha ou login inválidos.')
                ]);
            }
          
        } catch(Exception $e) {
            return response()->json([
                'type' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
                        
    }
    
    public function sair(Request $request)
    {
 
        $request->session()->flush();
        return Response::json([
                'type' => 'success',
                'message' => trans('Logoff efetuado com sucesso.')
        ])->withCookie(Cookie::forget('autenticacao'));   
        
    }
    
    public function getAutenticacao() 
    {
        return collect(Session::get('autenticacao'))->toJson();
    }
    
}

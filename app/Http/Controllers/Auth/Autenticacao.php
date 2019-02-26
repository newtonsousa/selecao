<?php

namespace selecao\Http\Controllers\Auth;

use selecao\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Cookie as Cookie;
use \Session as Session;
use \Response as Response;

use selecao\Models\LDAP\User as LDAPUser;
use selecao\Models\CSA as CSAModel;

use selecao\Http\Requests\Autenticacao as AutenticacaoRequest;

class Autenticacao extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    
    public function login(AutenticacaoRequest $request) {
        
        $usuario = $request->input("usuario");
        $senha = $request->input("senha");

        try  {
            if(LDAPUser::login($usuario, $senha)) {
                Session::put('autenticacao', [
                    'usuario' => $usuario,
                    'permissoes' => CSAModel::getPermissoes($usuario)
                ]);
                $cookie = Cookie::forever('autenticacao', collect([
                    'usuario' => $usuario,
                    'permissoes' => CSAModel::getPermissoes($usuario)
                ])->toJson(), null, null, false, false);

                return Response::json([
                    'type' => 'success',
                    'message' => trans('info.login_success')
                ])->withCookie($cookie);
            } else {
                return response()->json([
                    'type' => 'danger',
                    'message' => trans('errors.login_invalid')
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'type' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return Response::json([
                'type' => 'success',
                'message' => trans('info.logoff_success')
        ])->withCookie(Cookie::forget('autenticacao'));
    }

    public function getAutenticacao() {
        return collect(Session::get('autenticacao'))->toJson();
    }
}

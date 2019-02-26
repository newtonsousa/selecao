<?php

namespace selecao\Http\Middleware;

use Closure;

class ValidaLogin
{

    public function handle($request, Closure $next)
    {
      
        if (!$request->session()->has('autenticacao')) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}

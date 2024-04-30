<?php

namespace App\Http\Middleware;

use Closure;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $perfil, $tipo)

    
    {
        /*echo $perfil . "<br/>".
        $tipo . "<br/>";
        if(false){
            return $next($request);
        } else{
            return Response ('Não autorizado');
        }*/

        session_start();
        if(isset($_SESSION['email']) && $_SESSION != ''){
            return $next($request);
        } else {
            return redirect()->route('site.login', ['erro' => 2]);
        }
        
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\LogAcesso;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo 'Olá';
        //return $next($request);
        //dd($request->server->get('REMOTE_ADDR'));

        /*$ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->server->get('REQUEST_URI');
        //$rota = $request->getRequestUri();
        LogAcesso::create(['log' =>  "$ip acessou a rota $rota"]);*/
        //return Response("Olá");

        //return $next($request);
        $resposta = $next($request);

        $resposta->setStatusCode(300, "Olá mundo");

        return $resposta;
    }
}

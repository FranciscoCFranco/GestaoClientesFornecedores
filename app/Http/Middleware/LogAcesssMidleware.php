<?php

namespace App\Http\Middleware;

use Closure;
use App\LogAcesso;

class LogAcesssMidleware
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

        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();

        LogAcesso::create(['log' => "$ip xyz requisitou a $rota"]);

        return $next($request);
    }
}

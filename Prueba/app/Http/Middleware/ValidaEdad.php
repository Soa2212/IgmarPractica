<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidaEdad
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        if($request -> get('edad') >= 18)
            return $next($request);
        abort(406,'El requisito de la edad no se cumple');
    }
}

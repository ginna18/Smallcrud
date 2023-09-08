<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    //miramos si la edad en la requ si el el usuario es menor de edad
    public function handle(Request $request, Closure $next){


        if ($request->query('edad')<18) 
            abort(403,'Acceso denegado, debes ser matyor de edad para acceder a este contenido');
        
        // en realidad, cuando tengamos el modelo user, se comprobara la edad real del usuario
        //if ($user->edad<18)...
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Route;

class IsBlocked{
    //configurable: nombre de rutas web permitidads para los usuarios bloqueados
    //podriamos sacarlas hacia el fichero de configuracion(p.e:/config/users.php
    //permitiremos las operaciones de contacto, logout y user.blocked(evita loop))
    protected $allowed=['contacto','contacto.email','user.blocked','logout'];

    //maneja la peticion entrante
    public function handle(Request $request, Closure $next){

                    $user = $request->user();    //toma el usuario identificado
                    $ruta = Route::currentRouteName(); //toma el nombre de la ruta

                    //si hay usuario, esta bloqueado e intenta acceder a una ruta no permitida,
                    //le llevamos a la ruta de bloqueo

        if($user && $user->hasRole('bloqueado') && !in_array($ruta, $this->allowed))
            return redirect()->route('user.blocked');

            return $next($request);
    }
}

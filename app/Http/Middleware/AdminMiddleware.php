<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Maneja la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario tiene el rol de 'admin'
        if (Auth::check() && Auth::user()->role !== 'admin') {
            // Redirige si no tiene el rol adecuado
            return redirect('/');
        }

        // Permite continuar con la solicitud
        return $next($request);
    }
    
}


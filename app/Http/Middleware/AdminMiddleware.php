<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y si es un administrador
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Redirigir a la página de inicio si no es administrador
        return redirect('/')->with('error', 'No tienes acceso a esta página.');
    }
}

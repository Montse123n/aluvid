<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/sectores'; // Puedes dejarlo como fallback.

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle redirection after login based on user role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('administrador')) {
            return redirect()->route('admin.index'); // Ruta para administradores
        } elseif ($user->hasRole('usuario')) {
            return redirect()->route('productos.sectores'); // Ruta para usuarios normales
        }

        return redirect($this->redirectTo); // Fallback si no hay roles
    }
}


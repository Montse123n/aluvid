<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $role = auth()->user()->role;

        if ($role === 'administrador') {
            return redirect()->route('admin.index');
        } elseif ($role === 'trabajador') {
            return redirect()->route('admin.index'); // Trabajador ve las mismas páginas que el admin excepto perfiles
        } else {
            return redirect()->route('home'); // Usuario normal
        }
    }

    return back()->withErrors(['email' => 'Credenciales incorrectas']);
}

}


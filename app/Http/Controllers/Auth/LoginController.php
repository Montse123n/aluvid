<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Método que se llama después de que un usuario inicia sesión
    protected function authenticated(Request $request, $user)
    {
        // Verificar si el usuario es el administrador
        if ($user->email === 'garciamontse1974@gmail.com' && $user->password === Hash::make('Gar07cia03')) {
            return redirect()->route('productos.create'); // Ruta para el registro de productos
        }
    
        // Si no es el administrador, redirigir al catálogo
        return redirect()->route('catalogo-productos'); // Ruta para el catálogo de productos
    }
}

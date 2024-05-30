<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar el inicio de sesión de usuarios.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers; // Utiliza el trait AuthenticatesUsers proporcionado por Laravel para gestionar la autenticación

    /**
     * Redirecciona al usuario después de iniciar sesión, verificando primero si el correo electrónico está verificado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Verifica si el usuario no ha verificado su correo electrónico
        if (!$user->hasVerifiedEmail()) {
            // Cierra la sesión del usuario y redirige a la página de verificación de correo electrónico
            auth()->logout();
            return redirect('/email/verify')->with('message', 'Debes verificar tu correo electrónico.');
        }

        // Redirige al usuario a la página a la que intentaba acceder originalmente
        return redirect()->intended($this->redirectPath());
    }
}

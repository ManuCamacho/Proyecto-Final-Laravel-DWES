<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectIfNotVerifiedController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function __invoke()
    {
        // Puedes cambiar '/home' a la ruta que desees que vean los usuarios verificados
        return redirect('/home');
    }
}

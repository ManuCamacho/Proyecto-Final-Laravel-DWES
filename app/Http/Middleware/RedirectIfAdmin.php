<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->usertype === 'admin') {
            // Si el usuario es un administrador, redirige a la ruta del dashboard administrativo
            return redirect()->route('admin.products.index');
        }

        // De lo contrario, permite que la solicitud continúe normalmente
        return $next($request);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controlador para la página de inicio.
 */
class HomeController extends Controller
{
    /**
     * Muestra la página de inicio del panel de administración.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Retorna la vista del panel de administración
        return view('admin.dashboard');
    }
}

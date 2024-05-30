<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controlador para la gestión del calendario.
 */
class CalendarController extends Controller
{
    /**
     * Muestra el calendario.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Aquí puedes agregar la lógica para mostrar el calendario
        
        return view('calendar'); // Asumiendo que tienes una vista llamada 'index.blade.php' en la carpeta 'calendar'
    }
}

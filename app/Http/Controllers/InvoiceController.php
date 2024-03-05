<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        // Obtener el usuario de la sesión
        $user = auth()->user();

        // Obtener las facturas del usuario
        $invoices = Invoice::where('user_id', $user->id)->get();

        // Cargar la vista invoices.blade.php con las facturas
        return view('invoices', compact('invoices'));
    }
}

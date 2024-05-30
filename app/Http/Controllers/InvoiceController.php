<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Importa la clase PDF
use App\Models\Invoice;

/**
 * Controlador para la gestión de facturas.
 */
class InvoiceController extends Controller
{
    /**
     * Muestra todas las facturas del usuario actual.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtener las facturas del usuario
        $invoices = Invoice::where('user_id', $user->id)->get();

        // Cargar la vista 'invoices.blade.php' con las facturas
        return view('invoices', compact('invoices'));
    }

    /**
     * Descarga la factura en formato PDF.
     *
     * @param  \App\Models\Invoice $invoice
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Invoice $invoice)
    {
        // Obtener el usuario autenticado
        $user = auth()->user();
    
        // Generar el nombre del archivo PDF
        $fileName = 'Factura ' . $invoice->id . '.pdf';
    
        // Renderizar la vista 'invoice.blade.php' con los datos de la factura y el usuario
        $pdf = PDF::loadView('invoice', compact('invoice', 'user'));
    
        // Descargar el PDF con el nombre generado
        return $pdf->download($fileName);
    }
}

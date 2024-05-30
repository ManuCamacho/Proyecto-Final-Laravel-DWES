<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MarketingEmail; // Importa la clase de correo electrónico de marketing
use App\Models\User;

/**
 * Controlador para enviar correos electrónicos de marketing.
 */
class MarketingController extends Controller
{
    /**
     * Envía correos electrónicos de marketing a los usuarios que aceptaron recibirlos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMarketingEmail(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Obtiene los datos del formulario
        $subject = $request->input('subject');
        $title = $request->input('title');
        $content = $request->input('content');

        // Obtiene todos los usuarios que aceptaron recibir marketing
        $users = User::where('accepts_marketing', 1)->get();

        // Envía el correo a cada usuario
        foreach ($users as $user) {
            Mail::to($user->email)->send(new MarketingEmail($subject, $title, $content));
        }

        // Redirige de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Correos de publicidad enviados correctamente.');
    }
}

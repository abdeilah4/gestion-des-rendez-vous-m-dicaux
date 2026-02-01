<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Envoi de l'email
        Mail::raw($request->message, function ($mail) use ($request) {
            $mail->to('support@medrendezvous.com') // Remplacez par votre email
                 ->subject('Nouveau message de contact')
                 ->replyTo($request->email);
        });

        return redirect()->route('contact.show')->with('success', 'Votre message a été envoyé avec succès.');
    }
}

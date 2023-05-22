<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
use App\Models\Commande;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'Ed Shop',
            'body' => 'Votre commande  est passée avec success !'
        ];

        Mail::to("jihadlaziba24@gmail.com")->send(new DemoMail($mailData));
        return redirect()->route('admin.commandes.historique')->with('success', 'Votre commande  est passée avec success !');
    }
}


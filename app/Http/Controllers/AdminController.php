<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Administrateur;
use App\Models\Livraison;
use App\Models\Paiement;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CreationLivreur;
use App\Events\NotificationLivreur;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    // connexion
    function login(Request $request) {

        $donnees = $request->only('email', 'password');

        if (Auth::attempt($donnees)) {
                // L'authentification a réussi
                $livreurs = User::where('is_approved', true)->get();
                return view('index', compact('livreurs'));
            } else {
                // L'authentification a échoué
                return back()->withErrors(['email' => 'Email ou mot de passe incorrect'])->withInput();
            }

    }


public function dashboard()
{
    \Carbon\Carbon::setLocale('fr');

    // Retrieve the list of approved drivers from the database
    $livreurs = User::where('is_approved', true)->get();
    $clients = Client::all();
    $admins = Administrateur::get();
    $notifications = Notification::get();
    $livraisons = Livraison::get();
    $paiements = Paiement::get();

    // Pass the drivers data to the dashboard view
    return view('index', compact('livreurs', 'notifications', 'clients', 'admins', 'livraisons', 'paiements'));
}


    public function supprimeLivreur($id)
    {
        $livreur = User::findOrFail($id);
        $livreur->delete();

        return redirect()->back()->with( 'Le livreur a été supprimé avec succès.');
    }

    public function index2()
    {
        \Carbon\Carbon::setLocale('fr');
        $livreurs = User::where('is_approved', true)->get();
        $clients = Client::all();
        $admins = Administrateur::get();
        $notifications = Notification::get();
        $livraisons = Livraison::get();
        $paiements = Paiement::get();

        return view('index', compact('livreurs', 'notifications', 'clients', 'admins', 'livraisons', 'paiements'));
    }

    public function supprimerclient($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->back()->with( 'Le client a été supprimé avec succès.');
    }
}





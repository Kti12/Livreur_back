<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livreur;
use App\Models\Client;

class AdminController extends Controller
{
    

public function dashboard()
{
    // Retrieve the list of approved drivers from the database
    $livreurs = Livreur::where('is_approved', true)->get();
    

    // Pass the drivers data to the dashboard view
    return view('index', compact('livreurs'));

    

}
public function supprimeLivreur($id)
    {
        $livreur = Livreur::findOrFail($id);
        $livreur->delete();

        return redirect()->back()->with( 'Le livreur a été supprimé avec succès.');
    }

    public function index2()
    {
        $clients = Client::all();
        
        return view('index', ['clients' => $clients]);
    }

    public function supprimerclient($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->back()->with( 'Le client a été supprimé avec succès.');
    } 
}





<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\CommandeProduit;
use App\Models\Produit;

// CommandeController.php
class CommandeController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'AdresseClient' => 'required',
            'HeureLivraison' => 'required',
            'ModePaiement' => 'required',
            'client_id' => 'required',
            'produits' => 'required',
            'reference'=> 'required'
        ]);

        $commande = new Commande;
        $commande->MontantCommande = 1200;
        $commande->reference = $request->reference;
        $commande->ModePaiement = $request->ModePaiement;
        $commande->num_commande = 'COM-'.time();
        $commande->StatutCommande = 0;
        $commande->DateCommande = date('Y-m-d H:i:s');
        $commande->fournisseur_id = 1;
        $commande->client_id = $request->client_id;
        $commande->save();

        foreach ($request->produits as $data) {
            $commande_produit = new CommandeProduit;
            $produit = Produit::find($data);
            $commande_produit->commande_id = $commande->id;
            $commande_produit->recuperer = 0;
            $commande_produit->produit_id = $data;
            $commande->MontantCommande += $produit->prixProduit;
            $commande_produit->save();
        }
        
        $commande->save();

        return response()->json(['message' => 'Commande enregistrée avec succès']);
    }

    public function index()
    {
        $commandes = Commande::with('produits', 'livraison', 'client')->get();

        return response()->json(['commandes' => $commandes]);
    }
}



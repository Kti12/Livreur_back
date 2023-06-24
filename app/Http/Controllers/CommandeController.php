<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

class CommandeController extends Controller
{
    public function store(Request $request)
    {
        // Valider les données de la requête
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'produit_id' => 'required|exists:produits,id',
            // Ajoutez d'autres validations pour les champs de la commande
        ]);

        // Créer une nouvelle commande
        $commande = Commande::create($validatedData);

        // Répondre avec la commande créée
        return response()->json($commande, 201);
    }
}


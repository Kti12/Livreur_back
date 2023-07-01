<?php
namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;

class LivreurController extends Controller{

    public function registerDriver(Request $request)
{


    // Validation des données de la requête
    $validatedData = $request->validate([
        'NomLivreur' => 'required|string|max:100',
        'PrénomLivreur' => 'required|string|max:100',
        'NuméroLivreur' => 'required|string|max:10',
        'DateNaissanceLivreur' => 'required',
        'MDPLivreur' => 'required|min:6',
        'ConfirmerMDP' => 'required|same:MDPLivreur',
        'MTNMoneyLivreur' => 'required',
        'TypeEnginLivreur' => 'required',
        'PlaqueImmatriculation' => 'required',
        
    ]);
    $livreur = new Livreur();

    // Assignation des valeurs des champs du livreur à partir des données de la requête
    $livreur->NomLivreur = $request->input('NomLivreur');
    $livreur->PrénomLivreur = $request->input('PrénomLivreur');
    $livreur->NuméroLivreur = $request->input('NuméroLivreur');
    $livreur->DateNaissanceLivreur = $request->input('DateNaissanceLivreur');
    $livreur->MDPLivreur = bcrypt($request->input('MDPLivreur'));
    $livreur->ConfirmerMDP = bcrypt($request->input('ConfirmerMDP'));
    $livreur->MTNMoneyLivreur = $request->input('MTNMoneyLivreur');
    $livreur->TypeEnginLivreur = $request->input('TypeEnginLivreur');
    $livreur->PlaqueImmatriculation = $request->input('PlaqueImmatriculation');
    $livreur->PhotoLivreur = $request->input('PhotoLivreur');
    $livreur->CNILivreur = $request->input('CNILivreur ');
    $livreur->CasierJudiciaireLivreur = $request->input('CasierJudiciaireLivreur');
    $livreur->PermisLivreur = $request->input('PermisLivreur');
    $livreur->is_approved = false;

    $livreur->save();
    return response()->json(['message' => 'Vos informations ont bien été enregistrées']);

    // Envoi d'une notification à l'administrateur
    // Utilisez votre méthode préférée pour envoyer une notification à l'administrateur

    // Retourner une réponse JSON avec un message de succès
    // Send a notification to the admin
   
    $adminEmail = 'katienesoro12@gmail.com';
    $subject = 'Nouvelle demande d\'inscription-livreur';
    $message = 'Une personne désire être livreur AISA, veuillez vous connectez à votre espace pour le contacter.';
    mail($adminEmail, $subject, $message);

    
}
public function afficherLivreurs()
    {
        $livreur = Livreur::all();

        return view('livreur', compact('livreurs'));
    }

    public function supprimerLivreur($id)
    {
        $livreur = Livreur::findOrFail($id);
        $livreur->delete();

        return redirect()->back()->with( 'Le livreur a été supprimé avec succès.');
    }

    public function approveDriverRegistration($id)
    {
        // Find the driver by ID
        $livreur =Livreur::findOrFail($id);
    
        // Update the is_approved field to true
        $livreur->is_approved = true;
    
        // Save the changes to the database
        $livreur->save();
    
        // Redirect back to the admin dashboard with a success message
        return redirect()->route('livreurs.index')->with('success', 'Driver registration approved');
    }
    
}



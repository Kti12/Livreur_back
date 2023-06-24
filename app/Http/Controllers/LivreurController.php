<?php
namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;

class LivreurController extends Controller{

    public function registerDriver(Request $request)
{
    // Validation des données de la requête
    $this->validate($request, [
        'NomLivreur' => 'required|string|max:100',
        'PrénomLivreur' => 'required|string|max:100',
        'NuméroLivreur' => 'required|string|max:10',
        'DateNaissanceLivreur' => 'required|date',
        'MDPLivreur' => 'required|min:6',
        'ConfirmerMDP' => 'required|same:password',
        'MTNMoneyLivreur' => 'required',
        'TypeEnginLivreur' => 'required',
        'PlaqueImmatriculation' => 'required',
        'PhotoLivreur' => 'required',
        'CNILivreur' => 'required',
        'CasierJudiciareLivreur' => 'required',
        'PermisLivreur' => 'required',
        'is_approved' => 'required'

        // Ajoutez les autres règles de validation ici
    ]);

    $photoPath = $request->file('PhotoLivreur')->store('Livreur');
    $cniPath = $request->file('CNILivreur')->store('cni');
    $casierJudiciairePath = $request->file('casier_judiciaire')->store('casier');
    $permisPath = $request->file('PermisLivreur')->store('permis');

    // Création d'une nouvelle instance de Livreur
    $livreur = new Livreur();

    // Assignation des valeurs des champs du livreur à partir des données de la requête
    $livreur->NomLivreur = $request->input('nom');
    $livreur->PrénomLivreur = $request->input('prenom');
    $livreur->NuméroLivreur = $request->input('numero');
    $livreur->DateNaissanceLivreur = $request->input('date');
    $livreur->MDPLivreur = bcrypt($request->input('mdp'));
    $livreur->ConfirmerMDP = bcrypt($request->input('mdp'));
    $livreur->MTNMoneyLivreur = $request->input('momo');
    $livreur->TypeEnginLivreur = $request->input('type');
    $livreur->PlaqueImmatriculation = $request->input('matricule');
    $livreur->PhotoLivreur = $request->input('photo');
    $livreur->CNILivreur = $request->input('cni');
    $livreur->CasierJudiciaireLivreur = $request->input('casier');
    $livreur->PermisLivreur = $request->input('permis');
    $livreur->is_approved = false;
    // Assignation des autres champs du livreur

    // Sauvegarde du livreur dans la base de données
    $livreur->save();

    // Envoi d'une notification à l'administrateur
    // Utilisez votre méthode préférée pour envoyer une notification à l'administrateur

    // Retourner une réponse JSON avec un message de succès
    // Send a notification to the admin
    // Replace `admin@example.com` with the actual admin email address
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



<?php
namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Notifications\CreationLivreur;
use App\Models\Client;
use App\Models\Administrateur;
use App\Models\Livraison;
use App\Models\Paiement;
use App\Events\NotificationLivreur;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class LivreurController extends Controller{

    public function registerDriver(Request $request)
{
    try{
        $input = $request->all();
        $validator = Validator::make($input,[

            'NomLivreur' => 'required',
            'PrenomLivreur' => 'required',
            'NumeroLivreur' => 'required',
            'DateNaissanceLivreur' => 'required',
            'MDPLivreur' => 'required',
            'ConfirmerMDP' => 'required',
            'MTNMoneyLivreur' => 'required',


        ]);

        $validator->sometimes('PhotoLivreur', 'image', function ($input) {
            return $input->file('PhotoLivreur');
        });

        $validator->sometimes('CNILivreur', 'image', function ($input) {
            return $input->file('CNILivreur');
        });
        $validator->sometimes('CasierJudiciaireLivreur', 'image', function ($input) {
            return $input->file('CasierJudiciaireLivreur');
        });
        $validator->sometimes('PermisLivreur', 'image', function ($input) {
            return $input->file('PermisLivreur');
        });

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => 'Erreur de validation',
                "errors" => $validator->errors(),
            ], 422,);
        }
        if ($request->file('PhotoLivreur')) {
            $input['PhotoLivreur'] = $request->file('PhotoLivreur')->store('users');
        }

        // Répéter pour les autres images (CNI, CasierJudiciaire, Permis)
        if ($request->file('CNILivreur')) {
            $input['CNILivreur'] = $request->file('CNILivreur')->store('users');
        }
        if ($request->file('CasierJudiciaireLivreur')) {
            $input['CasierJudiciaireLivreur'] = $request->file('CasierJudiciaireLivreur')->store('users');
        }
        if ($request->file('PermisLivreur')) {
            $input['PermisLivreur'] = $request->file('PermisLivreur')->store('users');
        }

        $input['MDPLivreur']=Hash::make($request->MDPLivreur);
        $input['ConfirmerMDP']=Hash::make($request->ConfirmerMDP);
        $livreur = User::create($input);

        // recupération de l'administrateur
        $administrateur = Administrateur::first();

        // envoie de notification en passant le nom du livreur dans la fonction
        // Notification::send($administrateur, new CreationLivreur($request->NomLivreur));
        Notification::create([
            'type' => 'admin',
            'notifiable_id' => $administrateur ? $administrateur->id : 1,
            'notifiable_type' => 1,
            'data' => 'Un nouveau livreur '.$request->NomLivreur.' vient de créer un compte. Veuillez vérifier votre espace livreur',
        ]);

        $mailData = [
            'nom' => $request->NomLivreur,
        ];

        // envoyer le mail
        Mail::to($administrateur->EmailAdmin)->send(new \App\Mail\TestEmail($mailData));

        return response()->json([
            "status" => true,
            "message" => "Vos informations ont bien ete envoye",
            "data" => [
                "token"=>$livreur->createToken('auth_user')->plainTextToken,
                "token_type"=>"Bearer"
            ],
        ]);
    } catch(\Throwable $th){
        return response()->json([
            "status"=>false,
            "message"=>$th->getMessage()
        ], 500,);
    }
/*
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
    $livreur->NomLivreur = $request->post('NomLivreur');
    $livreur->PrénomLivreur = $request->post('PrénomLivreur');
    $livreur->NuméroLivreur = $request->post('NuméroLivreur');
    $livreur->DateNaissanceLivreur = $request->post('DateNaissanceLivreur');
    $livreur->MDPLivreur = bcrypt($request->post('MDPLivreur'));
    $livreur->ConfirmerMDP = bcrypt($request->post('ConfirmerMDP'));
    $livreur->MTNMoneyLivreur = $request->post('MTNMoneyLivreur');
    $livreur->TypeEnginLivreur = $request->post('TypeEnginLivreur');
    $livreur->PlaqueImmatriculation = $request->post('PlaqueImmatriculation');
    $livreur->PhotoLivreur = $request->post('PhotoLivreur');
    $livreur->CNILivreur = $request->post('CNILivreur ');
    $livreur->CasierJudiciaireLivreur = $request->post('CasierJudiciaireLivreur');
    $livreur->PermisLivreur = $request->post('PermisLivreur');
    $livreur->is_approved = false;

   if ($livreur->save()){
    return response()->json(['succès' => true]);
   }else{
    return response()->json(['succès' => false]);
   };


    // Envoi d'une notification à l'administrateur
    // Utilisez votre méthode préférée pour envoyer une notification à l'administrateur

    // Retourner une réponse JSON avec un message de succès
    // Send a notification to the admin

    $adminEmail = 'katienesoro12@gmail.com';
    $subject = 'Nouvelle demande d\'inscription-livreur';
    $message = 'Une personne désire être livreur AISA, veuillez vous connectez à votre espace pour le contacter.';
    mail($adminEmail, $subject, $message);
 */

}
public function loginDriver(Request $request){
    try{
        $input = $request->all();
        $validator = Validator::make($input,[

        'NumeroLivreur' => 'required|string|max:10',

        'MDPLivreur' => 'required|min:6',

        ]);
        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => 'Erreur de validation',
                "errors" => $validator->errors(),
            ], 422,);
        }
        if(Auth::attempt($request->only(['NumeroLivreur', 'MDPLivreur']))){
            return response()->json([
                "status" => false,
                "message" => "Numéro ou mot de passe incorrect",
                "errors" => $validator->errors()
            ], 401,);
        }
        $livreur = User::where('NumeroLivreur', $request->NuméroLivreur)->first();
        return response()->json([
            "status" => true,
            "message" => "Bienvenue",
            "data" => [
                "token"=>$livreur->createToken('auth_livreur')->plainTextToken,
                "token_type"=>"Bearer"
            ],
        ]);
    } catch(\Throwable $th){
        return response()->json([
            "status"=>false,
            "message"=>$th->getMessage()
        ], 500,);
    }
}
    public function afficherLivreurs()
    {
        $livreurs = User::all();
        \Carbon\Carbon::setLocale('fr');
        $livreurs = User::where('is_approved', true)->get();
        $clients = Client::all();
        $admins = Administrateur::get();
        $notifications = Notification::get();
        $livraisons = Livraison::get();
        $paiements = Paiement::get();

        return view('livreur', compact('livreurs', 'notifications', 'clients', 'admins', 'livraisons', 'paiements'));
    }

    function livraisons() {
        $livreurs = User::all();
        \Carbon\Carbon::setLocale('fr');
        $livreurs = User::where('is_approved', true)->get();
        $clients = Client::all();
        $admins = Administrateur::get();
        $notifications = Notification::get();
        $livraisons = Livraison::get();
        $paiements = Paiement::get();

        return view('livraison', compact('livreurs', 'notifications', 'clients', 'admins', 'livraisons', 'paiements'));
    }

    public function supprimerLivreur($id)
    {
        $livreur = User::findOrFail($id);
        $livreur->delete();

        return redirect()->back()->with( 'Le livreur a été supprimé avec succès.');
    }

    public function approveDriverRegistration($id)
    {
        // Find the driver by ID
        $livreur =User::findOrFail($id);

        // Update the is_approved field to true
        $livreur->is_approved = true;

        // Save the changes to the database
        $livreur->save();



        // Redirect back to the admin dashboard with a success message
        return redirect()->route('livreurs.index')->with('success', 'Driver registration approved');
    }

    public function set_postionLivreur(Request $request)
    {
        $user = User::find($request->user_id);
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->save();
        return response()->json(['message' => 'Préparer à recevoir des commandes'], 200);
    }
    public function plus_proche(){
        $fournisseur_latitude = 5.2518156
        ; // Coordonnées du fournisseur (à remplacer par les coordonnées du fournisseur)
        $fournisseur_longitude = -3.8786808;

        $livreurs = User::whereNotNull('latitude')->whereNotNull('longitude')->get();

        $livreur_plus_proche = null;
        $distance_minimale = PHP_FLOAT_MAX;

        foreach ($livreurs as $livreur) {
            $distance = $this->distanceHaversine($fournisseur_latitude, $fournisseur_longitude, $livreur->latitude, $livreur->longitude);
            if ($distance < $distance_minimale) {
                $distance_minimale = $distance;
                $livreur_plus_proche = $livreur;
            }
        }

        return response()->json([
            'livreur_plus_proche' => $livreur_plus_proche,
            'distance_minimale' => $distance_minimale,
        ]);
    }

    // Fonction pour calculer la distance haversine entre deux points géographiques
function haversineDistance($latitude1, $longitude1, $latitude2, $longitude2)
{
    $earthRadius = 6371; // Rayon de la Terre en kilomètres

    $deltaLat = deg2rad($latitude2 - $latitude1);
    $deltaLon = deg2rad($longitude2 - $longitude1);

    $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
        cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
        sin($deltaLon / 2) * sin($deltaLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earthRadius * $c;

    return $distance;
}

    }





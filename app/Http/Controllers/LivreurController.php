<?php
namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class LivreurController extends Controller{

    public function registerDriver(Request $request)
{
    try{
        /* $input = $request->all();
        $validator = Validator::make($input,[
            
            'NomLivreur' => 'required',
            'PrenomLivreur' => 'required',
            'NumeroLivreur' => 'required',
            'DateNaissanceLivreur' => 'required',
            'MDPLivreur' => 'required',
            'ConfirmerMDP' => 'required',
            'MTNMoneyLivreur' => 'required',
            'TypeEnginLivreur' => 'required',
            'PlaqueImmatriculation' => 'required',
        
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
        } */

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
        $livreur = User::all();

        return view('livreur', compact('livreurs'));
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
    
}



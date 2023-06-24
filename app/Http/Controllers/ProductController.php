<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        
        return view('index');
    }
    
    
    public function index1()
    {
        $produits = Produit::all();
        return response()->json($produits);
    }
    

    public function create()
    {
        return view('produit.create');
    }
    public function principal()
{
    $produits = Produit::all();
    return view('produit.principal', compact('produits'));
}

public function store(Request $request)
    {
        $validatedData = $request->validate([
            'imageProduit' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nom' => 'required',
            'description' => 'required',
            'prix' => 'required|integer',
            
        ]);

        $produit = new Produit;

        if ($request->hasFile('imageProduit')) {
            $image = $request->file('imageProduit');
            $imagePath = 'Images/produit/' . time() . '.' . $image->getClientOriginalExtension();
        
            $image->move(public_path('Images/produit'), $imagePath);
        
            $produit->imageProduit = $imagePath;
        }
        else {
            $produit->imageProduit = ''; // Valeur par défaut si aucune image n'est spécifiée
        }
        
        // Assignation des autres valeurs
        $produit->nomProduit = $request->input('nom');
        $produit->descriptionProduit = $request->input('description');
        $produit->prixProduit = $request->input('prix');
        
        $produit->save();


        if ($produit->exists) {
            return redirect()->route('produit.store')
                ->with('success', 'Produit créé avec succès.');
        } else {
            dd($produit->getErrors());
        }
    }

    public function edit($id)
    {
        $produits = Produit::find($id);
        return view('produit.edit', compact('produits'));
    }

    public function update(Request $request)
{
    $validatedData = $request->validate([
        'imageProduit' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'nom' => 'required',
        'description' => 'required',
        'prix' => 'required|integer',
    ]);

    $produit = Produit::find($request->id);

    if ($request->hasFile('imageProduit')) {
        $image = $request->file('imageProduit');
        $imagePath = 'Images/produit/' . time() . '.' . $image->getClientOriginalExtension();
    
        $image->move(public_path('Images/produit'), $imagePath);
    
        $produit->imageProduit = $imagePath;
    }

    $produit->nomProduit = $request->nom;
    $produit->descriptionProduit = $request->description;
    $produit->prixProduit = $request->prix;
    $produit->update();

    return redirect()->route('produit.store')
        ->with('succès', 'Produit modifié avec succès.');
}


public function destroy($id)
{
    
    $produit->delete();

    return redirect()->route('produit.store')->with('succès', 'Un produit a été supprimé.');
}

}



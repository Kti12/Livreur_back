<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        "imageProduit",
        "nomProduit",
        "descriptionProduit",
        "prixProduit"
    ];
    public function commande()
    {
        return $this->belongsToMany(Commande::class, 'Commande_Produit');
    }
}

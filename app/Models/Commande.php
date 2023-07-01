<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [

        'MontantCommande',
        'DateCommande',
'StatutCommande'


    ];


    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
    public function livraison()
    {
        return $this->hasMany(Livraison::class);
    }
    public function produit()
{
    return $this->belongsToMany(Produit::class, 'Commande_Produit');
}
public function client()
{
    return $this->belongsTo(Client::class);
}
}

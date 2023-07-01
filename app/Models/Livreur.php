<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;

     public function livraison()
    {
        return $this->hasMany(Livraison::class);
    } 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NomLivreur',
        'PrénomLivreur',
        'NuméroLivreur',
        'DateNaissanceLivreur',
        'MDPLivreur',
        'ConfirmerMDP',
        'MTNMoneyLivreur',
        'TypeEnginLivreur',
        'PlaqueImmatriculation',
         'PhotoLivreur',
        'CNILivreur',
        'CasierjudiciaireLivreur',
        'PermisLivreur' ,
        'is_approved'
        
    ];
    

    
}
   
   


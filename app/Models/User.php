<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    
    public function livraison()
    {
        return $this->hasMany(Livraison::class);
    } 

    
    protected $fillable = [
        'NomLivreur',
        'PrenomLivreur',
        'NumeroLivreur',
        'DateNaissanceLivreur',
        'MDPLivreur',
        'ConfirmerMDP',
        'MTNMoneyLivreur',
        'TypeEnginLivreur',
        'PlaqueImmatriculation',
   /*      'PhotoLivreur',
        'CNILivreur',
        'CasierJudiciaireLivreur',
        'PermisLivreur' , */
        'is_approved'
        
    ];

    
}
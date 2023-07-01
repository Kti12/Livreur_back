<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'NomClient',
'EmailClient',
'NuméroClient',
'MDPClient',
'AdresseClient',
'ModePaiementClient'
        
    ];
    public function livraison()
    {
        return $this->hasMany(Livraison::class);
    }
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }
    public function commande()
{
    return $this->hasMany(Commande::class);
}
}

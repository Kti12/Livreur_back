<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
    protected $fillable = [
        'DateLivraison',
'HeureLivraison',
'MontantLivraison',
'livreur_id',
'commande_id',
'client_id'
    ];
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

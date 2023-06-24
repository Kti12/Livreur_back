<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
    public function reçu()
    {
        return $this->belongsTo(Reçu::class);
    }
}

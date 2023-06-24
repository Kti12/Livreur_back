<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reçu extends Model
{
    use HasFactory;
    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}

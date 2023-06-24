<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public function livraison()
    {
        return $this->hasMany(Livraison::class);
    }
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }
}

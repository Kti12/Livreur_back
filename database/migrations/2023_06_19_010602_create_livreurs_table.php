<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('livreurs', function (Blueprint $table) {
            $table->id();
            $table->string('NomLivreur');
            $table->string('PrénomLivreur');
            
            
            $table->string('NuméroLivreur');
            $table->date('DateNaissanceLivreur');
            $table->string('MDPLivreur');
            $table->string('ConfirmerMDP');
            $table->string('MTNMoneyLivreur');
            $table->string('TypeEnginLivreur');
            
            
            $table->string('PlaqueImmatriculation');
            $table->string('PhotoLivreur');
            $table->string('CNILivreur');
            $table->string('CasierjudiciaireLivreur');
            $table->string('PermisLivreur');
            $table->boolean('is_approved')->default(false);
            
            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livreurs');
    }
};

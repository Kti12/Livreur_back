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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('NomLivreur');
            $table->string('PrenomLivreur');
            $table->string('NumeroLivreur');
            $table->date('DateNaissanceLivreur');
            $table->string('MDPLivreur');
            $table->string('ConfirmerMDP');
            $table->string('MTNMoneyLivreur');
            
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
        Schema::dropIfExists('users');
    }
};

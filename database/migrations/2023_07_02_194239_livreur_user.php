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
    Schema::create('livreur_users', function (Blueprint $table) {
        $table->id();
        $table->string('NumeroLivreur')->unique();
        $table->string('MDPLivreur');
        $table->rememberToken();
        $table->timestamps();
    });
}



    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livreur_users');
    }
};

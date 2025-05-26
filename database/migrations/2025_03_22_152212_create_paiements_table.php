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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant', 10, 2); 
            $table->decimal('remise', 10, 2)->nullable(); 
            $table->decimal('prime', 10, 2)->nullable(); 
            $table->string('methode_paiement'); 
            $table->string('statut')->default('en attente'); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('cour_id')->constrained('cours')->onDelete('cascade');
            $table->timestamp('date_paiement')->nullable(); 
            $table->string('transaction_id')->nullable(); 
            $table->string('devise', 5)->default('MAD')->nullable();
            $table->json('payment_response')->nullable();   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};

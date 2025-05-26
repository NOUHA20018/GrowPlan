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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('cour_id')->constrained('cours')->onDelete('cascade');
            $table->timestamp('inscrit_le')->useCurrent();
             $table->enum('status', ['en_attente', 'accepte', 'refuse', 'annule', 'termine'])
                ->default('en_attente');
            $table->timestamps();
            $table->unique(['user_id', 'cour_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};

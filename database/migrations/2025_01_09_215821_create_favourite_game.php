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
        Schema::create('favourite_game', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key for the user
            $table->foreignId('game_id')->constrained()->onDelete('cascade'); // Foreign key for the note
            $table->timestamps();

            
            // Unique constraint to prevent a user from favoriting the same note multiple times
            $table->unique(['user_id', 'game_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_game');
    }
};

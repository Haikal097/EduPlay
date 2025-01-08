<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favourite_notes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key for the user
            $table->foreignId('note_id')->constrained()->onDelete('cascade'); // Foreign key for the note
            $table->timestamps(); // Created_at and updated_at
    
            // Unique constraint to prevent a user from favoriting the same note multiple times
            $table->unique(['user_id', 'note_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('favourite_notes');
    }
    
};

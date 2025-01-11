<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the game
            $table->text('desc')->nullable(); // Description of the game
            $table->string('file_path'); // Path to the game file
            $table->string('thumbnail_path')->nullable(); // Path to the thumbnail image, now nullable
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key referencing users table
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};

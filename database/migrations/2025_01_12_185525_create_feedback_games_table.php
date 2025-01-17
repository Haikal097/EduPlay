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
        Schema::create('feedback_games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Reference to the user who left the feedback
            $table->unsignedBigInteger('game_id'); // Reference to the game the feedback is about
            $table->float('rating', 3, 2)->default(0); // For ratings (e.g., 4.25)
            $table->text('comment')->nullable(); // Optional comment field
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback_games');
    }
};

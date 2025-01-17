<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavouriteGame extends Model
{
    // Define the table name (if not following Laravel's plural naming convention)
    protected $table = 'favourite_game';

    // Define fillable attributes to allow mass assignment (adjust as necessary)
    protected $fillable = ['user_id', 'game_id'];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackGame extends Model
{
    use HasFactory;
    // This is enabled by default
    public $timestamps = true;
    protected $fillable = ['user_id', 'game_id', 'rating', 'comment'];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    public function feedback()
    {
        return $this->hasMany(FeedbackGame::class, 'game_id');
    }
}

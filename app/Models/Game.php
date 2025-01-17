<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'desc', 'file_path', 'user_id','views',];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function publisher()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function feedback()
{
    return $this->hasMany(FeedbackGame::class); // Ensure this is the correct model for game feedback
}
public function favouritedByUsers()
{
    return $this->belongsToMany(User::class, 'favourite_game', 'game_id', 'user_id');
}

}

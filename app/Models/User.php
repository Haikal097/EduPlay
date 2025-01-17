<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
public function notes()
{
    return $this->hasMany(Note::class);
}

public function games()
{
    return $this->hasMany(Game::class);
}
public function favoriteNotesUser()
{
    return $this->hasMany(FavouriteNote::class);
}

public function favoriteGamesUser()
{
    return $this->hasMany(FavouriteGame::class);
}
public function favouriteNotes()
{
    return $this->belongsToMany(Note::class, 'favourite_notes', 'user_id', 'note_id');
}
public function favouriteGames()
{
    return $this->belongsToMany(Game::class, 'favourite_game', 'user_id', 'game_id');
}


    
}

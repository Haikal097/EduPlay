<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'file_path',
        'thumbnail_path',
        'views',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favourite_notes', 'note_id', 'user_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function favouritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favourite_notes', 'note_id', 'user_id')->withTimestamps();
    }
    
    public function feedback()
{
    return $this->hasMany(FeedbackNote::class);
}
// In Note model
public function getAverageRatingAttribute()
{
    return $this->feedback()->avg('rating') ?? 0;
}


}
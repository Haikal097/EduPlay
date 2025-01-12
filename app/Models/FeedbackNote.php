<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackNote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'note_id', 'rating', 'comment'];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function getAverageRatingAttribute()
{
    return $this->feedback()->avg('rating') ?? 0;
}
}

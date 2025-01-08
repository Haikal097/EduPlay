<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavouriteNote extends Model
{
    // Define the table name (if not following Laravel's plural naming convention)
    protected $table = 'favourite_notes';

    // Define fillable attributes to allow mass assignment (adjust as necessary)
    protected $fillable = ['user_id', 'note_id'];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}

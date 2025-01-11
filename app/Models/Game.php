<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'desc', 'file_path', 'user_id','views',];

    public function publisher()
{
    return $this->belongsTo(User::class, 'user_id');
}
}

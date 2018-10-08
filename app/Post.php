<?php

namespace App;

use App\User;
use App\Like;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function like()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}

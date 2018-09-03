<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function user()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }
}

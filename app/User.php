<?php

namespace App;

use App\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function sendFriendRequest()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    public function recievedFriendRequest()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    public function recievedFriendRequestPending()
    {
        return $this->recievedFriendRequest()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->sendFriendRequest()->wherePivot('accepted', false);
    }
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function isFriendsWith(User $user)
    {
        return  $this->friendsList()->where('id', $user->id)->count();
    }

    public function friendsList()
    {
        return $this->recievedFriendRequest()->wherePivot('accepted', true)->get()->merge($this->sendFriendRequest()->wherePivot('accepted', true)->get());
    }

    public function acceptFriendRequest(User $user)
    {
        return $this->recievedFriendRequest()->where('user_id', $user->id)->first()->pivot->update(['accepted' => true]);
    }
    // public function friendsOf()
    // {
    //     return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    // }

    // public function friends()
    // {
    //     if ($friends = $this->friendsOfMine()->wherePivot('accepted', true)) {
    //         $friends = $friends->get();
    //     }

    //     if ($friendRequestPending = $this->friendsOfMine()->wherePivot('accepted', false)) {
    //         $friendRequestPending = $friendRequestPending->get();
    //     }

    //     if (count($friendRequestPending) && count($friends)) {
    //         return [$friends, $friendRequestPending];
    //     } elseif (count($friends)) {
    //         return $friends;
    //     } elseif (count($friendRequestPending)) {
    //         return $friendRequestPending;
    //     }
    //     // return $this->friendsOfMine()->wherePivot('accepted', true);
    // }
}

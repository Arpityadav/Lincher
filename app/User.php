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

    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash";
    }

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

    public function recievedFriendRequestsPending()
    {
        return $this->recievedFriendRequest()->wherePivot('accepted', false);
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
}

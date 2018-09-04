<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function show(User $user)
    {
        return view('friends.show', compact('user'));
    }

    public function sendFriendRequest(User $user)
    {
        auth()->user()->sendFriendRequest()->attach($user);

        return back();
    }

    public function cancelFriendRequest(User $user)
    {
        auth()->user()->sendFriendRequest()->detach($user);

        return back();
    }

    public function deleteFriend(User $user)
    {
        auth()->user()->sendFriendRequest()->detach($user->id);
        return back();
    }
}

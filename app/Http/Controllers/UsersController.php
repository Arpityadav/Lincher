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
        auth()->user()->recievedFriendRequest()->detach($user->id);

        return back();
    }

    public function friendsIndex()
    {
        $friends = auth()->user()->friendsList();
        // dd(auth()->user()->recievedFriendRequestPending());
        $recievedFriendRequestsPending = auth()->user()->recievedFriendRequestPending();

        return view('friends.index', compact('friends', 'recievedFriendRequestsPending'));
    }

    public function acceptFriendRequest(User $user)
    {
        auth()->user()->acceptFriendRequest($user);

        return back();
    }
}

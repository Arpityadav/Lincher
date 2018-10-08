<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function store(Post $post)
    {
        $post->like()->create(['user_id' => auth()->user()->id]);

        return back();
    }

    public function unlike(Post $post)
    {
        $post->like()->where('likeable_id', $post->id)->where('user_id', auth()->user()->id)->delete();

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function create(Post $post)
    {
        $this->validate(request(), [
            'body' => 'required|min:2|max:512'
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'body' => request('body')
        ]);

        return back();
    }
}

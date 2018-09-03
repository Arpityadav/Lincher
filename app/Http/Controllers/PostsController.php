<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        if (request('viewBy') == 'latest') {
            $posts = Post::latest()->get();
        }

        return view('posts.index', compact('posts'));
    }
}

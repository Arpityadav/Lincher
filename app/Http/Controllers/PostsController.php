<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts = Post::where(function ($query) {
            return $query->where('user_id', auth()->user()->id)
                ->orWhereIn('user_id', auth()->user()->friendsList()->pluck('id'));
        })->with(['user', 'like' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->latest()->get();

        if (request('viewBy') == 'latest') {
            $posts = Post::latest()->get();
        }

        return view('posts.index', compact('posts'));
    }

    public function store()
    {
        $this->validate(request(), [
            'body' => 'required|max:20000|min:2',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if (request('post_image')) {
            $image = request()->file('post_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/posts/images');
            $image->move($destinationPath, $imageName);

            Post::create([
                'body' => request('body'),
                'user_id' => auth()->user()->id,
                'image_url' => $imageName,
            ]);
        }

        Post::create([
            'body' => request('body'),
            'user_id' => auth()->user()->id,
        ]);



        return back();
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}

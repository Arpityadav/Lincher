@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is- is-marginless is-centered">
            <div class="column is-7">
                <div class="box">
                    <form action="/post" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="field">
                            <div class="control">
                                <textarea class="textarea" type="text" placeholder="What's on your mind..." name="body"></textarea>
                                <div class="file">
                                    <label class="file-label">

                                    <input class="file-input" type="file" name="post_image">
                                        <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                                Choose a file…
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <button class="button is-link">Post</button>
                            </div>
                        </div>
                    </form>
                </div>
                    @include('layouts.errors')

                    @if(count($posts))
                        @foreach($posts as $post)
                                <div class="box">
                                    <article class="media">
                                        <div class="media-left">
                                            <figure class="image is-64x64">
                                                <img src="{{ $post->user->gravatar }}" alt="Image">
                                            </figure>
                                        </div>

                                        <div class="media-content">
                                            <div class="content">
                                                <p>
                                                    <a href="/{{$post->user->username}}"><strong>{{$post->user->name}}</strong> <small>{{'@'.$post->user->username}}</small></a> <small>{{ $post->created_at->diffForHumans() }}</small>
                                                    <br>
                                                    {{$post->body}}
                                                </p>
                                                @if($post->image_url)
                                                    <a href="/post/{{ $post->id }}">
                                                        <img src="/posts/images/{{ $post->image_url }}">
                                                    </a>
                                                @endif
                                            </div>
                                            <nav class="level is-mobile">
                                                <div class="level-left">
                                                    <a class="level-item" aria-label="reply">
                                                        <span class="icon is-small">
                                                        <i class="fas fa-reply" aria-hidden="true"></i>
                                                        </span>
                                                    </a>
                                                    @if(count($post->like) > 0)
                                                        @foreach($post->like as $like)
                                                            @if($like->user_id === auth()->user()->id && $like->likeable_id === $post->id)
                                                                <form action="/{{ $post->id }}/unlike" method="POST">
                                                                @csrf
                                                                <button class="button is-danger" type="submit">Unlike</button>
                                                                </form>
                                                                <?php break;?>
                                                            @endif
                                                            @if($like->user_id !== auth()->user()->id)
                                                                <form action="/{{ $post->id }}/like" method="POST">
                                                                    @csrf
                                                                    <button class="button is-link" type="submit">Like</button>
                                                                </form>

                                                                <?php break;?>
                                                            @endif
                                                        @endforeach
                                                        <p>{{ $post->like->count() }} {{str_plural('Like', $post->like->count())}}</p>
                                                    @else
                                                        <form action="/{{ $post->id }}/like" method="POST">
                                                            @csrf
                                                            <button class="button is-link" type="submit">Like</button>
                                                        </form>

                                                        <p>No Likes</p>
                                                    @endif
                                                </div>
                                            </nav>
                                        </div>
                                    </article>
                                </div>
                        @endForeach
                    @else
                        <p>Whoo... such emptiness, Make some <a href="/friends">friends</a></p>
                    @endif
            </div>
        </div>
    </div>
@endsection

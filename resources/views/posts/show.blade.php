@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is- is-marginless is-centered">
            <div class="column is-8 is-centered">
                <div class="box">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-64x64">
                                <img src="{{ $post->user->getGravatarAttribute() }}" alt="Image">
                            </figure>
                        </div>

                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong>{{$post->user->name}}</strong> <small>{{'@'.$post->user->username}}</small> <small>{{ $post->created_at->diffForHumans() }}</small>
                                    <br>
                                    {{$post->body}}
                                </p>
                                @if($post->image_url)
                                    <img src="/posts/images/{{ $post->image_url }}">
                                @endif
                            </div>
                            <nav class="level is-mobile">
                                <div class="level-left">
                                    <a class="level-item" aria-label="reply">
                                        <span class="icon is-small">
                                        <i class="fas fa-reply" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <a class="level-item" aria-label="retweet">
                                        <span class="icon is-small">
                                            <i class="fas fa-retweet" aria-hidden="true"></i>
                                        </span>
                                    </a>

                                    <a class="level-item" aria-label="like">
                                        <span class="icon is-small">
                                            <i class="fas fa-heart" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </article>
                </div>

                <form action="/post/{{$post->id}}/comment" method="POST">
                    @csrf
                    <div class="field is-grouped">
                        <div class="control is-expanded">
                            <input class="input" type="text" name="body" placeholder="Leave a comment..">
                        </div>
                        <div class="control">
                            <button class="button is-info" type="submit">Comment</button>
                        </div>
                    </div>
                </form>
                <br>
                @if(count($post->comment))
                    <div class="box">
                        @foreach($post->comment as $comment)
                            <article class="media">
                                <div class="media-left">
                                    <figure class="image is-64x64">
                                        <img src="{{ $comment->user->getGravatarAttribute() }}" alt="Image">
                                    </figure>
                                </div>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                          <strong>{{$comment->user->name}}</strong> <small>{{'@'.$comment->user->username}}</small> <small>{{ $comment->created_at->diffForHumans() }}</small>
                                        <br>
                                          {{ $comment->body }}
                                        </p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p>No Comments yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

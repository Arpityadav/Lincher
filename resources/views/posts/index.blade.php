@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is- is-marginless is-centered">
            <div class="column is-7">
                @foreach($posts as $post)
                    <div class="box">
                        <article class="media">
                            <div class="media-left">
                                <figure class="image is-64x64">
                                    <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                                  </figure>
                            </div>

                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <!-- <strong>{{$post->user->name}}</strong> <small>@johnsmith</small> <small>{{ $post->created_at->diffForHumans() }}</small> -->
                                        <br>
                                        {{$post->body}}
                                    </p>
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
                @endForeach
            </div>
        </div>
    </div>
@endsection

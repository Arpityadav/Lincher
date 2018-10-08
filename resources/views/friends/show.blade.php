@extends('layouts.app')

@section('content')
        <section class="hero is-medium is-primary is-bold">
            <div class="hero-body">
                <div class="container">
                    <div class="media">
                        <figure class="image is-128x128 is-rounded media-left">
                            <img class="is-rounded" src="{{ $user->gravatar }}" alt="Image">
                        </figure>
                        <div class="media-right">
                            <h1 class="title">
                            Hey! My name is {{$user->name}}
                        </h1>
                        <h2 class="subtitle">
                            Welcome to my timeline.
                        </h2>
                            @auth
                                @if(auth()->user()->id === $user->id)
                                    <p>Update Profile Picture</p>
                                    <form action="/{{$user->username}}/updateDP" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="DP_image" required>
                                        <input type="submit" value="Upload Image" class="button is-rounded is-link">
                                    </form>
                                @elseif(auth()->user()->isFriendsWith($user))
                                    <p>You and {{ $user->name }} are friends.</p>
                                    <form action="/{{$user->username}}/deleteFriend" method="POST">
                                        @csrf
                                        <button class="button is-danger is-rounded" type="submit">Remove Friend</button>
                                    </form>
                                @elseif(auth()->user()->hasFriendRequestPending($user))
                                    <form action="/{{$user->username}}/cancelFriendRequest" method="POST">
                                        @csrf
                                        <button class="button is-danger is-rounded" type="submit">Cancel Friend Request</button>
                                    </form>
                                @elseif(count(auth()->user()->recievedFriendRequestsPending))
                                    @foreach(auth()->user()->recievedFriendRequestsPending as $recievedFriendRequestPending)
                                        @if($user->id === $recievedFriendRequestPending->id)
                                            <form action="{{$recievedFriendRequestPending->username}}/acceptFriendRequest" method="POST">
                                                @csrf
                                                <button type="submit" class="button is-small is-success">Accept Friend Request</button>
                                            </form>
                                        @endif
                                    @endforeach
                                @else
                                    <form action="/{{$user->username}}/sendFriendRequest" method="POST">
                                        @csrf
                                        <button class="button is-success is-rounded" type="submit">Send Friend Request</button>
                                    </form>
                                @endif
                            @endauth
                            @guest
                                <h2 class="subtitle">
                                    <a href="/login">Login</a> to send friend request.
                                </h2>
                            @endguest
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <div class="column is-8 is-offset-2">
            <br>
            <h3 class="subtitle is-3">Recent Activity</h3>
            @if(count($user->posts))
                @foreach($user->posts as $post)
                    <div class="box">
                        <article class="media">
                            <div class="media-left">
                                <figure class="image is-64x64">
                                    <img src="{{ $user->gravatar }}" alt="Image">
                                </figure>
                            </div>

                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>{{$post->user->name}}</strong> <small>@johnsmith</small> <small>{{ $post->created_at->diffForHumans() }}</small>
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
            @else
                <h6 class="subtitle is-6">
                    No posts from {{$user->name}}.
                </h6>
            @endif
        </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column is-6 is-offset-1">
            <h3 class="subtitle is-h3">My Friends</h3>
            @if($friends)
                @foreach($friends as $friend)
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
                                  <a href="/{{$friend->username}}"><strong>{{$friend->name}}</strong> <small>@ {{ $friend->username }}</small></a>
                                </p>
                            </div>
                        </article>
                    </div>
                @endforeach
            @else
                <p>You have no friends.</p>
            @endif
        </div>

        <div class="column is-2 is-offset-1">
            <p>Friend Request</p>
            <div class="box">
                <article class="media">
                    @if(count($recievedFriendRequestsPending))
                        @foreach($recievedFriendRequestsPending as $recievedFriendRequestPending)
                            <div class="media-left">
                                <figure class="image is-64x64">
                                    <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                                </figure>
                            </div>

                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <a href="/{{$recievedFriendRequestPending->username}}"><strong>{{$recievedFriendRequestPending->name}}</strong> <small>@ {{ $recievedFriendRequestPending->username }}</small></a>
                                            <div class="field is-grouped">
                                                <p class="control">
                                                    <form action="{{$recievedFriendRequestPending->username}}/acceptFriendRequest" method="POST">
                                                        @csrf
                                                        <button type="submit" class="button is-small is-success">Accept</button>
                                                    </form>
                                                </p>
                                                <p class="control">
                                                    <form action="{{$recievedFriendRequestPending->username}}/deleteFriendRequest" method="POST">
                                                        @csrf
                                                        <button type="submit" class="button is-small is-danger">Delete</button>
                                                    </form>
                                                </p>
                                            </div>
                                </div>
                            </div>
                        @endforeach
                                    @else
                                        <p>You have no friend request.</p>
                                    @endif
                                </p>
                            </div>
                        </article>
            </div>
        </div>
    </div>
@endsection

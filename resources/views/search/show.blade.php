@extends('layouts.app')

@section('content')
    <br>
    <div class="columns">
        <div class="column is-8 is-offset-1">
            <p>Search Results</p>
                @if(count($users))
                    @foreach($users as $user)
                        <div class="box">
                            <article class="media">
                            <div class="media-left">

                                <figure class="image is-64x64">
                                    <img src="{{ $user->getGravatarAttribute() }}" alt="Image">
                                </figure>
                            </div>
                                <div class="media-content">
                                    <div class="content">
                                    <p>
                                        <a href="/{{ $user->username }}"><strong>{{ $user->name }}</strong> <small>{{ '@'.$user->username }}</small></a>
                                    <br>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                @else
                    <p>No search results for the above query.</p>
                @endif
        </div>
    </div>
@endsection

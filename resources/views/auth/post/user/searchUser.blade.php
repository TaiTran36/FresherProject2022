@extends('layouts.clientSearch')

@section('content-client-search')
<div class="container col-md-6 offset-md-3">
    <form method="GET" action="{{ route('search.user', ['key' => $key]) }}">
        @if (count($users) == 0) 
            <h4 class="pt-4 pl-4">{{ __('No user found') }}</h4>
        @else 
            @foreach ($users as $user)
                <a href="{{ route('user.post.show', ['username' => $user->username_login]) }}"
                    class="post-author d-flex align-items-center mt-3">
                    <div class="author-pic">
                        <img src="{{ asset('images/' . $user->photo_url) }}" class="image rounded-circle avatar mr-2"
                            alt="Image">
                    </div>
                    <div class="text">
                        <strong>{{ $user->username_login }}</strong>
                        <br>
                        <span>{{ $user->numFollowers. ' followers '}} &mdash; {{$user->numPosts. ' posts' }}</span>
                    </div>
                </a>
            @endforeach
        @endif
    </form>

    <div class="d-flex justify-content-center mt-5">
        {{ $users->links() }}
    </div>
</div>

@endsection
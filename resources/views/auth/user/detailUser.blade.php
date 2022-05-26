@extends('layouts.client')

@section('content-client')
<a href="#" class="post-author d-flex align-items-center">
    <div class="author-pic">
        <img src="{{ asset('images/' . $user->photo_url) }}" class="image rounded-circle avatar mr-2" alt="Image">
    </div>

    <div class="text">
        <strong>{{ $user->username_login }}</strong>
    </div>
</a>

@endsection

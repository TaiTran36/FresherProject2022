@extends('layouts.client')

@section('content-client')
<div class="container">
    @include('../../auth/post/readPost', [urlencode(utf8_encode($post->url))])

    @auth
        @include('../../auth/emotion/like', [urlencode(utf8_encode($post->url))])

        @include('../../auth/comment/addComment', [urlencode(utf8_encode($post->url))])
    @else
        <div class="card col-md-8 offset-md-2 mt-3">
            <div class="card-body">
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    {{ __('Login to comment') }}
                </a>
            </div>
        </div>
    @endauth

    @include('../../auth/comment/listComment', $comments)

</div>
@endsection
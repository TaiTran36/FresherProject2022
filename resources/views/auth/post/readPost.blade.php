@extends('layouts.client')

@section('content-client')
<div class="container">
    <form method="GET" action="{{ route('post.read', urlencode(utf8_encode($post->url))) }}">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('images/' . $post->photo_url) }}" class="image rounded-circle avatar mt-5" alt="Image">
        </div>
        <div class="d-flex justify-content-center">
            <strong class="mb-5">{{ $post->author }}</strong>
        </div>

        <div class="d-flex justify-content-center">
            <h2 class="heading col-8 mb-3">
                {{ $post->title }}
            </h2>
        </div>

        <div class="d-flex justify-content-center">
            <img src="{{ asset('images/' . $post->image) }}" alt="Image"
                class="img-fluid rounded image-post col-8 mb-3">
        </div>
        <div class="d-flex justify-content-center">
            <p class="col-8">{{ $post->content }}</p>
        </div>
    </form>

    @auth
        </form method="POST" action="">
            <div class="mt-3 mb-3">
                <label for="comment" class="offset-md-2 col-form-label pl-1">
                    <h5>{{ __('Comment') }}</h5>
                </label>

                <div class="col-md-8 offset-md-2">
                    <textarea id="comment" type="text" class="form-control" rows="8" name="comment"></textarea>
                </div>

                <div class="offset-md-2 mt-3 pl-1">
                    <button type="submit" class="col-md-3 btn bg-primary pt-2 pb-2">
                        {{ __('POST COMMENT') }}
                    </button>
                </div>
            </div>
        </form>
    @else
        <div class="card col-md-8 offset-md-2 mt-3">
            <div class="card-body">
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    {{ __('Login to comment') }}
                </a>
            </div>
        </div>
    @endauth

    <!-- <form method="GET" action="route('comment.show', $post->url)"></form> -->
    <div class="mt-5">
        @for($i = 0; $i < count($comments); $i++) 
            <div class="card col-md-8 offset-md-2 mb-5">
                <div class="card-body">
                    <div class="d-flex ml-1">
                        <div class="author-pic">
                            <a href="#">
                                <img src="{{ asset('images/' . $comments[$i]->photo_url) }}"
                                    class="image rounded-circle avatar mr-2" alt="Image">
                            </a>
                        </div>
                        <div class="text pt-2">
                            <a href="#">
                                <strong>{{ $comments[$i]->username_login }}</strong>
                            </a>

                            <p>{{ $comments[$i]->posted_at }}</p>
                        </div>
                    </div>

                    <div class="">
                        <p>{{ $comments[$i]->content }}</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
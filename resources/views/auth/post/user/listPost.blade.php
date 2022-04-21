@extends('layouts.client')

@section('content-client')
<div class="row header-info py-3">
    <div class="col-md-1 offset-md-2 pl-4">
        <a href="#" class="post-author align-items-center">
            <div class="author-pic">
                <img src="{{ asset('images/' . $user->photo_url) }}" class="image rounded-circle avatar-info mr-2"
                    alt="Image">
            </div>
        </a>
    </div>

    <div class="col-md-2 d-flex flex-column">
        <strong class="text">{{ $user->username_login }}</strong>

        <div>
            @guest
                <a href="{{ route('login') }}" role="button" id="follow_{{$user->id}}" class="follow btn border border-primary px-1 py-0 text-primary">
                {{ __('Follow+') }}
                </a>

            @else
            
            @if (!empty($followed))
            <a role="button" id="follow_{{$user->id}}" class="follow btn border border-primary px-1 py-0 text-primary">
                {{ __('Followed') }}
            </a>
            @else
            <a role="button" id="follow_{{$user->id}}" class="follow btn border border-primary px-1 py-0 text-primary">
                {{ __('Follow+') }}
            </a>
            @endif
            @endguest
        </div>
    </div>
</div>

<div class="container col-md-8 mt-5">
    <form method="GET" action="{{ route('user.post.show', 'username') }}">
        @foreach ($posts as $post)
        <div class="row mt-4">
            <div class="col-md-4">
                <img src="{{ asset('images/' . $post->image) }}" alt="Image" class="img-fluid image-post mb-3">
            </div>

            <div class="col-md-8">
                <div class="post-meta mb-1">
                    @for ($k = 0; $k < count($post->category); $k++)
                        @if ($k == count($post->category) - 1)
                        <a href="#" class="category fw-bold">{{ $post->category[$k] }}</a>
                        @else
                        <a href="#" class="category fw-bold">{{ $post->category[$k] }}</a>,
                        @endif
                        @endfor
                        &mdash;

                        <span class="date">{{ Carbon\Carbon::parse($post->created_at)->format('F d, y') }}</span>
                </div>

                <h2 class="heading mb-3 fw-bold">
                    <a href="{{ route('post.read', urlencode(utf8_encode($post->url))) }}">
                        {{ $post->title }}
                    </a>
                </h2>

                <div class="content-post">
                    <p>{{ $post->content }}</p>
                </div>

                <a href="#" class="post-author d-flex align-items-center">
                    <div class="author-pic">
                        <img src="{{ asset('images/' . $post->photo_url) }}" class="image rounded-circle avatar mr-2"
                            alt="Image">
                    </div>

                    <div class="text">
                        <strong>{{ $post->author }}</strong>
                        <br>
                        <span>{{ 'Author, ' .$post->numPostsOfAuthor. ' published post' }}</span>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </form>

    <div class="d-flex justify-content-center mt-5">
        {{ $posts->links() }}
    </div>
</div>

@endsection
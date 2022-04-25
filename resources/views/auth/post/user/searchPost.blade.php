@extends('layouts.clientSearch')

@section('content-client-search')
<div class="container col-md-6 offset-md-3">
    <form method="GET" action="{{ route('search.post', ['key' => $key]) }}">
        @if (count($posts) == 0) 
            <h4 class="pt-4 pl-4">{{ __('No post found') }}</h4>
        @else
            @foreach ($posts as $post)
                <div class="row mt-4">
                    <div class="col-md-4">
                        <img src="{{ asset('images/' . $post->image) }}" alt="Image"
                            class="img-fluid image-post mt-3">
                    </div>

                    <div class="col-md-8">
                        <div class="post-meta mb-1">
                            @for ($k = 0; $k < count($post->category); $k++)
                                    @if ($k == count($post->category) - 1)
                                        <a href="{{ route('category.show', ['category' => strtolower($post->category[$k])]) }}" 
                                            class="category fw-bold">{{ $post->category[$k] }}</a>
                                    @else
                                        <a href="{{ route('category.show', ['category' => strtolower($post->category[$k])]) }}" 
                                            class="category fw-bold">{{ $post->category[$k] }}</a>,
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
                            
                        <a href="{{ route('user.post.show', ['username' => $post->author]) }}" 
                            class="post-author d-flex align-items-center">
                            <div class="author-pic">
                                <img src="{{ asset('images/' . $post->photo_url) }}"
                                    class="image rounded-circle avatar mr-2" alt="Image">
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
        @endif
    </form>

    <div class="d-flex justify-content-center mt-5">
        {{ $posts->links() }}
    </div>
</div>

@endsection

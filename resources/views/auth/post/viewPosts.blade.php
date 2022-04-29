@extends('layouts.client')

@section('content-client')
    <div class="container">
        <form method="GET" action="{{ route('post.view') }}">
            @for ($i = 0; $i < count($posts); $i = $i + 3)
                <div class="row">
                    @for ($j = 0; $j < 3; $j++)
                        @if(empty($posts[$i + $j]->image))  @break  @endif
                        <div class="col-4">
                            <div class="post-entry d-block small-post-entry-v">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/' . $posts[$i + $j]->image) }}" alt="Image"
                                        class="img-fluid image-post mt-5 mb-3">
                                </div>

                                <div class="content">
                                    <div class="post-meta mb-1">
                                        @for ($k = 0; $k < count($posts[$i + $j]->category); $k++)
                                            @if ($k == count($posts[$i + $j]->category) - 1)
                                                <a href="{{ route('category.show', ['category' => strtolower($posts[$i + $j]->category[$k])]) }}"
                                                    class="category fw-bold">{{ $posts[$i + $j]->category[$k] }}</a>
                                            @else
                                                <a href="{{ route('category.show', ['category' => strtolower($posts[$i + $j]->category[$k])]) }}"
                                                    class="category fw-bold">{{ $posts[$i + $j]->category[$k] }}</a>,
                                            @endif
                                        @endfor
                                        &mdash;
                                        <span
                                            class="date">{{ Carbon\Carbon::parse($posts[$i + $j]->created_at)->format('F d, y') }}</span>
                                    </div>
                                    <h2 class="heading mb-3 fw-bold">
                                        <a href="{{ route('post.read', urlencode(utf8_encode($posts[$i + $j]->url))) }}">
                                            {{ $posts[$i + $j]->title }}
                                        </a>
                                    </h2>
                                    <div class="content-post">
                                        <p>{{ $posts[$i + $j]->content }}</p>
                                    </div>
                                    <a href="{{ route('user.post.show', ['username' => $posts[$i + $j]->author]) }}" 
                                        class="post-author d-flex align-items-center">
                                        <div class="author-pic">
                                            <img src="{{ asset('images/' . $posts[$i + $j]->photo_url) }}"
                                                class="image rounded-circle avatar mr-2" alt="Image">
                                        </div>
                                        <div class="text">
                                            <strong>{{ $posts[$i + $j]->author }}</strong>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endfor

            <div class="d-flex justify-content-center mt-5">
                {{ $posts->links() }}
            </div>

            @for ($i = 0; $i < count($categories); $i++)
                <div class="mb-5">
                    <h3 class="font-weight-bold">{{ $categories[$i] }}</h3>

                    @foreach ($posts as $post)
                        @if(in_array($categories[$i], $post->category))
                        <div class="row mt-4">
                            <div class="col-md-2">
                                <img src="{{ asset('images/' . $post->image) }}" alt="Image"
                                    class="img-fluid image-post">
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
                        @endif
                    @endforeach
                </div>
            @endfor
        </form>
    </div>
@endsection

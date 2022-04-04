@extends('layouts.client')

@section('content-client')
    <div class="container">
        <form method="GET" action="{{ route('post.view') }}">
            @for ($i = 0; $i < count($posts); $i = $i + 3)
                <div class="row">
                    @for ($j = 0; $j < 3; $j++)
                        <div class="col">
                            <div class="post-entry d-block small-post-entry-v">
                                <div class="thumbnail">
                                    <img src="{{ asset('images/' . $posts[$i + $j]->image) }}" alt="Image"
                                        class="img-fluid image-post mt-5 mb-3">
                                </div>

                                <div class="content">
                                    <div class="post-meta mb-1">
                                        @for ($k = 0; $k < count($posts[$i + $j]->category); $k++)
                                            @if ($k == count($posts[$i + $j]->category) - 1)
                                                <a href="#"
                                                    class="category fw-bold">{{ $posts[$i + $j]->category[$k] }}</a>
                                            @else
                                                <a href="#"
                                                    class="category fw-bold">{{ $posts[$i + $j]->category[$k] }}</a>,
                                            @endif
                                        @endfor
                                        &mdash;
                                        <span
                                            class="date">{{ Carbon\Carbon::parse($posts[$i + $j]->created_at)->format('F d, y') }}</span>
                                    </div>
                                    <h2 class="heading mb-3 fw-bold">
                                        <a href="{{ route('post.read', $posts[$i + $j]->url) }}">
                                            {{ $posts[$i + $j]->title }}
                                        </a>
                                    </h2>
                                    <div class="content-post">
                                        <p>{{ $posts[$i + $j]->content }}</p>
                                    </div>
                                    <a href="#" class="post-author d-flex align-items-center">
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
        </form>
    </div>
@endsection

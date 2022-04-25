@extends('layouts.clientSearch')

@section('content-client-search')
<div class="container col-md-6 offset-md-3">
    <form method="GET" action="{{ route('search.category', ['key' => $key]) }}">
        @if (count($categories) == 0) 
            <h4 class="pt-4 pl-4">{{ __('No category found') }}</h4>
        @else
            @foreach ($categories as $category)
                <div class="mt-4">
                    <h3>{{$category->category_name}}</h3>
                    <span>{{$category->description}}</span><br>
                    <a href="{{ route('category.show', ['category' => $category->category_name]) }}">
                        <span class="text-decoration-underline text-primary">{{__('View posts list >>>') }}</span>
                    </a>
                </div>
            @endforeach
        @endif
    </form>

    <div class="d-flex justify-content-center mt-5">
        {{ $categories->links() }}
    </div>
</div>

@endsection
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
        <img src="{{ asset('images/' . $post->image) }}" alt="Image" class="img-fluid rounded image-post col-8 mb-3">
    </div>
    <div class="d-flex justify-content-center">
        <p class="col-8">{{ $post->content }}</p>
    </div>
</form>
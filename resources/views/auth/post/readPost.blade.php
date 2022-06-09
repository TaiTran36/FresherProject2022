<form method="GET" action="{{ route('post.read', urlencode(utf8_encode($post->url))) }}">
    <div class="d-flex justify-content-center">
        <img src="{{ asset('images/' . $post->photo_url) }}" class="image rounded-circle mt-5"
            style="width:70px; height:70px;" alt="Image">
    </div>
    <div class="d-flex justify-content-center">
        <p class="mb-0 fs-5 text text-secondary" style="height:30px;">{{ $post->author }}</p>
    </div>
    <div class="d-flex justify-content-center">
        <p class="mb-0 fs-6 text text-secondary font-weight-light">{{ Carbon\Carbon::parse($post->created_at)->format('F
            d, Y') }}</p>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <h2 class="heading col-8 mb-3 text-center fs-3 text fw-bold">
            {{ $post->title }}
        </h2>
    </div>

    <div class="d-flex justify-content-center">
        <img src="{{ asset('images/' . $post->image) }}" alt="Image" class="img-fluid rounded image-post col-8 mb-3">
    </div>
    <div class="d-flex justify-content-center">
        <p class="col-8 mb-1 fs-6 text text-secondary">{{ $post->content }}</p>
    </div>
</form>
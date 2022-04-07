<form method="POST" action="{{ route('comment.store', urlencode(utf8_encode($post->url))) }}">
    @csrf

    <div>
        <input id="post_id" type="hidden" class="form-control" name="post_id" value="{{$post->id}}">

        <label for="comment" class="offset-md-2 col-form-label pl-1">
            <h5>{{ __('Comment') }}</h5>
        </label>

        <div class="col-md-8 offset-md-2">
            <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" rows="8" name="content" required></textarea>

            @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="offset-md-2 mt-3 pl-1">
            <button type="submit" class="col-md-3 btn bg-primary pt-2 pb-2">
                {{ __('POST COMMENT') }}
            </button>
        </div>
    </div>
</form>
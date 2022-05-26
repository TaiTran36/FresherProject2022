<div class="comment-frame">
    <input id="post_id" type="hidden" class="form-control" name="post_id" value="{{$post->id}}">

    <label for="comment" class="offset-md-2 col-form-label pl-1">
        <p class="mt-2 mb-0 num-comments">{{ count($comments) }}&#09;
            @if (count($comments) <= 1)
                {{ __('Comment') }}
            @elseif( count($comments) > 1)
                {{ __('Comments') }}      
            @endif
        </p>
    </label>

    <div class="col-md-8 offset-md-2">
        <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" rows="3"
            name="content" required></textarea>

        @error('content')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="offset-md-2 mt-3 pl-1">
        <a class="col-md-2 btn bg-primary pt-2 pb-2 create-comment" id="create-comment_{{$post->id}}">
            {{ __('COMMENT') }}
        </a>
    </div>

    @include('../../auth/comment/listComment', $comments)
</div>
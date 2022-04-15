<div class="d-flex offset-md-2">
    <a role="button" id="like_{{$post->id}}" class="like btn btn-sm">
        @if ($liked == null)
            <i class="fa-solid fa-thumbs-up" style="color:#778899;"></i>
        @elseif (!empty($liked))
            <i class="fa-solid fa-thumbs-up"></i>
        @endif

        <span id="likes_{{$post->id}}">{{$likeNum}}</span>
    </a>

    <a role="button" id="dislike_{{$post->id}}" class="dislike btn btn-sm">
        @if ($disliked == null)
            <i class="fa-solid fa-thumbs-down" style="color:#778899;"></i>
        @elseif (!empty($disliked))
            <i class="fa-solid fa-thumbs-down"></i>
        @endif

        <span id="dislikes_{{$post->id}}">{{$dislikeNum}}</span>
    </a>
</div>

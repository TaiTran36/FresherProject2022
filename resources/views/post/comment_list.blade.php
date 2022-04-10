<link href="{{ asset('css/comment.css') }}" rel="stylesheet" type="text/css">

<div class="comments">
    @if (count($list_comments) > 0)
        @foreach ($list_comments as $comment)
            <div class="be-comment">
                <div class="be-img-comment">
                    <a href="blog-detail-2.html">
                        <img onerror="this.src='/profile/error_img/not_found.png'"
                            src="{{ asset('/profile/' . $comment->user_avatar) }}" alt="" class="be-ava-comment">
                    </a>
                </div>
                <div class="be-comment-content">

                    <span class="be-comment-name">
                        <a href="blog-detail-2.html">{{ $comment->user_name }}</a>
                    </span>
                    <span class="be-comment-time">
                        <i class="fa fa-clock-o"></i>
                        {{ $comment->created_at }}
                    </span>

                    <p class="be-comment-text">
                        {{ $comment->comment_text }}
                    </p>
                </div>
            </div>
        @endforeach
    @else
        <p class="no-comments">No Comments Yet</p>
    @endif
</div>

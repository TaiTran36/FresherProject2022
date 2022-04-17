<div id="list_comments" class="comments">
    @if (count($list_comments) > 0)
        @foreach ($list_comments as $comment)
            @Auth
                @if (Auth::user()->id == $comment->writer_id)
                    <div style="float: right; padding-top:5%">
                        <button id="edit_comment" class="tooltip" data-id="{{ $comment->id }}">
                            <i style="color: #F59E0B;" class="fas fa-edit"></i> <span class="tooltiptext">Edit</span>
                        </button>
                        <br>
                        <input id="page" value={{ $list_comments->currentPage() }} hidden>
                        <button id="delete_comment" class="tooltip" style="padding-top: 40%"
                            data-id="{{ $comment->id }}"
                            onclick="return confirm('Are you sure to delete this comment?');">
                            <i style="color: #f50b0b;" class="fa fa-trash"></i> <span class="tooltiptext">Delete</span>
                        </button>
                    </div>
                @endif
            @endAuth
            <div class="be-comment">
                <div class="be-img-comment">
                    <a href="/author/{{ $comment->writer_username }}/posts">
                        <img onerror="this.src='/profile/error_img/not_found.png'"
                            src="{{ asset('/profile/' . $comment->user_avatar) }}" alt="" class="be-ava-comment">
                    </a>
                </div>
                <div class="be-comment-content">

                    <span class="be-comment-name">
                        <a href="/author/{{ $comment->writer_username }}/posts">{{ $comment->user_name }}</a>
                    </span>
                    <span class="be-comment-time">
                        <i class="fa fa-clock-o"></i>
                        {{ $comment->created_at }}
                    </span>
                    <p id="comment_text_{{ $comment->id }}" class="be-comment-text">
                        {{ $comment->comment_text }}
                    </p>
                    <input onfocus="this.setSelectionRange(this.value.length,this.value.length);"
                        style="display: none; background-color: aliceblue;"
                        id="comment_text_input_{{ $comment->id }}" class="be-comment-text"
                        value="{{ $comment->comment_text }}">
                    <button type="button" id="update_comment_{{ $comment->id }}"
                        style="display: none; width:11%; padding:5px 5px 5px 10px"
                        class="my-2 w-full md:w-max px-24 py-3 text-xs font-bold tracking-wider text-white bg-yellow-500 rounded-full hover:bg-white hover:text-yellow-500 hover:shadow-2xl transition duration-500 ease-in-out ">Done</button>
                </div>
            </div>
        @endforeach
        <div style="margin: auto ;width: 30%;padding: 10px;" id="pagination_all">
            {{ $list_comments->links('pagination::simple-tailwind') }}
        </div>
    @else
        <p class="no-comments">No Comments Yet</p>
    @endif
</div>

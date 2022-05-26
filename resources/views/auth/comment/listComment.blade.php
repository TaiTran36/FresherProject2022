<div class="mt-3 list-comment">
    @for($i = 0; $i < count($comments); $i++) 
        <div class="card col-md-8 offset-md-2 mb-3 comment" id="comment_{{$comments[$i]->id}}">
            <div class="card-body">
                <div class="d-flex ml-1">
                    <div class="author-pic">
                        <a href="#">
                            <img src="{{ asset('images/' . $comments[$i]->photo_url) }}"
                                class="image rounded-circle avatar mr-2" alt="Image">
                        </a>
                    </div>
                    <div class="col-md-10 text pt-2">
                        <a href="#">
                            <strong>{{ $comments[$i]->username_login }}</strong>
                        </a>

                        <p>{{ $comments[$i]->posted_at }}</p>
                    </div>

                    @if (Auth::user()->id == $comments[$i]->user_id)
                    <div class="float-right">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item edit-comment" id="edit-comment_{{$comments[$i]->id}}">
                                {{ __('Edit') }}
                            </a>

                            <a class="dropdown-item delete-comment" id="delete-comment_{{$comments[$i]->id}}">
                                {{ __('Delete') }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="content-comment_{{$comments[$i]->id}}">
                    <p id="comment-text_{{$comments[$i]->id}}">
                        {{ str_limit(strip_tags($comments[$i]->content), 300) }}
                        @if (strlen(strip_tags($comments[$i]->content)) > 300)
                        ... <a role="button" id="see-more_{{$comments[$i]->id}}" class="see-more">{{ 'See More' }}</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @endfor
</div>
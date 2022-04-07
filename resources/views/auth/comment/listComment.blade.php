<div class="mt-3">
    @for($i = 0; $i < count($comments); $i++) 
        <div class="card col-md-8 offset-md-2 mb-3">
            <div class="card-body">
                <div class="d-flex ml-1">
                    <div class="author-pic">
                        <a href="#">
                            <img src="{{ asset('images/' . $comments[$i]->photo_url) }}"
                                class="image rounded-circle avatar mr-2" alt="Image">
                        </a>
                    </div>
                    <div class="text pt-2">
                        <a href="#">
                            <strong>{{ $comments[$i]->username_login }}</strong>
                        </a>

                        <p>{{ $comments[$i]->posted_at }}</p>
                    </div>
                </div>

                <div>
                    <p>{{ $comments[$i]->content }}</p>
                </div>
            </div>
        </div>
    @endfor
</div>
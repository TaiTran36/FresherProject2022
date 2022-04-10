<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/comment.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/like.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
    @include('templates/client_header')
    @foreach ($post as $post)
        <title>{{ $post->title }}</title>
        <div class="customers">
            <div class="top w-11/12 lg:w-7/12 mx-auto my-14">
                <div class="info mx-auto">
                    <div class="personpic w-16 mx-auto"><img class="rounded-full w-full"
                            src="{{ asset('/profile/' . $post->writer_avatar) }}"></div>
                    <h2 class="text-center text-gray-500 text-lg">{{ $post->writer_name }}</h2>
                    <h3 class="text-center text-gray-500">{{ $post->created_at }}</h3>
                </div>
                <h1 class="px-6 text-3xl lg:text-4xl text-center font-extrabold tracking-wide leading-normal mt-6">
                    {{ $post->title }}</h1>
                <div class="pic w-full mx-auto "><img class="w-full rounded-md " onerror="this.style.display='none'"
                        src="{{ asset('/post/' . $post->photo_path) }}"></div>
                <p class="my-5 text-gray-500 font-sans text-lg tracking-wide">{{ $post->content }}</p>
                {{-- like --}}

                <div class="wrapper">
                    <input id="post_id" name="post_id" value="{{ $post->id }}" hidden>
                    <div class="radio_group">
                        <input @guest
                            disabled
                        @endguest id="likebtn" type="radio" name="like" value="1">
                        <label for="like">
                            <i class="fas fa-thumbs-up"></i>
                        </label>
                    </div>
                    <a id="count_like">{{ $count_like }}</a>
                    <div class="radio_group">
                        <input @guest
                        disabled
                    @endguest id="dislikebtn" type="radio" name="like" value="-1">
                        <label for="like">
                            <i class="fas fa-thumbs-down"></i>
                        </label>
                    </div>
                    <a id="count_dislike">{{ $count_dislike }}</a>
                </div>
                @guest
                <h12 class="text-dark-500 text-sm font-awesome mt-10 mb-6">You must login to like and dislike !</h2><a
                @endguest
                <div class="social my-16 border-t-2 border-gray-300">
                    <h1 class="text-gray-500 text-lg font-bold mt-10 mb-6">Share</h1><a
                        class="p-1 m-1 rounded-lg text-xl hover:text-yellow-500 transition duration-500 ease-in-out"
                        href="#"><i class="ri-facebook-fill"></i></a><a
                        class="p-1 m-1 rounded-lg text-xl hover:text-yellow-500 transition duration-500 ease-in-out"
                        href="#"><i class="ri-twitter-fill"></i></a><a
                        class="p-1 m-1 rounded-lg text-xl hover:text-yellow-500 transition duration-500 ease-in-out"
                        href="#"><i class="ri-linkedin-fill"></i></a><a
                        class="p-1 m-1 rounded-lg text-xl hover:text-yellow-500 transition duration-500 ease-in-out"
                        href="#"><i class="ri-pinterest-fill"></i></a>
                    {{-- Comment --}}
                    <div class="card mt-4">
                        <h5 class="text-gray-500 text-lg font-bold mt-10 mb-6">Comments <span
                                class="text-blue-500 text-lg font-bold mt-10 mb-6">{{ count($list_comments) }}</span>
                        </h5>
                        <div class="card-body">
                            {{-- Add Comment --}}
                            <form class="add-comment mb-3" action="{{ url('/post/save-comment') }}"
                                enctype="multipart/form-data" method="post">
                                @csrf
                                <input name="post_id" value="{{ $post->id }}" hidden>
                                <input name="url" value="{{ $post->url }}" hidden>

                                <textarea name="comment" id="comment" class=" my-2 w-full w-2/3 mr-3 p-3 rounded-md border border-gray-300" @guest
                                    placeholder="You must login to add comment !" disabled @else placeholder="Enter your comment"
                                    @endguest></textarea>
                                <button id="save-comment" data-post="{{ $post->id }}"
                                    class="my-2 w-full md:w-max px-24 py-3 text-xs font-bold tracking-wider text-white bg-yellow-500 rounded-full hover:bg-white hover:text-yellow-500 hover:shadow-2xl transition duration-500 ease-in-out ">Submit</button>
                            </form>
                            <hr />
                            {{-- List Start --}}

                            <div class="comments">
                                @if (count($list_comments) > 0)
                                    @foreach ($list_comments as $comment)
                                        <div class="be-comment">
                                            <div class="be-img-comment">
                                                <a href="blog-detail-2.html">
                                                    <img onerror="this.src='/profile/error_img/not_found.png'"
                                                        src="{{ asset('/profile/' . $comment->user_avatar) }}" alt=""
                                                        class="be-ava-comment">
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
                        </div>
                    </div>
    @endforeach
    </div>
    </div>
    </div>
    <!--footer-->
    <footer>
        @include('templates/client_footer')
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"> </script>
    <script src="js/plugin.js"> </script>
    <script>
        new Splide('.splide').mount();
    </script>
</body>

</html>
<script>
    $("#likebtn").on('click', function() {
        var post_id = $("#post_id").val();
        $.ajax({
            method: "get",
            url: "/post/like",
            data: {
                'post_id': post_id,
            },
            success: function(data) {
                $('#count_like').html(data.likes);
                $('#count_dislike').html(data.dislikes);
            }
        })
    })
    $("#dislikebtn").on('click', function() {
        var post_id = $("#post_id").val();
        $.ajax({
            method: "get",
            url: "/post/dislike",
            data: {
                'post_id': post_id,
            },
            success: function(data) {
                $('#count_like').html(data.likes);
                $('#count_dislike').html(data.dislikes);

            }
        })
    })
</script>
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$("#save-comment").on('click',function(){
    alert("cc");
    var _comment=$("#comment").val();
    var _post_id=$("#post_id").val();
    var _url=$("#url").val();
    // Run Ajax
    $.ajax({
      url: '/post/save-comment',
        type:"post",
        data:{
            comment: _comment,
            post_id: _post_id,
            url: _url
        },
        success:function(data){
            alert("aa");
            // var _html='<blockquote class="blockquote animate__animated animate__bounce">\
            // <small class="mb-0">'+_comment+'</small>\
            // </blockquote><hr/>';
            // if(res.bool==true){
            //     $(".comments").prepend(_html);
            //     $(".comment").val('');
            //     $(".comment-count").text($('blockquote').length);
            //     $(".no-comments").hide();
            // }
        }   else alert("cc");
    });
});
});
</script> --}}

@extends('layouts.welcome')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
@section('content')
    <div class="customers">
      <div class="top w-11/12 lg:w-7/12 mx-auto my-14">
        <div class="info mx-auto">
          @foreach ($post as $post)
          <title>{{$post->title}}</title>
          <a href="/{{ $post->writer_id }}/{{ $post->writer_name }}/posts">
          <div class="personpic w-16 mx-auto"><img class="rounded-full w-full" onerror="this.src='/storage/image_err/no-image.jpg'"  src="{{asset('/profile/' . $post->writer_avatar) }} "></div>
          <h2 class="text-center text-gray-500 text-lg">{{ $post->writer_name }}</h2>
          <h3 class="text-center text-gray-500">{{ date('d F, Y' ,strtotime( $post->created_at)) }}</h3>
          </a>
        </div>
        <h1 class="px-6 text-3xl lg:text-4xl text-center font-extrabold tracking-wide leading-normal mt-6">{{ $post->title }}</h1>
        <p class=" px-10 w-11/12 mx-auto my-4 text-center text-xl text-gray-500">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
        <div class="pic w-full mx-auto "><img class="w-full rounded-md " onerror="this.src='/storage/image_err/no-image.jpg'" src="{{asset('/post/' . $post->photo) }}"></div>
        <p class="my-5 text-gray-500 font-sans text-lg tracking-wide">{{ $post->content }}</p>
        
        <div class="social my-16 border-t-2 border-gray-300">
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
                    <i class="fas fa-thumbs-down" ></i>
                </label>
            </div>
            <a id="count_dislike">{{ $count_dislike }}</a>
        </div>
        @guest
        <h2 class="text-dark-500 text-sm font-awesome mt-10 mb-6">You must login to like and dislike !</h2>
            
        @endguest
        <?php $i = 0; ?>
              
                  
                
                    @if ( $i < 1)
                    <?php $i++; ?>
                        @guest
                            <p class="text-2xl font-bold text-black mb-4">Subscribe this author ?</p>

                            <button type="submit" class="btn btn-danger" >
                                <a href="{{ route('login') }}">Login now ?</a>
                            </button>
                        @endguest
                        
                        @auth
                            
                        @if($post->writer_id == Auth::user()->id)
                                
                        @elseif($follow == true)
                            
                            <div style="width: 11%;float: left">
                                <form action="{{ url('/unsubscribed') }}" method="post" >
                                    <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
                                    <input type="hidden" id="writer_id" name="writer_id" value="{{ $post->writer_id }}"/>
                                        <button class="btn btn-secondary"><a onclick="return confirm('Are you sure to UnSubscribe?');"> UnSubscribe</a></button>  
                                </form>  
                            </div>
                                
                                @if($tb == true)
                                
                                    <form action="{{ url('/tattb') }}" method="post" >
                                        <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
                                        <input type="hidden" id="writer_id" name="writer_id" value="{{ $post->writer_id }}"/>
                                            <button class="btn btn-secondary" style="height: 38px"><i class="fa fa-bell" aria-hidden="true"></i></button>  
                                    </form> 
                                @else
                                    <form action="{{ url('/battb') }}" method="post" >
                                        <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
                                        <input type="hidden" id="writer_id" name="writer_id" value="{{ $post->writer_id }}"/>
                                            <button class="btn btn-secondary" style="height: 38px"><i class="fa fa-bell-slash" aria-hidden="true"></i></button>  
                                    </form> 
                                
                                @endif
                            
                                
                        @else 
                                <form action="{{ url('/subscribed') }}" method="post" >
                                    
                                    <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
                                    <p class="text-2xl font-bold text-black mb-4">Subscribe this author ?</p>
                                    <input type="hidden" id="writer_id" name="writer_id" value="{{ $post->writer_id }}"/>
                                        <button class="btn btn-primary"> Subscribe</button>  
                                </form>
                        @endif
                            
                        @endauth
                            
                @endif
          <h1 class="text-gray-500 text-lg font-bold mt-10 mb-6">Share</h1><a class="p-1 m-1 rounded-lg text-xl hover:text-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-facebook-fill"></i></a><a class="p-1 m-1 rounded-lg text-xl hover:text-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-twitter-fill"></i></a><a class="p-1 m-1 rounded-lg text-xl hover:text-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-linkedin-fill"></i></a><a class="p-1 m-1 rounded-lg text-xl hover:text-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-pinterest-fill"></i></a>
        </div>
        <div class="card mt-4">
          <h5 class="text-gray-500 text-lg font-bold mt-10 mb-6">Comments <span
                  class="text-blue-500 text-lg font-bold mt-10 mb-6">{{ count($list_comments) }}</span>
          </h5>
          <div class="card-body">
              
                <form class="add-comment mb-3">
                @csrf
                <input name="post_id" value="{{ $post->id }}" hidden>
                <input name="url" value="{{ $post->url }}" hidden>
               
                @guest
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <a href="{{ route('login') }}">Login now ?</a>
                  </button>
                @else
            
                <textarea name="comment" id="comment" class=" my-2 w-full w-2/3 mr-3 p-3 rounded-md border border-gray-300" 
                    @guest
                        placeholder="You must login to add comment !" disabled @else placeholder="Enter your comment"
                    @endguest required></textarea>
                    
                
                <button id="save-comment" data-post="{{ $post->id }}" class="button-7" id="btn-comment">Submit</button>
                @endguest
              </form>
              
              <div>
                
                
                    @if (count($list_comments) > 0)
                        @foreach ($list_comments->take(5) as $comment )
                        
                        <div class="card p-3 mb-2">
                            <div class="d-flex flex-row"> <img onerror="this.src='/storage/image_err/no-image.jpg'" src="{{ asset('/profile/' . $comment->user_avatar) }}" height="75" width="75" class="rounded-circle">
                                <div class="d-flex flex-column ms-2">
                                    <h6 class="mb-1 text-primary">{{ $comment->user_name }}</h6>
                                    <p class="comment-text">{{ $comment->comment_text }}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
        
                                <div class="d-flex flex-row"> <span class="text-muted fw-normal fs-10">{{date('d F, Y' ,strtotime( $comment->created_at))}}</span> </div>
                            </div>
                        </div>
                        
                    
                                
                      @endforeach
                      
                      
                  @else
                      <p>No Comments Yet</p>
                  @endif
              </div>
            
            <!-- Modal -->
            
          </div>
        
      </div>
          <!-- Modal -->
          

    @endforeach 
   <script>
        // $('#btn-comment').click(function(ev){
        //    ev.preventDefault();
        //    let content = $('comment').val();
        //    let _commentUrl = '{{ route("ajax.comment") }}';
        //    console.log(content ,_commentUrl)
        // )}
        $('#save-comment').on('click', function () {
        var comment = $("#comment").val();
        var post_id = $("#post_id").val();
        var post_url = $("#post_url").val();
        const comment_area = document.getElementById('comment');
        $.ajax({
            method: "get",
            url: "/post/save_comment",
            data: {
                'post_id': post_id,
                'comment': comment,
                'post_url': post_url
            },
            success: function(data) {
                $('#list_comments').html(data.comments_views);
                $('#count_comment').html(data.count);
                comment_area.value='';
            }
        })
    });
   </script>
 @endsection
@extends('layouts.welcome')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
    <div style="padding-left: 17%;padding-right: 7%; display:flow-root;">
        <div class=" container lg:flex block" style="float: left;width:49%;">
            <div class="block my-20 " style="padding-left:10%; ">
                @foreach ($writer as $writer)
                    @auth
                        
                        @if ($writer->id == Auth::user()->id)

                            <h1 style="font-size: 300%;">All your post</h1>
                            <h2 class="text-2xl font-bold mb-0">{{ count($posts) }} results</h2>
                        
                        @else
                        
                            <h1 class="text-2xl font-extrabold mb-0">All posts by author: <b>{{ $writer->name }}</b></h1>
                            <h2  class="text-2xl font-bold mb-0">{{ count($posts) }} results</h2>
                        @endif
                    @endauth
                    <h2  class="text-2xl  mb-0">{{ count($countfollow) }} follow</h2>
                    
                
                
                @foreach ($posts as $post)
                
                    @if ($post->writer_id == $writer->id)
                        <!--Bussiness cards-->
                        <div class="parent">
                            <div class="business_cards md:flex block my-12">
                                <div class="md:w-80 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md "style="width:280px;height:180px" onerror="this.src='/storage/image_err/no_image.png'" src="{{ asset('/post/' . $post->photo) }}"></div>
                                <!--content-->
                                <div class="content" style="width:800px;height:150px">
                                    <div class="top text-sm ">
                                        @foreach ($cats as $cat)
                                            @if ($cat->posts_id == $post->id)
                                                <a class="font-bold" href="/category/{{ $cat->categories }}/posts">{{ ' ' . $cat->categories }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                    <h2 class="pr-10"><a class="text-lg font-extrabold "
                                            href="/post/{{ $post->url }}/detail_post">{{ $post->title }}</a>
                                    </h2>
                                    <p class="text-gray-500 mt-2 text-md leading-sung tracking-wide" style="text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;width:600px"> {{ $post->content }}</p>
                                    <a class="flex mt-2" href="/{{ $post->writer_id }}/{{ $post->writer_name }}/posts">
                                        <div class="author-pic w-12 mr-5"><img class="rounded-full" onerror="this.src='/storage/image_err/no-image.jpg'" src="{{ asset('/profile/' . $post->writer_avatar) }}"></div>
                                        <div class="author-info mt-2">
                                            <strong class="block text-sm">{{ $post->writer_name }}</strong>
                                                <span class="text-sm text-gray-500">{{date('H:i:s d-m-Y ' ,strtotime( $post->created_at))}}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                @endforeach
              
                <?php $i = 0; ?>
              
                  
                
                    @if ( $i < 1)
                    <?php $i++; ?>
                        @guest
                            <p class="text-2xl font-bold text-black mb-4">Subscribe this author ?</p>

                            <button type="submit" class="btn btn-danger"  data-toggle="modal" data-target="#exampleModal">Login now ?</button>
                        @endguest
                        
                        @auth
                               
                                @if (count($posts)== '0')
                                    <h3>Bạn chưa có bài viết</h3>
                                @elseif($post->writer_id == Auth::user()->id)
                                
                                @elseif($follow == true)
                                    <div style="width: 100%">
                                        <div style="width: 11%;float: left">
                                        <form action="{{ url('/unsubscribed') }}" method="post" >
                                            <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
                                            <input type="hidden" id="writer_id" name="writer_id" value="{{ $post->writer_id }}"/>
                                                <button class="btn btn-secondary"> <a onclick="return confirm('Are you sure to UnSubscribe?');"> UnSubscribe</a></button>  
                                        </form>  
                                        </div>
                                        @if($tb == true)
                                        <div style="margin-left: 1px">
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
                                        </div>
                                        @endif
                                    </div>
                                        
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
                {{-- @foreach ($posts as $post) --}}
                {{-- @endforeach --}}

                
                
                
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog odal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Đăng nhập ngay</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <form action="" method="POST" role="form">
             <div class="form-group">
                 <label for="">Email</label>
                 <input type="email" class="form-control" name="email" placeholder="Input Email">
             </div>
             <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Input password">
            </div>
         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-login">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <script>
      $("exampleModalLabel").on('show.bs.modal',event=>{
        var button = $(event.relatedTarget);
        var modal = $(this);
      });
  </script>
@endsection
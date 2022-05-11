@extends('layouts.welcome')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
<title>Home</title>
<div style="padding-left: 7%;padding-right: 7%; display:flow-root;">
    <!--slider-->
    <div class="parent " >
      <h1 class="mt-16 text-center text-4xl font-extrabold tracking-wide ">Newest</h1>
      <div class="slider my-20">
        <div class="splide" style="height: 400px">
          <div class="splide__track" >
            <ul class="splide__list" >
              @foreach ($post as $post)
              <li class="splide__slide">
                <div class="son lg:flex">
                  <div class="pic w-full lg:w-1/3 md:mr-10 ">
                    <img class="w-full rounded-md" style="height: 310px" src="{{ asset('/post/' . $post->photo) }}">
                  </div>
                  <!--content-->
                  <div class="content w-full lg:w-2/3 mt-8">
                    <div class="top text-sm"><a class="font-bold" >   
                      @foreach ($cate as $cat)
                        @if ($cat->posts_id == $post->id)
                            <a class="font-bold" href="/category/{{ $cat->categories }}/posts">{{ ' ' . $cat->categories }}</a>
                        @endif
                      @endforeach
                      </a>
                      <span class="text-gray-400">- {{date('d F, Y' ,strtotime( $post->created_at))}}</span>
                    </div>
                      <h2 class="mt-6 mb-3 text-4xl font-extrabold leading-sung tracking-wide">
                        <a href="/post/{{ $post->url }}/detail_post">{{$post->title}}</a>
                      </h2>
                      <p class="text-gray-500 mt-2 text-md leading-sung tracking-wide">{{Illuminate\Support\Str::of($post->content)->words(15)}}</p>
                      <a class="flex mt-8 " href="/{{ $post->writer_id }}/{{ $post->writer_name }}/posts">
                      <div class="author-pic w-16 mr-5">
                        <img class="rounded-full" onerror="this.src='/storage/image_err/no-image.jpg'" src="{{asset('/profile/' . $post->writer_avatar) }}">
                      </div>
                      <div class="author-info mt-2">
                        <strong class="block text-sm" >{{$post->writer_name}}</strong>
                      </div>
                    </a>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>

      @foreach ($categories as $category)
      <div class=" container lg:flex block" style="float: left;width:49%;">
          <div class="block my-20 " style="padding-left:10%; ">
              <a href="/category/{{ $category->categories }}/posts" class="text-2xl font-extrabold mb-0">{{ $category->categories }}</a>
              <?php $i = 0; ?>
              @foreach ($posts as $post)
                  @if ($post->category == $category->categories && $i < 2)
                      <?php $i++; ?>
                      <!--Bussiness cards-->
                      <div class="parent">
                          <div class="business_cards md:flex block my-12">
                              <div class="md:w-40 w-full md:mb-0 mb-6 mr-3">
                                <img class="w-full rounded-md " style="height: 160px" href="post/{{ $post->url }}/client_details" onerror="this.src='/storage/image_err/no_image.png'"src="{{ asset('/post/' . $post->photo) }}">
                              </div>
                              <!--content-->
                              <div class="content" style="width:400px;height:120px">
                                  <div class="top text-sm ">
                                      @foreach ($cate as $cat)
                                          @if ($cat->posts_id == $post->id)
                                              <a class="font-bold" href="/category/{{ $cat->categories }}/posts">{{ $cat->categories }}</a>
                                                  
                                          @endif
                                      @endforeach
                                      <span class="text-gray-400">- {{date('d F, Y' ,strtotime( $post->created_at))}}</span>
                                  </div>
                                  <h2 class="pr-10"><a class="text-lg font-extrabold " href="post/{{ $post->url }}/detail_post">{{ $post->title }}</a>
                                  </h2><a class="flex mt-2" href="/{{ $post->writer_id }}/{{ $post->writer_name }}/posts">
                                      <div class="author-pic w-12 mr-5"><img class="rounded-full" onerror="this.src='/storage/image_err/no-image.jpg'" src="{{ asset('/profile/' . $post->writer_avatar) }}"></div>
                                      <div class="author-info mt-2">
                                        <strong class="block text-sm">{{ $post->writer_name }}</strong>
                                        
                                      </div>
                                  </a>
                              </div>
                          </div>
                      </div>
                  @endif
              @endforeach
              <br>
              <a style="font-style: italic; text-decoration: underline" class="text-lg font-bold "
                  href="category/{{ $category->categories }}/posts"> More </a>
          </div>
      </div>
  @endforeach
</div>
@endsection
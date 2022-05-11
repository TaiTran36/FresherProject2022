@extends("layouts.welcome")
@section("content")
<div style="padding-left: 17%;padding-right: 7%; display:flow-root;">
    <div class=" container lg:flex block" style="float: left;width:49%;">
        <div class="block my-20 " style="padding-left:10%; ">
            <h1 class="text-2xl font-extrabold mb-0">All posts by category: <b>{{ $category_name }}</b></h1>
            <h2 style="font-style: italic " class="text-2xl font-bold mb-0">{{ count($posts) }} results</h2>
            @foreach ($posts as $post)
                @if ($post->category == $category_name)
                    <!--Bussiness cards-->
                    <div class="parent">
                        <div class="business_cards md:flex block my-12">
                            <div class="md:w-80 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md " style="width:280px;height:180px" onerror="this.src='/storage/image_err/no-image.jpg'" src="{{ asset('/post/' . $post->photo) }}"></div>
                            <!--content-->
                            <div class="content" style="width:800px;height:150px">
                                <div class="top text-sm ">
                                    @foreach ($cats as $cat)
                                        @if ($cat->posts_id == $post->id)
                                            <a class="font-bold"
                                                href="/category/{{ $cat->categories }}/posts">{{ ' ' . $cat->categories }}</a>
                                        @endif
                                    @endforeach
                                </div>
                                <h2 class="pr-10"><a class="text-lg font-extrabold "
                                        href="/post/{{ $post->url }}/detail_post">{{ $post->title }}</a>
                                </h2>
                                <p class="text-gray-500 mt-2 text-md leading-sung tracking-wide" style="text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;width:600px"> {{ $post->content }}</p><a class="flex mt-2" href="#">
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
        </div>
    </div>
</div>
@endsection
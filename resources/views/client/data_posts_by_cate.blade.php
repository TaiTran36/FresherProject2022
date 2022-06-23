@foreach ($posts as $post)
    @if ($post->category == $category_name)
        <!--Bussiness cards-->
        <div class="parent">
            <div class="business_cards md:flex block my-12">
                <div class="md:w-80 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md "
                        style="width:280px;height:180px" onerror="this.src='/post/error_img/not_found2.png'"
                        src="{{ asset('/post/' . $post->photo_path) }}"></div>
                <!--content-->
                <div class="content" style="width:800px;height:150px">
                    <div class="top text-sm ">
                        @foreach ($cats as $cat)
                            @if ($cat->post_id == $post->id)
                                <a class="font-bold"
                                    href="/category/{{ $cat->name }}/posts">{{ '#' . $cat->name }}</a>
                            @endif
                        @endforeach
                    </div>
                    <h2 class="pr-10"><a class="text-lg font-extrabold "
                            href="/post/{{ $post->url }}/client_details">{{ $post->title }}</a>
                    </h2>
                    <p class="text-gray-500 mt-2 text-md leading-sung tracking-wide"
                        style="text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;width:600px">
                        {{ $post->content }}</p><a class="flex mt-2" href="#">
                        <a href="/author/{{ $post->writer_username }}/posts">
                            <div class="author-pic w-12 mr-5"><img class="rounded-full"
                                    onerror="this.src='/profile/error_img/not_found.png'"
                                    src="{{ asset('/profile/' . $post->writer_avatar) }}"></div>
                            <div class="author-info mt-2"><strong
                                    class="block text-sm">{{ $post->writer_name }}</strong>
                        </a><span class="text-sm text-gray-500">{{ $post->created_at }}</span>
                </div>
                </a>
            </div>
        </div>
        </div>
    @endif
@endforeach
<div style="width:45%" id="pagination_cate_posts">
    {{ $posts->links('pagination::tailwind') }}
</div>

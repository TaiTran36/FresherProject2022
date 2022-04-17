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
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">
    <title>Home</title>
</head>

<body>
    @include('templates/client/client_header')
    <!--main cards-->
    <div style="padding-left: 7%;padding-right: 7%; display:flow-root;">

        <div class="parent">
            <h1 class="mt-16 text-center text-4xl font-extrabold tracking-wide ">Newest posts</h1>
            <div class="slider my-20">
                <div class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($new_posts as $post)
                                <li class="splide__slide">
                                    <div class="son lg:flex">
                                        <div class="pic w-full lg:w-1/3 md:mr-10 "><img class="w-full rounded-md"
                                                onerror="this.src='/post/error_img/not_found2.png'"
                                                style="width:500px; height:300px"
                                                href="post/{{ $post->url }}/client_details"
                                                src="{{ asset('/post/' . $post->photo_path) }}"></div>
                                        <!--content-->
                                        <div class="content w-full lg:w-2/3 mt-8">
                                            <div class="top text-sm">
                                                @foreach ($cats as $cat)
                                                    @if ($cat->post_id == $post->id)
                                                        <a class="font-bold"
                                                            href="/category/{{ $cat->name }}/posts">{{ '#' . $cat->name }}</a>
                                                    @endif
                                                @endforeach
                                                <span class="text-gray-400">- {{ $post->created_at }}</span>
                                            </div>
                                            <h2 class="mt-6 mb-3 text-4xl font-extrabold leading-sung tracking-wide"><a
                                                    href="post/{{ $post->url }}/client_details">
                                                    {{ $post->title }}</a></h2>
                                            <p class="text-gray-500 mt-2 text-md leading-sung tracking-wide"
                                                style="text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;overflow: hidden;">
                                                {{ $post->content }}</p><a class="flex mt-8 " href="/author/{{ $post->writer_username }}/posts">
                                                <div class="author-pic w-16 mr-5"><img class="rounded-full"
                                                        onerror="this.src='/profile/error_img/not_found.png'"
                                                        src="{{ asset('/profile/' . $post->writer_avatar) }}"></div>
                                                <div class="author-info mt-2"><strong class="block text-sm">
                                                        {{ $post->writer_name }}</strong><span
                                                        class="text-xs font-light text-gray-500">Author</span></div>
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
            <div class=" container lg:flex block" @if(in_array($category->id ,$active_cats->pluck('category_id')->toArray())==false) style="display:none" @endif style="float: left;width:49%;">
                <div id="category" class="block my-20 " style="padding-left:10%; ">
                    <a href="/category/{{ $category->name }}/posts"
                        class="text-2xl font-extrabold mb-0">{{ $category->name }}</a>
                    <?php $i = 0; ?>
                    <div class="parent">
                    @foreach ($posts as $post)
                        @if ($post->category == $category->name && $i < 4)
                            <?php $i++; ?>
                            <!--Bussiness cards-->
                                <div class="business_cards md:flex block my-12">
                                    <div class="md:w-40 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md "
                                            style="width:200px;height:120px"
                                            href="post/{{ $post->url }}/client_details"
                                            onerror="this.src='/post/error_img/not_found2.png'"
                                            src="{{ asset('/post/' . $post->photo_path) }}"></div>
                                    <!--content-->
                                    <div class="content" style="width:400px;height:120px">
                                        <div class="top text-sm ">
                                            @foreach ($cats as $cat)
                                                @if ($cat->post_id == $post->id)
                                                    <a class="font-bold"
                                                        href="/category/{{ $cat->name }}/posts">{{ '#' . $cat->name }}</a>
                                                @endif
                                            @endforeach
                                        </div>
                                        <h2 class="pr-10"><a class="text-lg font-extrabold "
                                                href="post/{{ $post->url }}/client_details">{{ $post->title }}</a>
                                        </h2><a class="flex mt-2" href="/author/{{ $post->writer_username }}/posts">
                                            <div class="author-pic w-12 mr-5"><img class="rounded-full"
                                                    onerror="this.src='/profile/error_img/not_found.png'"
                                                    src="{{ asset('/profile/' . $post->writer_avatar) }}"></div>
                                            <div class="author-info mt-2"><strong
                                                    class="block text-sm">{{ $post->writer_name }}</strong><span
                                                    class="text-sm text-gray-500">{{ $post->created_at }}</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                        @endif
                    @endforeach
                </div>
                    <a style="font-style: italic; text-decoration: underline" class="text-lg font-bold "
                        href="category/{{ $category->name }}/posts"> Show all posts by this category... </a>
                </div>
            </div>
        @endforeach
    </div>
    <!--footer-->
    <footer>
        @include('templates/client/client_footer')
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"> </script>
    <script src="{{ asset('js/plugin.js') }}"> </script>
    <script>
        var splide = new Splide('.splide', {
            type: 'loop',
            perPage: 1,
            fade: true,
            autoplay: true,
            autoplaySpeed: 1000,
        });
        splide.mount();
    </script>
</body>

</html>

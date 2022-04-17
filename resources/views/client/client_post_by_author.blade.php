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
    <div style="padding-left: 17%;padding-right: 7%; display:flow-root;">
        <div class=" container lg:flex block" style="float: left;width:49%;">
            <div class="block my-20 " style="padding-left:10%; ">
                @foreach ($writer as $writer)
                <h1 class="text-2xl font-extrabold mb-0">All posts by author: <b>{{ $writer->name }}</b></h1>
                <h2 style="font-style: italic " class="text-2xl font-bold mb-0">{{ count($posts) }} results</h2>
                @foreach ($posts as $post)
                    @if ($post->writer_id == $writer->id)
                        <!--Bussiness cards-->
                        <div class="parent">
                            <div class="business_cards md:flex block my-12">
                                <div class="md:w-80 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md "
                                        style="width:280px;height:180px"
                                        onerror="this.src='/post/error_img/not_found2.png'"
                                        src="{{ asset('/post/'.$post->photo_path) }}"></div>
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
                                                {{ $post->content }}</p><a class="flex mt-2" href="/author/{{ $post->writer_username }}/posts">
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
                        </div>
                    @endif
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <!--footer-->
    <footer>
        @include('templates/client/client_footer')
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"> </script>
    <script src="{{ asset('js/plugin.js') }}"> </script>
    <script>
        new Splide('.splide').mount();
    </script>
</body>

</html>

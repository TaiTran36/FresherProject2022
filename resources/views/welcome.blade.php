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
    <link rel="stylesheet" href="css/main.css">
    <title>Home</title>
</head>

<body>
    @include('templates/client_header')
    <!--main cards-->
    <div style="padding-left: 10%;padding-right: 10%; display:flow-root;">
        @foreach ($categories as $category)
            <div class=" container lg:flex block" style="width:50%; float:left">
                <div class="block my-28">
                    <h1 class="text-2xl font-extrabold mb-0">{{ $category->name }}</h1>
                    @foreach ($posts as $post)
                        @if ($post->category == $category->name)
                            <!--Bussiness cards-->
                            <div class="parent ">
                                <div class="business_cards md:flex block my-12">
                                    <div class="md:w-40 w-full md:mb-0 mb-6 mr-3"><img height="40" weight="40" class="w-full rounded-md "
                                            onerror="this.src='/post/error_img/not_found2.png'"
                                            src="{{ asset('/post/' . $post->photo_path) }}"></div>
                                    <!--content-->
                                    <div class="content">
                                        <div class="top text-sm "><a class="font-bold" href="#">
                                                @foreach ($cats as $cat)
                                                    @if ($cat->post_id == $post->id)
                                                        {{ $cat->name."." }}
                                                    @endif
                                                @endforeach
                                            </a></div>
                                        <h2 class="pr-10"><a class="text-lg font-extrabold "
                                                href="post/{{ $post->url }}/client_details">{{ $post->title }}</a>
                                        </h2><a class="flex mt-2" href="#">
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
                </div>
            </div>
        @endforeach
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

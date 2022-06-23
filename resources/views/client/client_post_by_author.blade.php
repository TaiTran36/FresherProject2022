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
    <title>Author</title>
</head>

<body>
    @include('templates/client/client_header')
    <!--main cards-->
    <div
        @if ($posts->total() > 0) style="padding-left: 17% ;padding-right: 7%; display:flow-root;"
    @else style="padding-left: 35% ;" @endif>
        <div class=" container lg:flex block" style="float: left;width:49%;">
            <div class="block my-10 " style="padding-left:10%;">
                @foreach ($writer as $writer)
                    <div class="info mx-auto" style="padding-right:20%;">
                        <a href="/author/{{ $writer->username_login }}/posts">
                            <div class="personpic w-20 mx-auto"><img href="/author/{{ $writer->username_login }}/posts"
                                    class="rounded-full w-full" onerror="this.src='/profile/error_img/not_found.png'"
                                    src="{{ asset('/profile/' . $writer->avatar) }}"></div>
                            <h1 class="text-center my-2 text-gray-800 text-lg text-5xl">{{ $writer->name }} @auth
                                    @if ($writer->id == Auth::user()->id)
                                        <i>(You)</i>
                                    @endif @endauth
                                </h1>
                            </a>
                            <h2 style="font-style: italic " class="text-3xl text-center font-bold mb-0">
                                <i>{{ $posts->total() }}</i>
                                posts
                            </h2>
                            <h2 id="count_follow" class="text-3xl text-center text-gray-500 font-bold mb-0">
                                <i>{{ count($followers) }}</i>
                                followers
                            </h2> <br>
                        </div>
                        <input id="writer_id" value="{{ $writer->id }}" hidden>
                        <div style="height:120px">
                            <button id="follow"
                                style="float:right ;margin-right:51% @auth @if ($followed) ;display:none @endif @if ($writer->id == Auth::user()->id) ;display:none @endif @endauth "
                                {{-- class="my-2 w-full md:w-max px-8 py-1.5 text-xs font-bold tracking-wider text-white bg-blue-500 rounded-full hover:bg-white hover:text-blue-500 hover:shadow-2xl transition duration-500 ease-in-out " --}} type="submit" @guest disabled
                                    class="my-2 text-center w-full md:w-max px-8 py-1.5 text-xs font-bold tracking-wider text-white bg-gray-500 rounded-full"
                                @else
                                    class="my-2 text-center w-full md:w-max px-8 py-1.5 text-xs font-bold tracking-wider text-white bg-blue-500 rounded-full hover:bg-white hover:text-blue-500 hover:shadow-2xl transition duration-500 ease-in-out "
                                    @endguest>@guest Follow (Login needed)
                                @else
                                Follow this author @endguest
                            </button>
                            @auth
                                <button id="followed"
                                    style="float:right; margin-right:50% @auth  @if ($writer->id == Auth::user()->id) ;display:none @endif @if (!$followed) ;display:none @endif @endauth "
                                    onclick="return confirm('Are you sure to unfollow this author?');"
                                    class="my-2 text-center w-full md:w-max px-8 py-1.5 text-xs font-bold tracking-wider text-white bg-yellow-500 rounded-full ">
                                    Followed - Click to unfollow
                                </button>
                            @endauth
                        </div>
                        <input id="writer_username" value={{ $writer->username_login }} hidden>
                        <div id="author_posts">
                            @include('client/data_posts_by_author')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- <div class="sm:px-0 lg:px-4 py-10 bg-gray-50 mx-2 my-3 rounded-md">
        <div class="container">
            <h1 class="text-2xl font-bold text-black mb-4">Subscribe this author</h1>
            <form class="sm:block md:flex" action="">
                <input class=" my-2 w-full w-2/3 mr-3 p-3 rounded-md border border-gray-300" type="email"
                    placeholder="Enter Your Email">
                <button
                    class="my-2 w-full md:w-max px-24 py-3 text-xs font-bold tracking-wider text-white bg-yellow-500 rounded-full hover:bg-white hover:text-yellow-500 hover:shadow-2xl transition duration-500 ease-in-out "
                    type="submit">SUBSCRIBE </button>
            </form>
        </div>
    </div> --}}
        <!--footer-->
        <footer>
            @include('templates/client/client_footer')
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
        <script src="{{ asset('js/plugin.js') }}"></script>
        <script src="{{ asset('js/follow.js') }}"></script>
        <script src="{{ asset('js/client_posts.js') }}"></script>
        <script>
            new Splide('.splide').mount();
        </script>
    </body>

    </html>

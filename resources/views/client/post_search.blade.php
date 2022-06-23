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
    <title>Search posts</title>
</head>

<body>
    @include('templates/client/client_header')
    <!--main cards-->
    <div style="padding-left: 17%;padding-right: 7%; display:flow-root;">
        <div class=" container lg:flex block" style="float: left;width:49%;">
            <div class="block my-20 " style="padding-right:20%; ">
                <div style="padding-right:12%; ">
                    <input value={{ $key }} id="key" hidden>
                    <h1 class=" text-gray-800 text-3xl">Found <b>{{ $listpost->total() }}</b> results for key: <i>
                            {{ $key }} </i></h1> <br>
                </div>
                {{-- <input id="category_name" value={{$category_name}} hidden> --}}
                <div id="search_posts">
                    @include('client/data_posts_search')
                </div>
                <br>
            </div>
        </div>
    </div>
    <!--footer-->
    <footer>
        @include('templates/client/client_footer')
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/client_posts.js') }}"></script>
    <script>
        new Splide('.splide').mount();
    </script>
</body>

</html>

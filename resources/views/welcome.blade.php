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
    <!--sidebar-->
    <div class="py-2 px-3 h-full shadow-md z-10 bg-white" id="sidebar">
      <p><i class="ri-close-fill text-4xl transition duration-300 ease-in-out hover:text-yellow-500" id="close_sidebar"></i></p>
      <ul>
        <li class="py-1.5 px-3 active "><a href="../index.html">Home</a></li>
        <li class="py-1.5 px-3 relative "><a href="../pug_files/category.html ">Categories</a><span class="absolute top-0 right-0 text-2xl text-gray-300 cursor-pointer " id="arrow"><i class="ri-arrow-down-circle-line "></i></span>
          <ul class="p-3 inner-list">
            @foreach ($categories as $category)
            <li class="py-1.5 px-3 "><a href="#">{{$category->categories}}</a></li>
            @endforeach
          </ul>
        </li>
      </ul>
    </div>
    <!--main navbar-->
    <nav class="border-b-2 border-gray-200">
      <div class="container"> 
        <div class="parent">
          <div class="md:flex py-5">
            <div class="md:w-1/2 w-full logo md:order-2 text-center "><a class="text-black text-xl font-bold" href="/">MAGDESIGN </a></div>
            <div class="md:w-1/4 w-full list md:order-3">
              <div class="flex justify-between">
                <ul class=" flex">
                  <li class="mx-2 "><a href="#"><span><i class="ri-twitter-fill"> </i></span></a></li>
                  <li class="mx-2 "><a href="#"><span><i class="ri-facebook-fill"> </i></span></a></li>
                  <li class="mx-2 "><a href="#"><span><i class="ri-instagram-line"> </i></span></a></li>
                  <li style="margin-left: 40px"><a href="{{ route('login') }}">login</li>
                </ul><a class="text-4xl" href="#" id="menu"><span><i class="ri-menu-fill transition duration-300 ease-in-out hover:text-yellow-500"></i></span></a>
              </div>
              
            </div>
            <div class="md:w-1/4 w-full search md:order-1">
              <form class="relative px-3 py-1 rounded-full border-2 border-gray-200"><span class="absolute top-1.5 text-gray-300 left-2.5 text-sm"><i class="ri-search-line"></i></span>
                <input class=" pl-6 w-full text-gray-600" type="search" placeholder="Search...">
              </form>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!--slider-->
    <div class="parent">
      <h1 class="mt-16 text-center text-4xl font-extrabold tracking-wide ">Newest</h1>
      <div class="slider my-20">
        <div class="splide">
          <div class="splide__track">
            <ul class="splide__list">
              @foreach ($post as $post)
              <li class="splide__slide">
                <div class="son lg:flex">
                  <div class="pic w-full lg:w-1/3 md:mr-10 "><img class="w-full rounded-md" src="{{ asset('/post/' . $post->photo) }}"></div>
                  <!--content-->
                  <div class="content w-full lg:w-2/3 mt-8">
                    <div class="top text-sm"><a class="font-bold" href="#">   
                      Travel, Food
                      </a><span class="text-gray-400">- {{$post->created_at}}</span></div>
                    <h2 class="mt-6 mb-3 text-4xl font-extrabold leading-sung tracking-wide"><a href="/post/{{ $post->url }}/detail_post">{{$post->title}}</a></h2>
                    <p class="text-gray-500 mt-2 text-md leading-sung tracking-wide">{{$post->content}}</p><a class="flex mt-8 " href="#">
                      <div class="author-pic w-16 mr-5"><img class="rounded-full" src="{{asset('/profile/' . $post->writer_avatar) }}"></div>
                      <div class="author-info mt-2"><strong class="block text-sm">{{$post->writer_name}}</strong><span class="text-xs font-light text-gray-500">CEO and Founder</span></div></a>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--main cards-->
    
    <div class="container md:flex flex-wrap justify-between">
      <div class="main_cards my-10">
        <div class="pic"><a href="../pug_files/related.html"> <img class="w-full rounded-md" src="{{ asset('/post/' . $post->photo) }}"></a></div>
        <div class="content">
          <div class="top text-sm mt-10"><a class="font-bold" href="#">Business, Travel </a><span class="text-gray-400">- July 2,2020</span></div>
          <h2 class="mt-3 mb-3 text-lg font-extrabold leading-sung tracking-wide"><a href="../pug_files/related.html">{{$post->title}}</a></h2>
          <p class="text-gray-500 mt-2 text-sm leading-sung tracking-wide">{{$post->content}}</p><a class="flex mt-10 " href="#">
            <div class="author-pic w-16 mr-5"><img class="rounded-full" src="{{asset('/profile/' . $post->writer_avatar) }}"></div>
            <div class="author-info mt-2"><strong class="block text-sm">{{$post->writer_name}}</strong><span class="text-xs font-light text-gray-500">CEO and Founder</span></div></a>
        </div>
      </div>
      
      
    </div>
    <div class=" container lg:flex block">
      <div class="block my-28">
        <h1 class="text-2xl font-extrabold mb-0">Sports</h1>
        <!--Bussiness cards-->
        <div class="parent ">
          <div class="business_cards md:flex block my-12">
            <div class="pic md:w-80 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md " src="../assets/home_cards/img_2.jpg"></div>
            <!--content-->
            <div class="content">
              <div class="top text-sm "><a class="font-bold" href="#">Business, Travel </a><span class="text-gray-400">- July 2,2020</span></div>
              <h2 class="pr-10"><a class="text-lg font-extrabold " href="../pug_files/related.html">Your most unhappy customers are your greatest source of learning.</a></h2><a class="flex mt-2" href="#">
                <div class="author-pic w-12 mr-5"><img class="rounded-full" src="../assets/slider1/person_1.jpg"></div>
                <div class="author-info mt-2"><strong class="block text-sm">Sergy Campbell</strong><span class="text-xs font-light text-gray-500">Author, 26 published post</span></div></a>
            </div>
          </div>
          <div class="business_cards md:flex block my-12">
            <div class="pic md:w-80 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md " src="../assets/home_cards/img_3.jpg"></div>
            <!--content-->
            <div class="content">
              <div class="top text-sm "><a class="font-bold" href="#">Business, Travel </a><span class="text-gray-400">- July 2,2020</span></div>
              <h2 class="pr-10"><a class="text-lg font-extrabold " href="../pug_files/related.html">Your most unhappy customers are your greatest source of learning.</a></h2><a class="flex mt-2" href="#">
                <div class="author-pic w-12 mr-5"><img class="rounded-full" src="../assets/slider1/person_1.jpg"></div>
                <div class="author-info mt-2"><strong class="block text-sm">Sergy Campbell</strong><span class="text-xs font-light text-gray-500">Author, 26 published post</span></div></a>
            </div>
          </div>
          <div class="business_cards md:flex block my-12">
            <div class="pic md:w-80 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md " src="../assets/home_cards/img_4.jpg"></div>
            <!--content-->
            <div class="content">
              <div class="top text-sm "><a class="font-bold" href="#">Business, Travel </a><span class="text-gray-400">- July 2,2020</span></div>
              <h2 class="pr-10"><a class="text-lg font-extrabold " href="../pug_files/related.html">Your most unhappy customers are your greatest source of learning.</a></h2><a class="flex mt-2" href="#">
                <div class="author-pic w-12 mr-5"><img class="rounded-full" src="../assets/slider1/person_1.jpg"></div>
                <div class="author-info mt-2"><strong class="block text-sm">Sergy Campbell</strong><span class="text-xs font-light text-gray-500">Author, 26 published post</span></div></a>
            </div>
          </div>
        </div>
      </div>
      <div class="block my-28">
        <h1 class="text-2xl font-extrabold">Business</h1>
        <!--Bussiness cards-->
        <div class="parent ">
          <div class="business_cards md:flex block my-12">
            <div class="pic md:w-80 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md " src="../assets/home_cards/img_2.jpg"></div>
            <!--content-->
            <div class="content">
              <div class="top text-sm "><a class="font-bold" href="#">Business, Travel </a><span class="text-gray-400">- July 2,2020</span></div>
              <h2 class="pr-10"><a class="text-lg font-extrabold " href="../pug_files/related.html">Your most unhappy customers are your greatest source of learning.</a></h2><a class="flex mt-2" href="#">
                <div class="author-pic w-12 mr-5"><img class="rounded-full" src="../assets/slider1/person_1.jpg"></div>
                <div class="author-info mt-2"><strong class="block text-sm">Sergy Campbell</strong><span class="text-xs font-light text-gray-500">Author, 26 published post</span></div></a>
            </div>
          </div>
          <div class="business_cards md:flex block my-12">
            <div class="pic md:w-80 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md " src="../assets/home_cards/img_3.jpg"></div>
            <!--content-->
            <div class="content">
              <div class="top text-sm "><a class="font-bold" href="#">Business, Travel </a><span class="text-gray-400">- July 2,2020</span></div>
              <h2 class="pr-10"><a class="text-lg font-extrabold " href="../pug_files/related.html">Your most unhappy customers are your greatest source of learning.</a></h2><a class="flex mt-2" href="#">
                <div class="author-pic w-12 mr-5"><img class="rounded-full" src="../assets/slider1/person_1.jpg"></div>
                <div class="author-info mt-2"><strong class="block text-sm">Sergy Campbell</strong><span class="text-xs font-light text-gray-500">Author, 26 published post</span></div></a>
            </div>
          </div>
          <div class="business_cards md:flex block my-12">
            <div class="pic md:w-80 w-full md:mb-0 mb-6 mr-3"><img class="w-full rounded-md " src="../assets/home_cards/img_4.jpg"></div>
            <!--content-->
            <div class="content">
              <div class="top text-sm "><a class="font-bold" href="#">Business, Travel </a><span class="text-gray-400">- July 2,2020</span></div>
              <h2 class="pr-10"><a class="text-lg font-extrabold " href="../pug_files/related.html">Your most unhappy customers are your greatest source of learning.</a></h2><a class="flex mt-2" href="#">
                <div class="author-pic w-12 mr-5"><img class="rounded-full" src="../assets/slider1/person_1.jpg"></div>
                <div class="author-info mt-2"><strong class="block text-sm">Sergy Campbell</strong><span class="text-xs font-light text-gray-500">Author, 26 published post</span></div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--footer-->
    <footer>
      <div class="sm:px-0 lg:px-4 py-10 bg-gray-50 mx-2 my-3 rounded-md">
        <div class="container">
          <h1 class="text-2xl font-bold text-black mb-4">Subscribe to newsletter</h1>
          <form class="sm:block md:flex" action="">
            <input class=" my-2 w-full w-2/3 mr-3 p-3 rounded-md border border-gray-300" type="email" placeholder="Enter Your Email">
            <button class="my-2 w-full md:w-max px-24 py-3 text-xs font-bold tracking-wider text-white bg-yellow-500 rounded-full hover:bg-white hover:text-yellow-500 hover:shadow-2xl transition duration-500 ease-in-out " type="submit">SUBSCRIBE </button>
          </form>
        </div>
      </div>
      <div class="container pb-10">
        <div class="social w-max mx-auto"><a class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-facebook-fill"></i></a><a class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-twitter-fill"></i></a><a class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-linkedin-fill"></i></a><a class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-youtube-fill"></i></a>
        </div>
        <p class="text-gray-400 my-10 text-center text-sm">Copyright ©2021 All rights reserved | This template is made with love by Colorlib</p>
        <p class="text-center"><a class="p-1 text-sm text-gray-400 border-b-4 border-transparent hover:border-2 hover:border-yellow-500 hover:text-black transition duration-500 ease-in-out " href="#">Terms & Conditions </a><span class="text-gray-400 text-xl px-1">/</span><a class="p-1 text-sm text-gray-400 border-b-4 border-transparent hover:border-2 hover:border-yellow-500 hover:text-black transition duration-500 ease-in-out " href="#">Privacy Policy </a></p>
      </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"> </script>
    <script src="js/plugin.js"> </script><script>new Splide( '.splide' ).mount();</script>
  </body>
</html>
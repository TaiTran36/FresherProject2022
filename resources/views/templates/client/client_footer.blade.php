{{-- <div class="sm:px-0 lg:px-4 py-10 bg-gray-50 mx-2 my-3 rounded-md">
    <div class="container">
        <h1 class="text-2xl font-bold text-black mb-4">Subscribe to newsletter</h1>
        <form class="sm:block md:flex" action="">
            <input class=" my-2 w-full w-2/3 mr-3 p-3 rounded-md border border-gray-300" type="email"
                placeholder="Enter Your Email">
            <button
                class="my-2 w-full md:w-max px-24 py-3 text-xs font-bold tracking-wider text-white bg-yellow-500 rounded-full hover:bg-white hover:text-yellow-500 hover:shadow-2xl transition duration-500 ease-in-out "
                type="submit">SUBSCRIBE </button>
        </form>
    </div>
</div> --}}
<?php use Rainwater\Active\Active;
Active::users();
?>

<div class="container pb-10">
    <?php
    $guests = Active::guests(1)->count(); //1 phut
    $users = Active::users(1)->count();
    ?>
        <p style="margin-left:10%; width:100%"> Online users: <b><i>{{ $users }}</b></i> <br> Guests:
            <b><i>{{ $guests }}</b></i>
        </p>
    <div class="social w-max mx-auto"><a
            class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out"
            href="#"><i class="ri-facebook-fill"></i></a><a
            class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out"
            href="#"><i class="ri-twitter-fill"></i></a><a
            class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out"
            href="#"><i class="ri-linkedin-fill"></i></a><a
            class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out"
            href="#"><i class="ri-youtube-fill"></i></a>
    </div>
    <p class="text-gray-400 my-10 text-center text-sm">Copyright © 2022-2026 Chainos . All rights reserved.</p>
    <p class="text-center"><a
            class="p-1 text-sm text-gray-400 border-b-4 border-transparent hover:border-2 hover:border-yellow-500 hover:text-black transition duration-500 ease-in-out "
            href="#">Terms & Conditions </a><span class="text-gray-400 text-xl px-1">/</span><a
            class="p-1 text-sm text-gray-400 border-b-4 border-transparent hover:border-2 hover:border-yellow-500 hover:text-black transition duration-500 ease-in-out "
            href="#">Privacy Policy </a></p>
</div>

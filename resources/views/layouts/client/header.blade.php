<nav class="navbar navbar-expand-md navbar-light bg-white">
    <div class="container">
        <div class="col-md-3 order-3 order-md-1">
            <form action="#" class="search-form">
                <i class="fa-solid fa-magnifying-glass pl-3 pr-2"></i>
                <input type="text" placeholder="Search...">
            </form>
        </div>

        <div class="col-md-6 text-center order-1 order-md-2 mb-3 mb-md-0">
            <a href="/" class="logo m-0 text-uppercase">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="col-md-3 text-end order-2 order-md-3 mb-3 mb-md-0">
            @auth
            <div class="d-flex">
                <img src="{{ asset('images/' . Auth::user()->photo_url) }}" class="image rounded-circle avatar mr-2"
                    alt="Image">
                <strong class="mt-3">{{ Auth::user()->username_login }}</strong>
            </div>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                {{ __('Log in') }}
            </a>
            @endauth
        </div>
    </div>
</nav>
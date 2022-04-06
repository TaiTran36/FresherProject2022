<nav class="navbar navbar-expand-md navbar-light bg-white p-2">
    <div class="container">
        <div class="col-md-3 order-3 order-md-1">
            <form action="#" class="search-form">
                <i class="fa-solid fa-magnifying-glass pl-3 pr-2"></i>
                <input type="text" placeholder="Search...">
            </form>
        </div>

        <div class="col-md-6 text-center order-1 order-md-2 mb-md-0">
            <a href="/" class="logo m-0 text-uppercase">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="col-md-3 offset-md-1 text-end order-2 order-md-3 mb-md-0 pl-5">
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <div class="d-flex">
                        <img src="{{ asset('images/' . Auth::user()->photo_url) }}" class="image rounded-circle avatar mt-0" alt="">

                        <li class="nav-item dropdown text-center">                        
                            <a id="navbarDropdown" class="nav-link dropdown-toggle mt-1" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username_login }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                                
                                @if (Auth::check() && Auth::user()->role == 3)
                                    <a class="dropdown-item" href="{{ route('post.create') }}">{{ __('Add post') }}</a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </div>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<style>
    /* Style the header with a grey background and some padding */
.header {
  overflow: hidden;
  background-color: white;
  padding: 10px 10px;
  height: 65px;
  border-bottom: 1px solid #e7e7e7;
}

/* Style the header links */
.header a {
  float: left;
  color: black;
  text-align: center;
  text-decoration: none;
  line-height: 25px;
  border-radius: 4px;
}

/* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
.header a.logo {
  font-size: 200%;
  font-weight: bold;
  padding-left: 15px;
  padding-top: 10px;
}

/* Change the background color on mouse-over */
.header a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the active/current link*/
.header a.active {
  background-color: dodgerblue;
  color: white;
}

/* Float the link section to the right */
.header-right {
  float: right;
  padding-right: 3%;
}

/* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  .header-right {
    float: none;
  }
}

</style>
<div class="header">
    <a href="#default" class="logo">Laravel Project</a>
    <div class="header-right">
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
            {{-- <img style="width:10%;height:10%" src="{{asset('/profile/'.Auth::user()->avatar)}}" class="rounded-circle" alt="User Image"> --}}
            <a>
                {{ Auth::user()->username_login }}
            </a> <br>
            <a>
                {{ Auth::user()->email }}
            </a>
    @endguest
    </div>
  </div>
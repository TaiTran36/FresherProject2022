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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/css/main.css">
  </head>
  <body>
    <!--sidebar-->
    <div class="py-2 px-3 h-full shadow-md z-10 bg-white" id="sidebar">
      <p><i class="ri-close-fill text-4xl transition duration-300 ease-in-out hover:text-yellow-500" id="close_sidebar"></i></p>
      <ul>
        <li class="py-1.5 px-3 active "><a href="#">Home</a></li>
        <li class="py-1.5 px-3 relative "><a href="../pug_files/category.html ">Categories</a><span class="absolute top-0 right-0 text-2xl text-gray-300 cursor-pointer " id="arrow"><i class="ri-arrow-down-circle-line "></i></span>
          <ul class="p-3 inner-list">
            
            @foreach ($categories as $category)
              <li class="py-1.5 px-3 "><a href="/category/{{ $category->categories }}/posts">{{$category->categories}}</a></li>
            @endforeach
              
            
            
          </ul>
        </li>
        @if (Route::has('login'))
          @auth
            @if (Auth::user()->can('all user'))
              <li class="py-1.5 px-3 "><a href="{{ route('home') }}">Admin</a></li>
            @endif
              <li class="py-1.5 px-3 "><a href="/profile/{{ auth()->user()->id }}/details">Profile</a></li>

          @endauth
        @endif
          
        @if (Route::has('login'))
             @auth
                 <li class="py-1.5 px-3"><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout <i class="fa fa-sign-out"></i> </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                  </form>
                </li>
             
             @endauth
         @endif
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
                  <div>
                    @if (Route::has('login'))
                      @auth
                      <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                          <li class="nav-item dropdown open" style="padding-left: 15px;">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                
                                <img width="50" onerror="this.src='/storage/image_err/no-image.jpg'" src="/profile/<?php echo auth()->user()->avatar; ?>" alt="">
                                
                                
                                    <span><?php echo auth()->user()->name; ?></span>
                                    
                                
                            </a>
                        
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"  href="javascript:;"> Profile</a>
                                <a class="dropdown-item"  href="javascript:;">
                                    <span>Settings</span>
                                </a>
                                <a class="dropdown-item"  href="javascript:;">Help</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout <i class="fa fa-sign-out"></i> </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>
                            </div>
                        </li>
                
                            
                        </ul>
                    </nav>
                      
                
                        
                      @else
                        <div style="margin-left: 30px">
                          <button class="button-7" role="button">
                          <a  href="{{ route('login') }}">Log in</a>
                        </button>
                        
                          <button class="button-7" role="button">
                          <a  href="{{ route('register') }}">Register</a>
                        </button>
                        
                        </div>
                      @endauth
                  @endif
                  </div>
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
    
    <div>
    @yield('content')
    </div>


    <footer>
        <div class="sm:px-0 lg:px-4 py-10 bg-gray-50 mx-2 my-3 rounded-md">
          <div class="container">
            <h1 class="text-2xl font-bold text-black mb-4">Subscribe to newsletter</h1>
            <form class="sm:block md:flex" action="">
              <input class=" my-2 w-full w-2/3 mr-3 p-3 rounded-md border border-gray-300" type="email" placeholder="Enter Your Email">
              <button class="button-49 " type="submit">SUBSCRIBE </button>
            </form>
          </div>
        </div>
        <div class="container pb-10">
          <div class="social w-max mx-auto"><a class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-facebook-fill"></i></a><a class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-twitter-fill"></i></a><a class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-linkedin-fill"></i></a><a class="p-3 bg-gray-300 m-2 rounded-lg text-xl hover:text-white hover:bg-yellow-500 transition duration-500 ease-in-out" href="#"><i class="ri-youtube-fill"></i></a>
          </div>
          <p class="text-gray-400 my-10 text-center text-sm"> Copyright © 2022-2026 Chainos. All rights reserved.</p>
          <p class="text-center"><a class="p-1 text-sm text-gray-400 border-b-4 border-transparent hover:border-2 hover:border-yellow-500 hover:text-black transition duration-500 ease-in-out " href="#">Terms & Conditions </a><span class="text-gray-400 text-xl px-1">/</span><a class="p-1 text-sm text-gray-400 border-b-4 border-transparent hover:border-2 hover:border-yellow-500 hover:text-black transition duration-500 ease-in-out " href="#">Privacy Policy </a></p>
        </div>
      </footer>
      {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog odal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Đăng nhập ngay</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="login-form" method="POST" action="{{ route('login') }}" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="email" value="{{ __('Email') }}"></label>
                        <input type="email" id="email"  placeholder="Email" class="form-control" name="email" :value="old('email')" required autocomplete="email" autofocus />
    
                      </div>
                <div class="form-group">
                    <label for="password" value="{{ __('Password') }}"></label>
    
                    <input type="password" id="password"  placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary submit px-3">{{ __('Log in') }}</button>
                </div>
             </form>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- jQuery -->
      <script src="/vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!-- FastClick -->
      <script src="/vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="/vendors/nprogress/nprogress.js"></script>
      <!-- Chart.js -->
      <script src="/vendors/Chart.js/dist/Chart.min.js"></script>
      <!-- gauge.js -->
      <script src="/vendors/gauge.js/dist/gauge.min.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- iCheck -->
      <script src="/vendors/iCheck/icheck.min.js"></script>
      <!-- Skycons -->
      <script src="/vendors/skycons/skycons.js"></script>
      <!-- Flot -->
      <script src="/vendors/Flot/jquery.flot.js"></script>
      <script src="/vendors/Flot/jquery.flot.pie.js"></script>
      <script src="/vendors/Flot/jquery.flot.time.js"></script>
      <script src="/vendors/Flot/jquery.flot.stack.js"></script>
      <script src="/vendors/Flot/jquery.flot.resize.js"></script>
      <!-- Flot plugins -->
      <script src="/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
      <script src="/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
      <script src="/vendors/flot.curvedlines/curvedLines.js"></script>
      <!-- DateJS -->
      <script src="/vendors/DateJS/build/date.js"></script>
      <!-- JQVMap -->
      <script src="/vendors/jqvmap/dist/jquery.vmap.js"></script>
      <script src="/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
      <script src="/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="/vendors/moment/min/moment.min.js"></script>
      <script src="/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"> </script>
      <script src="/js/plugin.js"> </script>
      <script src="/js/like.js"> </script>
      <script src="/js/admin.js"></script>

      <script>new Splide( '.splide' ).mount();</script>
    </body>
  </html>
  <script>

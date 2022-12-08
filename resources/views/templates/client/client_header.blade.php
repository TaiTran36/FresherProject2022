<!--sidebar-->
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css"
    href="https://skywalkapps.github.io/bootstrap-notifications/stylesheets/bootstrap-notifications.css">
<div class="py-2 px-3 h-full shadow-md z-10 bg-white" id="sidebar">
    <p><i class="ri-close-fill text-4xl transition duration-300 ease-in-out hover:text-yellow-500" id="close_sidebar"></i>
    </p>
    <ul>
        <li class="py-1.5 px-3 active "><a href="/"><i class="fa fa-home" style="font-size:130%"></i>
                &nbsp;Home</a></li>
        <li class="py-1.5 px-3 relative "><a id="arrow"><i class="fa fa-list-alt" style="font-size:90%"></i> &nbsp;
                Categories</a><span class="absolute top-0 right-0 text-2xl text-gray-300 cursor-pointer "
                id="arrow"><i class="ri-arrow-down-circle-line "></i></span>
            <ul class="p-3 inner-list" style="padding-left: 8%">
                @foreach ($categories as $category)
                    <li class="py-1.5 px-3 "><a href="/category/{{ $category->name }}/posts"><i class="fa fa-circle"
                                style="font-size:60%"></i> &nbsp; {{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
        @if (Route::has('login'))
            @auth
                <li class="py-1.5 px-3"><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"
                            style="font-size:90%"></i><span> &nbsp; Dashboard</span></a></li>
                <li class="py-1.5 px-3"> <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> <span class="nav-label"> &nbsp; Logout</span></a> </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <li class="py-1.5 px-3 relative "> <a href="{{ route('login') }}">Log in</a></li>
                @if (Route::has('register'))
                    <li class="py-1.5 px-3 relative "> <a href="{{ route('register') }}">Register</a></li>
                @endif
            @endauth
        @endif
    </ul>
</div>
<!--main navbar-->
@auth
    <input id="user_id" name="user_id" value={{ Auth::user()->id }} hidden>
@endauth
<nav class="border-b-2 border-gray-200"  style="background-color:#ffd190">
    <div class="container">
        <div class="parent">
            <div class="md:flex py-5">
                <div class="md:w-1/2 w-full logo md:order-2 text-center "><a class="text-black text-xl font-bold"
                        href="/">Laravel Project</a></div>
                <div class="md:w-1/4 w-full list md:order-3">
                    <div class="flex justify-between">
                        <ul class=" flex">
                            {{-- @auth
                                <li class="dropdown dropdown-notifications">
                                    <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                                        <i data-count="0" class="fa fa-bell notification-icon"></i>
                                    </a>

                                    <div class="dropdown-container">
                                        <div class="dropdown-toolbar">
                                            <div class="dropdown-toolbar-actions">
                                                <a href="#">Mark all as read</a>
                                            </div>
                                            <h3 class="dropdown-toolbar-title">Notifications (<span
                                                    class="notif-count">0</span>)</h3>
                                        </div>
                                        <ul class="dropdown-menu">
                                        </ul>
                                        <div class="dropdown-footer text-center">
                                            <a href="#">View All</a>
                                        </div>
                                    </div>
                                </li>
                            @endauth --}}
                        </ul>
                        @auth
                            <a class="mx-2 " href="/profile/{{ Auth::user()->id }}/details">
                                {{ Auth::user()->username_login }}
                            </a>
                        @endauth
                        <a class="text-4xl" href="#" id="menu"><span><i
                                    class="ri-menu-fill transition duration-300 ease-in-out hover:text-yellow-500"></i></span></a>
                    </div>

                </div>
                <div class="md:w-1/4 w-full search md:order-1">
                    <form class="relative px-3 py-1 rounded-full border-2 border-gray-200" style="background-color: white;"
                        action="{{ url('/post/client_search') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
                        <span class="absolute top-1.5 text-gray-300 left-2.5 text-sm"><i
                                class="ri-search-line"></i></span>
                        <input class="pl-6 w-full text-gray-600" id="client_search" name="client_search" type="text"
                            placeholder="Search for title...">
                        {{-- <input type="submit" hidden /> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
@auth
    {{-- <script type="text/javascript">
        var notificationsWrapper = $('.dropdown-notifications');
        var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
        var notificationsCountElem = notificationsToggle.find('i[data-count]');
        var notificationsCount = parseInt(notificationsCountElem.data('count'));
        var notifications = notificationsWrapper.find('ul.dropdown-menu');


        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var user_id = $("#user_id").val();
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: 'ap1',
            encrypted: true
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('Notify');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('new_notify_' + user_id, function(data) {
            var existingNotifications = notifications.html();
            var newNotificationHtml = `
          <li class="notification active">
              <div class="media">
                <div class="media-left">
                  <div class="media-object">
                    <img src="{{ asset('/profile/` + data.writer_avatar+`) }}" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                  </div>
                </div>
                <div class="media-body">
                  <a href="post/` + data.url +
                `/client_details" class="notification-desc"><strong class="notification-title">` + data
                .writer_name + `recently posted new post:` + data.title + `</strong></a>
                  <div class="notification-meta">
                    <small class="timestamp">about a minute ago</small>
                  </div>
                </div>
              </div>
          </li>
        `;
            notifications.html(newNotificationHtml + existingNotifications);
            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
        });
    </script> --}}
@endauth
<!--slider-->

    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"
            id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="{{ asset('css/sidebar.css') }}" type="text/css" rel="stylesheet" />

    </head>
    <div class="main">
        <aside>
            <div class="sidebar left ">

                <div class="user-role">
                    @role('admin')
                        <p> Admin</p>
                    @endrole
                    @role('modder')
                        <p> Modder</p>
                    @endrole
                    @unlessrole('admin|modder')
                        <p> Normal User</p>
                    @endunlessrole
                </div>

                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ asset('/profile/' . Auth::user()->avatar) }}" class="rounded-circle"
                            alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo auth()->user()->username_login; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <ul class="list-sidebar bg-defoult">
                    @can('all user')
                        <li class="{{ request()->is('profile/list') ? 'li_active' : '' }}"> <a href="/profile/list"><i
                                    class="fa fa-user"></i> <span class="nav-label">Users</span></a> </li>
                    @else
                        <li class="{{ request()->is('profile/' . Auth::user()->id . '/details') ? 'li_active' : '' }}"> <a
                                href="/profile/{{ Auth::user()->id }}/details"><i class="fa fa-user"></i> <span
                                    class="nav-label">My Profile</span></a> </li>
                    @endcan
                    <li class="{{ request()->is('post/list') ? 'li_active' : '' }}"> <a href="/post/list"><i
                                class="fa fa-sticky-note-o"></i> <span class="nav-label">Posts</span></a> </li>
                    <li> <a href="#"><i class="fa fa-search"></i> <span class="nav-label">Search</span></a> </li>
                    <li> <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Setting</span></a>
                    </li>
                    <li class="li_end"> <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a> </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <li>
                    </li>

                </ul>
            </div>
        </aside>
    </div>
    <script>
        $(document).ready(function() {
            $('.button-left').click(function() {
                $('.sidebar').toggleClass('fliph');
            });

        });
    </script>

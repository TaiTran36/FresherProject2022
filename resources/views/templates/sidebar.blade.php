<?php use Rainwater\Active\Active;
Active::users();
?>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="{{ asset('css/sidebar.css') }}" type="text/css" rel="stylesheet" />
</head>
<div id="sidebar" class="main">
    <aside>
        <div class="sidebar left ">

            <div class="user-role" style="background-color: rgb(60, 59, 56)">
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
            <div class="user-panel" onclick="window.location='/profile/{{ Auth::user()->id }}/details'">
                <div class="pull-left image">
                    <img src="{{ asset('/profile/' . Auth::user()->avatar) }}"
                        onerror="this.src='/profile/error_img/not_found.png'" class="rounded-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo auth()->user()->username_login; ?></p>
                    <a><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class="list-sidebar bg-defoult">
                @can('all user')
                    <li class="{{ request()->is('profile/*') ? 'li_active' : '' }}"> <a id="users"
                            href="/profile/list"><i class="fa fa-user"></i> <span class="nav-label">Users</span></a> </li>
                @else
                    <input hidden value="{{ Auth::user()->id }}" id="user_id">
                    <li id="my_profile"
                        class="{{ request()->is('profile/' . Auth::user()->id . '/details') ? 'li_active' : '' }}"> <a
                            href="/profile/{{ Auth::user()->id }}/details"><i class="fa fa-user"></i> <span
                                class="nav-label">My Profile</span></a> </li>
                @endcan
                @role('admin|modder')
                    <li class="{{ request()->is('category/*') ? 'li_active' : '' }}"> <a id="categories"
                            href="/category/list"><i class="fa fa-list-alt"></i> <span
                                class="nav-label">Categories</span></a> </li>
                @endrole
                <li class="{{ request()->is('post/*') ? 'li_active' : '' }}"> <a id="posts" href="/post/list"><i
                            class="fa fa-sticky-note-o"></i> <span class="nav-label">Posts</span></a> </li>
                <li> <a href="/"><i class="fa fa-home"></i> <span class="nav-label">Client View</span></a>
                </li>
                <?php
                $guests = Active::guests(1)->count(); //1 phut
                $users = Active::users(1)->count();
                ?>
                <li class="li_end"
                    style="border-top:0.5px solid #FFFFFF;width:14.5%;color:white; background-color: rgb(60, 59, 56)">
                    <br>
                    <p style="margin-left:10%; width:100%"> Online users: <b><i>{{ $users }}</b></i> <br> Guests:
                        <b><i>{{ $guests }}</b></i>
                    </p>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <li>
                </li>

            </ul>
        </div>
    </aside>
</div>
<script src="{{ asset('js/sidebar.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.button-left').click(function() {
            $('.sidebar').toggleClass('fliph');
        });
    });
</script>

    <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="{{ asset('css/sidebar.css') }}" type="text/css" rel="stylesheet"/>
    <style>
    
    @import "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css";
    @import url('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700');
    .sidebar{width:220px; background-color:#000; height:100vh ; transition: all 0.5s  ease-in-out }
    .bg-defoult{background-color:#222;}
    .sidebar ul{ list-style:none; margin:0px; padding:0px; }
    .sidebar li a,.sidebar li a.collapsed.active{ display:block; padding:8px 12px; color:#fff;border-left:0px solid #dedede;  text-decoration:none}
    .sidebar li a.active{background-color:#000;border-left:5px solid #dedede; transition: all 0.5s  ease-in-out}
    .sidebar li a:hover{background-color:#000 !important;}
    .sidebar li a i{ padding-right:5px;}
    .sidebar ul li .sub-menu li a{ position:relative}
    .sidebar ul li .sub-menu li a:before{
        font-family: FontAwesome;
        content: "\f105";
        display: inline-block;
        padding-left: 0px;
        padding-right: 10px;
        vertical-align: middle;
    }
    .sidebar ul li .sub-menu li a:hover:after {
        content: "";
        position: absolute;
        left: -5px;
        top: 0;
        width: 5px;
        background-color: #111;
        height: 100%;
    }
    .sidebar ul li .sub-menu li a:hover{ background-color:#222; padding-left:20px; transition: all 0.5s  ease-in-out}
    .sub-menu{ border-left:5px solid #dedede;}
        .sidebar li a .nav-label,.sidebar li a .nav-label+span{ transition: all 0.5s  ease-in-out}
        
    
        .sidebar.fliph li a .nav-label,.sidebar.fliph li a .nav-label+span{ display:none;transition: all 0.5s  ease-in-out}
        .sidebar.fliph {
        width: 42px;transition: all 0.5s  ease-in-out;
       
    }
        
    .sidebar.fliph li{ position:relative}
    .sidebar.fliph .sub-menu {
        position: absolute;
        left: 39px;
        top: 0;
        background-color: #222;
        width: 150px;
        z-index: 100;
    }
        
    
        .user-panel {
        clear: left;
        display: block;
        float: left;
    }
    .user-panel>.image>img {
        width: 100%;
        max-width: 45px;
        height: auto;
    }
    .user-panel>.info,  .user-panel>.info>a {
        color: #fff;
    }
    .user-panel>.info>p {
        font-weight: 600;
        margin-bottom: 9px;
    }
    .user-panel {
        clear: left;
        display: block;
        float: left;
        width: 100%;
        margin-bottom: 15px;
        padding: 25px 15px;
        border-bottom: 1px solid;
    }
    .user-role {
        padding-left: 15px;
        padding-top:5px;
        font-size:150%;
        color: #fff;
        border-bottom: 1px solid rgb(177, 177, 177);
    }
    .user-panel>.info {
        padding: 5px 5px 5px 15px;
        line-height: 1;
        position: absolute;
        left: 55px;
    }
    .li_end{
      position: fixed;   
      bottom: 0;
    }
    
    .fliph .user-panel{ display: none; }

    </style>
    </head>
    <div class="main">
    <aside>
      <div class="sidebar left ">

          <div class="user-role">
            <p>Admin</p>
          </div>

        <div class="user-panel">
          <div class="pull-left image">
            {{-- <img src="{{Auth::user()->avatar)}}" class="rounded-circle" alt="User Image"> --}}
            <img src="https://www.w3schools.com/images/w3schools_green.jpg" class="rounded-circle" alt="User Image">         
          </div>
          <div class="pull-left info">
            <p><?php echo auth()->user()->username_login; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <ul class="list-sidebar bg-defoult">
       
      @can('all user')
      <li> <a href="/profile"><i class="fa fa-user"></i> <span class="nav-label">Users</span></a> </li>
      @else
      <li> <a href="/profile/{{Auth::user()->id}}/details"><i class="fa fa-user"></i> <span class="nav-label">My Profile</span></a> </li>
      @endcan
      <li> <a href="/post"><i class="fa fa-sticky-note-o"></i> <span class="nav-label">Posts</span></a> </li>
      <li> <a href="#"><i class="fa fa-search"></i> <span class="nav-label">Search</span></a> </li>
      <li> <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Setting</span></a> </li>
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
$(document).ready(function(){
$('.button-left').click(function(){
   $('.sidebar').toggleClass('fliph');
});
 
});
</script>
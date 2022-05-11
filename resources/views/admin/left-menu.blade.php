
<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img  onerror="this.src='/storage/image_err/no-image.jpg'" src="/profile/<?php echo auth()->user()->avatar; ?>" class="img-circle profile_img"/> 
    </div>
    <div class="profile_info">
        <span>Welcome</span>
        <p><?php echo auth()->user()->name; ?></p>
    </div>
</div>
<!-- /menu profile quick info -->

<br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        @role("admin")
            <div style="margin-left: 10px"><i class="fa fa-user-secret" aria-hidden="true">Admin</i></div>
        @endrole
        
       
        <ul class="nav side-menu">
            <li><a href="../home"><i class="fa fa-home"></i> Manage </a></li>
            
            @if (Auth::user()->can('all user'))
            <li class="{{ request()->is('profile/list') ? 'li_active' : '' }}"> <a href="/profile/list"><i class="fa fa-user"></i>User Manage</a></li>  
            
            @endif                 
            <li class="{{ request()->is('post/list') ? 'li_active' : '' }}"> <a href="/post/list"><i class="fa fa-pencil"></i>Post Manage</a></li>
            <li> <a href="/"><i class="fa fa-pencil"></i>Home</a></li>

                          
    </div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" >
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
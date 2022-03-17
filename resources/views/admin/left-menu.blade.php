
<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img  onerror="this.src='/storage/image_err/no-image.jpg'" src="/storage/images/" class="img-circle profile_img"/> 
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2><?=$user->name?></h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        
        <i class="fa fa-user-secret" aria-hidden="true"></i>Admin
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Manage <span class="fa fa-chevron-down"></span></a>
                
                    
                    <li><a href="{{route('listing.index',['model'=>'Users'])}}">User Manage</a></li>                   
                    <li><a href="{{route('listing.index',['model'=>'Posts'])}}">Post Manage</a></li>
                    
                
                
            </li>
            
                
            </li>
            
            
            
            
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
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
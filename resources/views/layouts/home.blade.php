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
        <link rel="icon" href="images/favicon.ico" type="image/ico" />
        <link href="/css/main.css" rel="stylesheet">
        

        <title>ADMIN </title>

        <!-- Bootstrap -->
        <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="/css/admin.css" rel="stylesheet">


    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="container">

                <!-- top navigation -->
                <div class="top_nav">
                    @include('home.top-nav')   
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    @yield('content')
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer >
                    
                        Copyright © 2022-2026 Chainos. All rights reserved.
                      
                    
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

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

        <!-- Custom Theme Scripts -->
        <script src="/js/admin.js"></script>

    </body>
</html>




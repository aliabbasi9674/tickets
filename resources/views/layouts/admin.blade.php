<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="FT Technologies Private Limited">
    <meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
    <!-- Title -->
    <title> پنل مدیریت تیکت آپارتمانا</title>
    <!-- Favicon -->
    <link rel="icon" href="/home/assets/img/logo.png" type="image/x-icon"/>
    <!-- Icons css -->
    <link href="/admin/assets/css/icons.css" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="/admin/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"/>
    <!--  Sidebar css -->
    <link href="/admin/assets/plugins/sidebar/sidebar.css" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="/admin/assets/css-rtl/sidemenu.css">
    <!--  Owl-carousel css-->
    <link href="/admin/assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />
    <!-- Maps css -->
    <link href="/admin/assets/plugins/jqvmap/jqvmap.min.css" rel="stylesheet">
    <!--- Style css -->
    <link href="/admin/assets/css-rtl/style.css" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="/admin/assets/css-rtl/style-dark.css" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="/admin/assets/css-rtl/skin-modes.css" rel="stylesheet">

    <!---Switcher css-->
    <link href="/admin/assets/switcher/css/switcher-rtl.css" rel="stylesheet">
    <link href="/admin/assets/switcher/demo.css" rel="stylesheet">
    @yield('css')
</head>

<body class="main-body app sidebar-mini">



<!-- Loader -->
<div id="global-loader">
    <img src="/admin/assets/img/loader.svg" class="loader-img" alt="لودر">
</div>
<!-- /Loader -->
<!-- main-sidebar -->
@include('include.admin.main-sidebar')
<!-- main-sidebar -->

<!-- main-content -->
<div class="main-content app-content">
    <!-- main-header opened -->
    <div class="main-header sticky side-header nav nav-item">
        <div class="container-fluid">
            <div class="main-header-left ">
                <div class="responsive-logo">
                    <a href="index.html"><img src="/home/assets/img/logo.png" class="logo-1" alt="لوگو"></a>
                </div>
                <div class="app-sidebar__toggle" data-toggle="sidebar">
                    <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                    <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
                </div>
                <div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
                    <input class="form-control" placeholder="هر چیزی را جستجو کنید ..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
                </div>
            </div>
            <div class="main-header-right">
                <div class="nav nav-item  navbar-nav-right ml-auto">
                    <div class="dropdown main-profile-menu nav nav-item nav-link">
                        <a class="profile-user d-flex" href="#"><img  alt="{{auth()->user()->Name}}" @if(auth()->user()->Avatar)  src="{{env('APP_URL_API').auth()->user()->Avatar}}" @else  src="/home/assets/img/faces/icon-user.png" @endif></a>
                        <div class="dropdown-menu">
                            <div class="main-header-profile bg-primary p-3">
                                <div class="d-flex wd-100p">
                                    <div class="main-img-user"><img  alt="{{auth()->user()->Name}}" @if(auth()->user()->Avatar)  src="{{env('APP_URL_API').auth()->user()->Avatar}}" @else  src="/home/assets/img/faces/icon-user.png" @endif class=""></div>
                                    <div class="mr-3 my-auto">
                                        <h6>{{auth()->user()->Name}}</h6><span>مدیریت</span>
                                    </div>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{route('admin.profile.index')}}"><i class="bx bx-user-circle"></i>مشخصات</a>
                            <a class="dropdown-item"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{route('logout')}}"><i class="bx bx-log-out"></i> خروج از پنل مدیریت</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /main-header -->

    <!-- container -->
    <div class="container-fluid">
        @yield('content')
    </div>
</div>
<!-- Container closed -->
<!-- Footer opened -->
<div class="main-footer ht-40">
    <div class="container-fluid pd-t-0-f ht-100p">
        <span>کپی رایت © 2020 <a href="#">تیکت</a> . طراحی شده توسط <a href="#">آپارتمانا</a> کلیه حقوق محفوظ است.</span>
    </div>
</div>
<!-- Footer closed -->
<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="/admin/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Bundle js -->
<script src="/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ionicons js -->
<script src="/admin/assets/plugins/ionicons/ionicons.js"></script>
<!-- Moment js -->
<script src="/admin/assets/plugins/moment/moment.js"></script>

<!-- Rating js-->
<script src="/admin/assets/plugins/rating/jquery.rating-stars.js"></script>
<script src="/admin/assets/plugins/rating/jquery.barrating.js"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/admin/assets/plugins/perfect-scrollbar/p-scroll.js"></script>
<!--Internal Sparkline js -->
<script src="/admin/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- Custom Scroll bar Js-->
<script src="/admin/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- right-sidebar js -->
<script src="/admin/assets/plugins/sidebar/sidebar-rtl.js"></script>
<script src="/admin/assets/plugins/sidebar/sidebar-custom.js"></script>
<!-- Eva-icons js -->
<script src="/admin/assets/js/eva-icons.min.js"></script>
<!--Internal  Chart.bundle js -->
<script src="/admin/assets/plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Moment js -->
<script src="/admin/assets/plugins/raphael/raphael.min.js"></script>
<!--Internal  Flot js-->
<script src="/admin/assets/plugins/jquery.flot/jquery.flot.js"></script>
<script src="/admin/assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
<script src="/admin/assets/plugins/jquery.flot/jquery.flot.resize.js"></script>
<script src="/admin/assets/plugins/jquery.flot/jquery.flot.categories.js"></script>
<script src="/admin/assets/js/dashboard.sampledata.js"></script>
<script src="/admin/assets/js/chart.flot.sampledata.js"></script>
<!--Internal Apexchart js-->
<script src="/admin/assets/js/apexcharts.js"></script>
<!-- Internal Map -->
<script src="/admin/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/admin/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="/admin/assets/js/modal-popup.js"></script>
<!--Internal  index js -->
<script src="/admin/assets/js/index.js"></script>
<script src="/admin/assets/js/jquery.vmap.sampledata.js"></script>
<!-- Sticky js -->
<script src="/admin/assets/js/sticky.js"></script>
<!-- custom js -->
<script src="/admin/assets/js/custom.js"></script><!-- Left-menu js-->
<script src="/admin/assets/plugins/side-menu/sidemenu.js"></script>

<!-- Switcher js -->
<script src="/admin/assets/switcher/js/switcher-rtl.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@include('sweet::alert')
@yield('js')
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
          content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
    <!-- Title -->
    <title>پنل تیکت آپارتمانا </title>
    <!-- Favicon -->
    <link rel="icon" href="/home/assets/img/logo.png" type="image/x-icon"/>
    <!-- Icons css -->
    <link href="/home/assets/css/icons.css" rel="stylesheet">
    <!--  Right-sidemenu css -->
    <link href="/home/assets/plugins/sidebar/sidebar.css" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="/home/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"/>
    <!--- Style css-->
    <link href="/home/assets/css-rtl/style.css" rel="stylesheet">

    <!-- Morris.js Charts Plugin -->
    <link href="/home/assets/plugins/morris.js/morris.css" rel="stylesheet"/>
    <!---Skinmodes css-->
    <link href="/home/assets/css-rtl/skin-modes.css" rel="stylesheet"/>
    <!--- Animations css-->
    <link href="/home/assets/css/animate.css" rel="stylesheet">

    <!---Switcher css-->
    <link href="/home/assets/switcher/css/switcher-rtl.css" rel="stylesheet">
    @yield('css')
</head>

<body class="main-body">


<!-- Loader -->
<div id="global-loader">
    <img src="/home/assets/img/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->
<!-- main-header opened -->
<div class="main-header nav nav-item hor-header">
    <div class="container">
        <div class="main-header-left ">
            <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a><!-- sidebar-toggle-->
            <a class="header-brand" href="{{route('home.tickets.index')}}">
                <img src="/home/assets/img/brand/logo.png" class="desktop-logo">
            </a>
            <div class="main-header-center  mr-4">
                <input class="form-control" placeholder="جستجو..." type="search">
                <button class="btn"><i class="fe fe-search"></i></button>
            </div>
        </div><!-- search -->
        <div class="main-header-right">

            <div class="dropdown main-profile-menu nav nav-item nav-link">
                <a class="profile-user d-flex" href="#"> @include('include.home.avatar')</a>
                <div class="dropdown-menu">
                    <div class="main-header-profile bg-primary p-3">
                        <div class="d-flex wd-100p">
                            <div class="main-img-user"> @include('include.home.avatar')</div>
                            <div class="mr-3 my-auto">
                                <h6>{{auth()->user()->Name}}</h6><span>پروفایل</span>
                            </div>
                        </div>
                    </div>
                    <a class="dropdown-item" href="{{route('home.user.info')}}"><i class="bx bx-user-circle"></i>مشخصات</a>
                    <a class="dropdown-item"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{route('logout')}}"><i class="bx bx-log-out"></i> خروج از سیستم</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /main-header -->
<!--Horizontal-main -->
@include('include.home.header')
<!--Horizontal-main -->
<!-- main-content opened -->
<div class="main-content horizontal-content">
    <!-- container opened -->
    <div class="container">
        @yield('content')
    </div>
</div>
<!-- Container closed -->
<!-- Message Modal -->
<div class="modal fade" id="chatmodel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-right chatbox" role="document">
        <div class="modal-content chat border-0">
            <div class="card overflow-hidden mb-0 border-0">
                <!-- action-header -->
                <div class="action-header clearfix">
                    <div class="float-right hidden-xs d-flex ml-2">
                        <div class="img_cont ml-3">
                            <img src="/home/assets/img/faces/6.jpg" class="rounded-circle user_img" alt="img">
                        </div>
                        <div class="align-items-center mt-2">
                            <h4 class="text-white mb-0 font-weight-semibold">دنیل اسکات</h4>
                            <span class="dot-label bg-success"></span><span class="mr-3 text-white">آنلاین</span>
                        </div>
                    </div>
                    <ul class="ah-actions actions align-items-center">
                        <li class="call-icon">
                            <a href="#" class="d-done d-md-block phone-button" data-toggle="modal"
                               data-target="#audiomodal">
                                <i class="si si-phone"></i>
                            </a>
                        </li>
                        <li class="video-icon">
                            <a href="#" class="d-done d-md-block phone-button" data-toggle="modal"
                               data-target="#videomodal">
                                <i class="si si-camrecorder"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" aria-expanded="true">
                                <i class="si si-options-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><i class="fa fa-user-circle"></i> مشاهده نمایه</li>
                                <li><i class="fa fa-users"></i>دوستان اضافه کنید</li>
                                <li><i class="fa fa-plus"></i> افزودن به گروه</li>
                                <li><i class="fa fa-ban"></i> مسدود کردن</li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="" data-dismiss="modal" aria-label="بستن">
                                <span aria-hidden="true"><i class="si si-close text-white"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- action-header end -->

                <!-- msg_card_body -->
                <div class="card-body msg_card_body">
                    <div class="chat-box-single-line">
                        <abbr class="timestamp">1 مهر 1399</abbr>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="img_cont_msg">
                            <img src="/home/assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
                        </div>
                        <div class="msg_cotainer">
                            سلام ، حال شما چطور است؟
                            <span class="msg_time">8:40 صبح ، امروز</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end ">
                        <div class="msg_cotainer_send">
                            سلام کانر پیج هستم من خوبم شما چطور؟
                            <span class="msg_time_send">8:55 صبح ، امروز</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="/home/assets/img/faces/9.jpg" class="rounded-circle user_img_msg" alt="img">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start ">
                        <div class="img_cont_msg">
                            <img src="/home/assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
                        </div>
                        <div class="msg_cotainer">
                            من هم خوب هستم <span class="msg_time">9:00 صبح امروز</span> متشکرم
                            <span class="msg_time"></span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end ">
                        <div class="msg_cotainer_send"><span class="msg_time_send">  ساعت 9:05</span>
                            از کانر پیج استقبال
                            <span class="msg_time_send">می کنید</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="/home/assets/img/faces/9.jpg" class="rounded-circle user_img_msg" alt="img">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start ">
                        <div class="img_cont_msg">
                            <img src="/home/assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
                        </div>
                        <div class="msg_cotainer">
                            آیا می توانید قالب را به روز کنید؟
                            <span class="msg_time">9:07 صبح ، امروز</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            اما من باید برای شما توضیح دهم که چگونه این همه اشتباه <span class="msg_time_send">امروز 9:10 صبح </span>
                            <span class="msg_time_send"></span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="/home/assets/img/faces/9.jpg" class="rounded-circle user_img_msg" alt="img">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start ">
                        <div class="img_cont_msg">
                            <img src="/home/assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
                        </div>
                        <div class="msg_cotainer">
                            آیا می توانید قالب را به روز کنید؟
                            <span class="msg_time">9:07 صبح ، امروز</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            اما من باید برای شما توضیح دهم که چگونه این همه اشتباه <span class="msg_time_send">امروز 9:10 صبح </span>
                            <span class="msg_time_send"></span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="/home/assets/img/faces/9.jpg" class="rounded-circle user_img_msg" alt="img">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start ">
                        <div class="img_cont_msg">
                            <img src="/home/assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
                        </div>
                        <div class="msg_cotainer">
                            آیا می توانید قالب را به روز کنید؟
                            <span class="msg_time">9:07 صبح ، امروز</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="img_cont_msg">
                            <img src="/home/assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
                        </div>
                        <div class="msg_cotainer">
                            باشه خداحافظ ، بعدا برایت پیامک می کنیم ..
                            <span class="msg_time">9:12 صبح ، امروز</span>
                        </div>
                    </div>
                </div>
                <!-- msg_card_body end -->
                <!-- card-footer -->
                <div class="card-footer">
                    <div class="msb-reply d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="تایپ کردن....">
                            <div class="input-group-append ">
                                <button type="button" class="btn btn-primary ">
                                    <i class="far fa-paper-plane" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- card-footer end -->
            </div>
        </div>
    </div>
</div>

<!--Video Modal -->
<div id="videomodal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark border-0 text-white">
            <div class="modal-body mx-auto text-center p-7">
                <h5>Valex Video call</h5>
                <img src="/home/assets/img/faces/6.jpg" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3"
                     alt="img">
                <h4 class="mb-1 font-weight-semibold">Daneil Scott</h4>
                <h6>Calling...</h6>
                <div class="mt-5">
                    <div class="row">
                        <div class="col-4">
                            <a class="icon icon-shape rounded-circle mb-0 mr-3" href="#">
                                <i class="fas fa-video-slash"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="icon icon-shape rounded-circle text-white mb-0 mr-3" href="#" data-dismiss="modal"
                               aria-label="Close">
                                <i class="fas fa-phone bg-danger text-white"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="icon icon-shape rounded-circle mb-0 mr-3" href="#">
                                <i class="fas fa-microphone-slash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- modal-body -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- Audio Modal -->
<div id="audiomodal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-body mx-auto text-center p-7">
                <h5>Valex Voice call</h5>
                <img src="/home/assets/img/faces/6.jpg" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3"
                     alt="img">
                <h4 class="mb-1  font-weight-semibold">Daneil Scott</h4>
                <h6>Calling...</h6>
                <div class="mt-5">
                    <div class="row">
                        <div class="col-4">
                            <a class="icon icon-shape rounded-circle mb-0 mr-3" href="#">
                                <i class="fas fa-volume-up bg-light"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="icon icon-shape rounded-circle text-white mb-0 mr-3" href="#" data-dismiss="modal"
                               aria-label="Close">
                                <i class="fas fa-phone text-white bg-success"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="icon icon-shape  rounded-circle mb-0 mr-3" href="#">
                                <i class="fas fa-microphone-slash bg-light"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- modal-body -->
        </div>
    </div><!-- modal-dialog -->
</div>
<!-- modal -->
<!-- Footer opened -->
<div class="main-footer ht-40">
    <div class="container-fluid pd-t-0-f ht-100p">
        <span>کپی رایت © 2020 <a href="#">تیکت آپارتمانا</a> . طراحی شده توسط <a href="#">سایت آپارتمانا</a> کلیه حقوق محفوظ است.</span>
    </div>
</div>
<!-- Footer closed -->
<!-- JQuery min js -->
<script src="/home/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Bundle js -->
<script src="/home/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ionicons js -->
<script src="/home/assets/plugins/ionicons/ionicons.js"></script>
<!-- Moment js -->
<script src="/home/assets/plugins/raphael/raphael.min.js"></script>
<!-- Internal Piety js -->
<script src="/home/assets/plugins/peity/jquery.peity.min.js"></script>
<!--Internal  Flot js-->
<script src="/home/assets/plugins/jquery.flot/jquery.flot.js"></script>
<script src="/home/assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
<script src="/home/assets/plugins/jquery.flot/jquery.flot.resize.js"></script>
<script src="/home/assets/plugins/jquery.flot/jquery.flot.categories.js"></script>
<script src="/home/assets/js/dashboard.sampledata.js"></script>
<script src="/home/assets/js/chart.flot.sampledata.js"></script>
<!--Internal Apexchart js-->
{{--<script src="/home/assets/js/apexcharts.js"></script>--}}
<!-- Internal Map -->
<script src="/home/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/home/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- Internal Chart js -->
<script src="/home/assets/plugins/chart.js/Chart.bundle.min.js"></script>
<!--Internal  index js -->
<script src="/home/assets/js/index.js"></script>
<script src="/home/assets/js/jquery.vmap.sampledata.js"></script>
<!-- Moment js -->
<script src="/home/assets/plugins/moment/moment.js"></script>
<!--Internal Sparkline js -->
<script src="/home/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- Sticky js -->
<script src="/home/assets/js/sticky.js"></script>
<!-- Rating js-->
<script src="/home/assets/plugins/rating/jquery.rating-stars.js"></script>
<script src="/home/assets/plugins/rating/jquery.barrating.js"></script>
<!-- P-scroll js -->
{{--<script src="/home/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>--}}
{{--<script src="/home/assets/plugins/perfect-scrollbar/p-scroll.js"></script>--}}
<!-- Horizontalmenu js-->
{{--<script src="/home/assets/plugins/sidebar/sidebar-rtl.js"></script>--}}
{{--<script src="/home/assets/plugins/sidebar/sidebar-custom.js"></script>--}}
<!-- Eva-icons js -->
<script src="/home/assets/js/eva-icons.min.js"></script>
<!-- Horizontalmenu js-->
<script src="/home/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>
<!-- custom js -->
<script src="/home/assets/js/custom.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@include('sweet::alert')
@yield('js')
</body>

</html>

<!DOCTYPE html>
<html lang="fa">

<head>
    <title>ورود به پنل مدیریت تیکت</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="/auth/assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/auth/assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="/auth/assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="/home/assets/img/logo.png" type="image/x-icon" >

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="/auth/assets/css/style.css">

</head>
<body id="top" dir="rtl">
<div class="page_loader"></div>

<!-- Login 21 start -->
<div class="login-21">
    <div class="container">
        <div class="row login-box">
            <div class="col-lg-6 col-md-12 form-info align-self-center">
                <div class="form-section">
                    <div class="logo-2 clearfix">
                        <a href="login-21.html">
                            <img src="/home/assets/img/logo.png" alt="logo">
                        </a>
                    </div>
                    <h3>ورود به پنل تیکت</h3>
                    <div class="login-inner-form">
                        <form id="loginForm" >
                            <div class="form-group form-box">
                                <input  type="tel" name="phone" id="phone" class="form-control text-center" placeholder="...شماره همراه" aria-label="Full Name">
                                <i class="fa fa-phone"></i>
                                <p id="text-error" class="text-danger mt-2"></p>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn-md btn-theme w-100">ورود</button>
                            </div>
                            <p class="text">سیستم تیکت پشتیبانی آپارتمانا</p>
                        </form>

                        <form id="checkOTPForm" style="display: none">
                            <div class="form-group form-box">
                                <input  type="number" name="otp"  id="otp" class="form-control text-center" placeholder="...کد تایید" aria-label="OTP">
                                <i class="flaticon-password"></i>
                                <p id="text-error-otp" class="text-danger mt-2"></p>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn-md btn-theme w-100">ورود</button>
                            </div>
                            <a id="resendOTPButton" class="mt-3 d-block">ارسال مجدد</a>
                            <p id="resendOTPTime" class="float-left p-2"></p>
                            <p class="text">سیستم تیکت پشتیبانی آپارتمانا</p>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 bg-img">
                <div class="info">
                    <div class="logo clearfix">
                        <a href="">
                            <img src="/home/assets/img/logo.png" alt="logo">
                        </a>
                    </div>
                    <div class="btn-section clearfix">
                        <a href="" class="link-btn active btn-1 default-bg">ورود</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 21 end -->

<!-- External JS libraries -->
<script src="/auth/assets/js/jquery-3.6.0.min.js"></script>
<script src="/auth/assets/js/bootstrap.bundle.min.js"></script>
<script src="/auth/assets/js/jquery.validate.min.js"></script>
<script src="/auth/assets/js/app.js"></script>
<!-- Custom JS Script -->
<script src="{{ asset('js/app.js') }}"></script>
@include('sweet::alert')
<script>
    function timer() {
        let time = "2:00";
        let interval = setInterval(function() {
            let countdown = time.split(':');
            let minutes = parseInt(countdown[0], 10);
            let seconds = parseInt(countdown[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) {
                clearInterval(interval);
                $('#resendOTPTime').hide();
                $('#resendOTPButton').fadeIn();
            }
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('#resendOTPTime').html(minutes + ':' + seconds);
            time = minutes + ':' + seconds;
        }, 1000);
    }

    let token;
    $('#checkOTPForm').hide();

    $('#resendOTPButton').hide();

    $('#loginForm').submit(function (event){
        event.preventDefault();
        $('#loginForm').hide();
        $('#checkOTPForm').fadeIn();
        timer();
        $.post("{{url(route('login'))}}",{
            '_token':"{{csrf_token()}}",
            'phone':$('#phone').val()
        },function (response,status){
            token=response.loginToken;
            swal({
                icon:'success',
                text:'رمز یکبار مصرف برای شما ارسال شد .',
                button:'حله',
                timer:3000
            })
            console.log(response);
        }).fail(function (response){
            console.log(response.responseJSON.errors);
            $('#text-error').html(response.responseJSON.errors);
        })
    });

    $('#checkOTPForm').submit(function (event){
        event.preventDefault();
        $.post("{{url(route('otp'))}}",{
            '_token':"{{csrf_token()}}",
            'otp':$('#otp').val(),
            'loginToken':token,
        },function (response,status){
            if(response.role==="user"){
                $(location).attr('href',"{{route('home.tickets.index')}}");
            }else{
                $(location).attr('href',"{{route('admin.index')}}");
            }
        }).fail(function (response){
            console.log(response.responseJSON.errors.otp[0]);
            $('#text-error-otp').html(response.responseJSON.errors.otp[0]);
        })
    });


    $('#resendOTPButton').click(function(event){
        event.preventDefault();

        $.post("{{ url(route('resend-otp')) }}",
            {
                '_token' : "{{ csrf_token() }}",
                'loginToken' : token

            } , function(response , status){
                console.log(response , status);
                token=response.loginToken;

                swal({
                    icon : 'success',
                    text: 'رمز یکبار مصرف برای شما ارسال شد',
                    button : 'حله!',
                    timer : 2000
                });

                $('#resendOTPButton').fadeOut();
                timer();
                $('#resendOTPTime').fadeIn();

            }).fail(function(response){
            console.log(response.responseJSON);
            swal({
                icon : 'error',
                text: 'مشکل در ارسال دوباره رمز یکبار مصرف، مجددا تلاش کنید',
                button : 'حله!',
                timer : 2000
            });
        })
    });
</script>
</body>

</html>

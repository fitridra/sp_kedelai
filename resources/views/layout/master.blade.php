<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Konsultasi Hama Kedelai</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/user/img/core-img/favicon.ico')}}">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/user/style.css')}}">

</head>

<body>
    <!-- Preloader -->
    <!-- <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-circle"></div>
        <div class="preloader-img">
            <img src="{{asset('assets/user/img/core-img/leaf.png')}}" alt="">
        </div>
    </div> -->
    @include('layout.includes._navbar')

    @yield('content')

    @include('layout.includes._footer')

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{asset('assets/user/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('assets/user/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('assets/user/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{asset('assets/user/js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('assets/user/js/active.js')}}"></script>
</body>

</html>
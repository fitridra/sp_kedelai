<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Konsultasi Hama Kedelai</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="icon" href="{{asset('assets/user/img/core-img/favicon.ico')}}">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <h2 class="text-center">Lupa Kata Sandi</h2>
                            </div>
                            <center>
                                <h6 class="font-weight-light">Silahkan masukkan kata sandi baru anda.</h6>

                                @if(session('failed'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('failed')}}
                                </div>
                                @endif
                            </center>
                            <form class="pt-3" action="{{route('reset_pw')}}" method="post">
                                @csrf
                                <input type="hidden" name="token" value="{{$token}}">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1" value="{{old('email')}}" placeholder="Email" required>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" required>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" type="submit">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/admin/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/admin/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/admin/js/template.js')}}"></script>
    <script src="{{asset('assets/admin/js/settings.js')}}"></script>
    <script src="{{asset('assets/admin/js/todolist.js')}}"></script>
    <!-- endinject -->
</body>

</html>
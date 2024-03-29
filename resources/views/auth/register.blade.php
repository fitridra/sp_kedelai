<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Konsultasi Hama Kedelai</title>
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
                                <h2 class="text-center">Konsultasi Hama Kedelai</h2>
                            </div>
                            <center>
                                <h4>Belum Punya Akun?</h4>
                                <h6 class="font-weight-light">Daftar dengan mudah sekarang!</h6>
                            </center>
                            <form class="pt-3" action="{{route('register')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Email" required>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="nama" name="nama" class="form-control form-control-lg @error('nama') is-invalid @enderror" id="exampleInputNama1" placeholder="Nama" required>
                                    @error('nama')
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
                                <input type="hidden" name="role" value="1">
                                <div class="mt-3">
                                    <button class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" type="submit">SIGN UP</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Sudah Punya Akun? <a href="{{route('login')}}" class="text-success">Login</a>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{asset('iuran-logo.png')}}" style="  object-fit: cover;">                                
                            </div>
                            <h4>Form Pendaftaran</h4>
                            <h6 class="font-weight-light">Silahkan Lakukan Pendaftaran.</h6>
                            <form method="post" action="/process_register" class="pt-3">
                                @csrf
                                <div class="form-group">
                                    <input name="nik" type="nik" class="form-control form-control-lg"
                                        id="exampleInputnik1" placeholder="NIK">
                                </div>
                                <div class="form-group">
                                    <input name="firstName" type="firstName" class="form-control form-control-lg"
                                        id="exampleInputfirstName" placeholder="Nama Depan">
                                </div>
                                <div class="form-group">
                                    <input name="lastName" type="lastName" class="form-control form-control-lg"
                                        id="exampleInputfirstName" placeholder="Nama Belakang">
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input name="phoneNumber" type="phoneNumber" class="form-control form-control-lg"
                                        id="exampleInputphoneNumber1" placeholder="No telepon">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputconfirmPassword1" name="confirmPassword" placeholder="Konfirmasi Password">
                                </div>
                                <div class="mt-3">
                                    <button style="width: 100%;" type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Daftar</a>
                                </div>
                                @csrf
                                <div class="text-center mt-4 font-weight-light"> Sudah Punya Akun ? <a
                                        href="../" class="text-primary">Login</a>
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
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <!-- endinject -->
</body>

</html>

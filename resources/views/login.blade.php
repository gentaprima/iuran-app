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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('dashboard/new-style.css') }}">

</head>

<body>
    @if (Session::has('message'))
        <p hidden="true" id="message">{{ Session::get('message') }}</p>
        <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
    @endif
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('iuran-logo.png') }}" style="  object-fit: cover;">

                            </div>
                            <h4>Selamat Datang</h4>
                            <h6 class="font-weight-light">Masuk untuk melanjutkan.</h6>
                            <form method="post" action="/auth" class="pt-3 needs-validation" novalidate>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                                        id="exampleInputPassword1" name="password" placeholder="Password" required>
                                    <div class="invalid-feedback">
                                        Gunakan minimal 8 karakter dengan campuran huruf,angka, dan simbol </div>
                                    <div class="text-info-alert" style="font-size:0.875em;margin-top:0.25rem">
                                        Gunakan minimal 8 karakter dengan campuran huruf,angka, dan simbol </div>
                                </div>

                                <div class="mt-3">
                                    <button style="width: 100%;" type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Masuk</a>
                                </div>
                                @csrf
                                <div class="text-center mt-4 font-weight-light"> Tidak Punya Akun ? <a href="/register"
                                        class="text-primary">Daftar Warga</a>
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
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        $(".text-info-alert").css("display", "none")
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true
        })
        let icon = document.getElementById('icon');
        if (icon != null) {
            let message = document.getElementById('message');
            Toast.fire({
                icon: icon.innerHTML,
                title: message.innerHTML
            });
        }
    </script>
</body>

</html>

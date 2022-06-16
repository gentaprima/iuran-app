<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <!-- CSS only -->

    <!-- JS, Popper.js, and jQuery -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: none;
            color: black !important;
            /*change the hover text color*/
        }


        /*below block of css for change style when active*/

        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            background: none;
            color: black !important;
        }
    </style>
</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html">
                    <img src="{{ asset('iuran-logo.png') }}" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html">
                    <span>LOGO</span>
                    {{-- <img src=""
                        alt="logo" /> --}}
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">
                                    {{ Session::get('dataUsers')->first_name . ' ' . Session::get('dataUsers')->last_name }}
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="/profile">
                                <i class="mdi mdi-cached me-2 text-success"></i> Akun </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Keluar </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <a class="nav-link" href="/">
                            <span class="menu-title">Beranda</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    @if (Session::get('dataUsers')->role == 1)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-house" aria-expanded="false"
                                aria-controls="ui-house">
                                <span class="menu-title">Data Perumahan</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-city menu-icon"></i>
                            </a>
                            <div class="collapse" id="ui-house">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="/data-rumah/data-blok">Data Blok</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="/data-rumah">Data Rumah</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-citizen" aria-expanded="false"
                                aria-controls="ui-citizen">
                                <span class="menu-title">Data Warga</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                            </a>
                            <div class="collapse" id="ui-citizen">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="/data-warga">Data
                                            Warga</a>
                                    </li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="/verifikasi-warga">Verifikasi Warga</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ Session::get('dataUsers')->role == 0 ? '/data-iuran' : '/data-iuran-warga' }}">
                            <span class="menu-title">Data Iuran</span>
                            <i class="mdi mdi-arrow-up-bold-circle menu-icon"></i>
                        </a>
                    </li>
                    @if (Session::get('dataUsers')->role == 1)
                        <li class="nav-item sidebar-actions">
                            {{-- <div class="mt-4"> --}}
                            <div class="border-bottom">
                                <p class="menu-title" style="font-weight:800">Arus Kas</p>
                            </div>
                        <li class="nav-item">
                            <a class="nav-link" href="/data-pemasukan">
                                <span class="menu-title">Pemasukkan</span>
                                <i class="mdi mdi-call-made menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/data-pengeluaran">
                                <span class="menu-title">Pengeluaran</span>
                                <i class="mdi mdi-call-received menu-icon"></i>
                            </a>
                        </li>
                        </li>
                    @endif
                    @if (Session::get('dataUsers')->role == 1)
                        <li class="nav-item sidebar-actions">
                            {{-- <div class="mt-4"> --}}
                            <div class="border-bottom">
                                <p class="menu-title" style="font-weight:800">Laporan</p>
                            </div>
                        <li class="nav-item ">
                            <a class="nav-link" href="/jurnal">
                                <span class="menu-title">Jurnal Pemasukkan <br> & Pengeluaran</span>
                                <i class="mdi mdi-file-export menu-icon"></i>
                            </a>
                        </li>
                    @endif
                    </li>
                    @if (Session::get('dataUsers')->role == 1)
                        <li class="nav-item sidebar-actions">
                            {{-- <div class="mt-4"> --}}
                            <div class="border-bottom">
                                <p class="menu-title" style="font-weight:800">Pengaturan</p>
                            </div>
                        <li class="nav-item {{ Request::is('data-rekening') ? 'active' : '' }}">
                            <a class="nav-link" href="/data-rekening">
                                <span class="menu-title">Rekening</span>
                                <i class="mdi mdi-account-card-details menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('data-jenis-iuran') ? 'active' : '' }}">
                            <a class="nav-link" href="/data-jenis-iuran">
                                <span class="menu-title">Jenis Iuran</span>
                                <i class="mdi mdi-animation menu-icon"></i>
                            </a>
                        </li>
                    @endif
                    </li>
                </ul>
            </nav>
            <div class="main-panel">
                @yield('content')
                {{-- <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright ©
                            bootstrapdash.com 2021</span>
                        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a
                                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap
                                admin template</a> from Bootstrapdash.com</span>
                    </div>
                </footer> --}}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>

    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('dashboard/new-style.css') }}">
    <script>
        var xValues = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    label: 'Pengeluaran',
                    backgroundColor: "#E91E63",
                    data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478, 5, 0],
                    borderColor: "#E91E63",
                    fill: false,
                }, {
                    label: 'Pemasukkan',
                    backgroundColor: "#46c35f",
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000, 10, 0],
                    borderColor: "#46c35f",
                    fill: false,
                }]
            },
            options: {
                legend: {
                    display: true
                }
            }
        });
        $('.paginate_button.previous').html("<<<");
        $('.paginate_button.next').html(">>>");
        $('.example1').DataTable({
            dom: 'Bfrtip',
            "searching": false
        });
        $('.example1').removeClass("dataTable")
    </script>
    <script>
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

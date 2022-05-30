
<?php 
  use Illuminate\Support\Facades\Session;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="{{ asset('dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dashboard/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/new-style.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="sidebar-mini layout-fixed sidebar-collapse">
  <div class="wrapper" style="background-color: #f4f6f9;">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light  style-header">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"
              style="color:#fff"></i></a>
        </li> -->
        <li class="nav-item header d-none d-sm-inline-block">
          <a href="/" class="nav-link">@yield('title-link')</a>
        </li>
        <li class="nav-item header d-none d-sm-inline-block">
          <i class="fa fa-chevron-right"></i>
        </li>
        <li class="nav-item header d-none d-sm-inline-block">
          <a href="#" class="nav-link">@yield('sub-title-link')</a>
        </li>
      </ul>
      @if(Session::has('message'))
      <p hidden="true" id="message">{{ Session::get('message') }}</p>
      <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
      @endif

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" style="height: 0px !important;">
            <?php if(Session::get('dataUsers')->photo == null){ ?>
            <img src="{{asset('user.png')}}" alt="User Avatar" style="margin-top: -25px;border:3px solid #fff;"
              class="img-size-50 img-circle">
            <?php }else{ ?>
            <img src="{{asset('uploads/profile')}}/{{Session::get('dataUsers')->photo}}" alt="User Avatar"
              style="margin-top: -25px;border:3px solid #fff;" class="img-size-50 img-circle">
            <?php } ?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="margin-top: 30px;">
            <div class="dropdown-divider"></div>
            <a href="/profile" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="/logout" class="dropdown-item">
              <i class="fas fa-share mr-2"></i> Logout
            </a>

          </div>
        </li>
        <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4 sidebar-light-danger">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link mb-3" style="margin-top:21px;">
        <img src="{{ asset('dashboard/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8;  ">
        <span class="brand-text font-weight-light">IURAN APP</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline">
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="/" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home "></i>
                <p>
                  Beranda
                </p>
              </a>
            </li>
            @if(Session::get('dataUsers')->role == 0)

            <li class="nav-item">
              <a href="/data-iuran" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>
                  Data Iuran
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Report Anggaran
                </p>
              </a>
            </li>
            @endif            
            <?php if(Session::get('dataUsers')->role == 1){ ?>
            <li class="nav-item {{ Request::is('data-warga') || Request::is('verifikasi-warga') ? 'menu-open' : '' }}">
              <a href="/verifikasi-warga"
                class="nav-link {{ Request::is('data-warga') || Request::is('verifikasi-warga') ? 'active' : '' }}">
                <i class="nav-icon fas fa-address-card"></i>
                <p>
                  Warga
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview ">
                <li class="nav-item">
                  <a href="/verifikasi-warga" class="nav-link {{ Request::is('verifikasi-warga') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Verifikasi Warga</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/data-warga" class="nav-link {{ Request::is('data-warga') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Warga</p>
                  </a>
                </li>
              </ul>
              <?php } ?>
              @if(Session::get('dataUsers')->role == 1)
            <li class="nav-item">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                  Data Iuran
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/docs/3.2/components" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Arus Kas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                
                <li class="nav-item">
                  <a href="#" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Pemasukan
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Anggaran
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Laporan
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            @endif

            <?php if(Session::get('dataUsers')->role == 1){ ?>
            <li class="nav-item {{ Request::is('data-rekening') ? 'menu-open' : '' }}">
              <a href="/verifikasi-warga" class="nav-link {{ Request::is('data-rekening') ? 'active' : '' }}">
                <i class="nav-icon fas fa-toolbox"></i>
                <p>
                  Pengaturan
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview ">
                <li class="nav-item">
                  <a href="/data-rekening" class="nav-link {{ Request::is('data-rekening') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Rekening</p>
                  </a>
                </li>

              </ul>
              <?php } ?>
          </ul>
          </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    @yield('content')

    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2022 <a href="https://adminlte.io">Iuran App</a>.</strong>
      All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('dashboard/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{asset('dashboard/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{asset('dashboard/plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{asset('dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('dashboard/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{asset('dashboard/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{asset('dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dashboard/dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dashboard/dist/js/demo.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('dashboard/dist/js/pages/dashboard.js')}}"></script>
  <script src="{{asset('dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

  <!-- DataTables  & Plugins -->
  <script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
  <script src="sweetalert2.all.min.js"></script>
  <script>
    $(function () {
      bsCustomFileInput.init();
    });
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
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> @yield('title') </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('admin/assets/css/all.min.css') }} ">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href=" {{ asset('admin/assets/css/tempusdominus-bootstrap-4.min.css') }} ">
  <!-- iCheck -->
  <link rel="stylesheet" href=" {{ asset('admin/assets/css/icheck-bootstrap.min.css') }} ">
  <!-- JQVMap -->
  <link rel="stylesheet" href=" {{ asset('admin/assets/css/jqvmap.min.css') }} ">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('admin/assets/css/adminlte.min.css') }} ">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href=" {{ asset('admin/assets/css/OverlayScrollbars.min.css') }} ">
  <!-- Daterange picker -->
  <link rel="stylesheet" href=" {{ asset('admin/assets/css/daterangepicker.css') }} ">
  <!-- summernote -->
  <link rel="stylesheet" href=" {{ asset('admin/assets/css/summernote-bs4.min.css') }} ">
  <!-- Own style css file  -->
  <link rel="stylesheet" href=" {{ asset('admin/assets/css/style.css') }} ">
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  @yield('select_css')
  @toastr_css
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src=" {{ asset('admin/assets/img/AdminLTELogo.png') }} " alt="AdminLTELogo" height="60" width="60">
  </div>

    @include('admin.layouts.navbar')

    @include('admin.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src=" {{ asset('admin/assets/js/jquery.min.js') }} "></script>
<!-- jQuery UI 1.11.4 -->
<script src=" {{ asset('admin/assets/js/jquery-ui.min.js') }} "></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
<!-- Bootstrap 4 -->
<script src=" {{ asset('admin/assets/js/bootstrap.bundle.min.js') }} "></script>
<!-- ChartJS -->
<script src=" {{ asset('admin/assets/js/Chart.min.js') }} "></script>
<!-- Sparkline -->
<script src=" {{ asset('admin/assets/js/sparkline.js') }} "></script>
<!-- JQVMap -->
<script src=" {{ asset('admin/assets/js/jquery.vmap.min.js') }} "></script>
<script src=" {{ asset('admin/assets/js/jquery.vmap.usa.js') }} "></script>
<!-- jQuery Knob Chart -->
<script src=" {{ asset('admin/assets/js/jquery.knob.min.js') }} "></script>
<!-- daterangepicker -->
<script src=" {{ asset('admin/assets/js/moment.min.js') }} "></script>
<script src=" {{ asset('admin/assets/js/daterangepicker.js') }} "></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src=" {{ asset('admin/assets/js/tempusdominus-bootstrap-4.min.js') }} "></script>
<!-- Summernote -->
<script src=" {{ asset('admin/assets/js/summernote-bs4.min.js') }} "></script>
<!-- overlayScrollbars -->
<script src=" {{ asset('admin/assets/js/jquery.overlayScrollbars.min.js') }} "></script>
<!-- AdminLTE App -->
<script src=" {{ asset('admin/assets/js/adminlte.js') }} "></script>
<!-- AdminLTE for demo purposes -->
<script src=" {{ asset('admin/assets/js/demo.js') }} "></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src=" {{ asset('admin/assets/js/pages/dashboard.js') }} "></script>
<!-- Swwet alert 2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @toastr_js
    @toastr_render
@yield('js')
@yield('js_user_page')
@yield('select_js')
</body>
</html>

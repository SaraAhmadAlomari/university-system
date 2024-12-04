<!DOCTYPE html>
<html lang="en">
@include('layouts.header-script')
@yield('style')
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">


@include('layouts.header')
@include('layouts.sidebar')


  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->



@include('layouts.footer')
@include('layouts.footer-script')
@yield('js')

</body>
</html>

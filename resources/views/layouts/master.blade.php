<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lomba Burung | @yield('title', 'Dashboard')</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('components.navbar')
        @include('components.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('components.footer')
    </div>
</body>
<!-- jQuery -->
<script type="text/javascript" src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script type="text/javascript" src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
</script>
<!-- AdminLTE App -->
<script type="text/javascript" src="{{ asset('assets/js/adminlte.js') }}"></script>
<!-- SweetAlert2 -->
<script type="text/javascript" src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script type="text/javascript" src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
</html>

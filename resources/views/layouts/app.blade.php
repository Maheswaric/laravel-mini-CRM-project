<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Mini CRM</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/plugins/images/favicon.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('assets/plugins/bower_components/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css')}}">
    <!-- Custom CSS -->
    <link href="{{asset('assets/css/style.min.css')}}" rel="stylesheet">
    <!-- toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" type="text/css">
</head>
<style>
    .error{
        color:red;
    }
</style>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        @include('layouts.header')
        @if (session('status'))
            <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
        @endif
        <div class="page-wrapper">
            @yield('content')
            <footer class="footer text-center"> {{date('Y')}} © Mini CRM
            </footer>
        </div>
    </div>

    <script src="{{asset('assets/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/app-style-switcher.js')}}"></script>
    <script src="{{asset('assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('assets/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="{{asset('assets/plugins/bower_components/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboards/dashboard1.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/additional-methods.min.js')}}"></script>

    <!-- toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
         if ($('#status_span').length) {
            var status = $('#status_span').attr('data-status');
            if (status === '1') { //success
                toastr.success($('#status_span').attr('data-msg'));
            } else if (status === '0') { //error
                toastr.error($('#status_span').attr('data-msg'));
            }
        }
    </script>

    @yield('javascript')
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{ base_url() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ base_url() }}assets_admin/images/favicon.png">
    <title>Farmacias JBC</title>
    <link href="{{ base_url() }}assets_admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ base_url() }}/css/style.css" rel="stylesheet">
    <link href="{{ base_url() }}/css/isloading.css" rel="stylesheet">
    <link href="{{ base_url() }}/css/colors/blue.css" id="theme" rel="stylesheet">
    @yield('included_css')
</head>

<body class="fix-header card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2"
                stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper">
        @include('header')
        @if (!isset($show_menu) || $show_menu)
            @include('menu')
        @endif
        <div class="{{(!isset($show_menu) || $show_menu) ? 'page-wrapper' : ''}}">
            <div class="container-fluid">
                @yield('contenido')
            </div>
            <footer class="footer">
                © {{ date('Y') }} <a target="_blank" href="www.farmaciasjbc.com.mx">www.farmaciasjbc.com.mx</a>
            </footer>
        </div>
    </div>
    <script src="{{ base_url() }}assets_admin/plugins/jquery/jquery.min.js"></script>
    <script src="{{ base_url() }}assets_admin/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ base_url() }}assets_admin/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ base_url() }}/js/jquery.slimscroll.js"></script>
    <script src="{{ base_url() }}/js/waves.js"></script>
    <script src="{{ base_url() }}/js/sidebarmenu.js"></script>
    <script src="{{ base_url() }}assets_admin/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="{{ base_url() }}assets_admin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="{{ base_url() }}/js/custom.min.js"></script>
    <script src="{{ base_url() }}/js/isloading.js"></script>
    <script src="{{ base_url() }}/js/bootbox.min.js"></script>
    <script src="{{ base_url() }}/js/general.js"></script>
    @yield('included_js')
</body>

</html>

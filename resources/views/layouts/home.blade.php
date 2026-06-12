<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Molla Shop')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/shop/images/icons/favicon-32x32.png') }}">

    <!-- Line Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/shop/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/shop/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/shop/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/shop/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/shop/css/plugins/jquery.countdown.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/shop/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/shop/css/skins/skin-demo-2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/shop/css/demos/demo-2.css') }}">
</head>

<body>
    <div class="page-wrapper">

        @include('front.topbar')
        @include('front.header')
        @include('front.menu')

        <main class="main">
            @yield('content')
        </main><!-- End .main -->

        @include('front.footer')

    </div><!-- End .page-wrapper -->

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay"></div>

    <!-- Mobile Menu -->
    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="#">Shop</a></li>
                </ul>
            </nav>
        </div>
    </div><!-- End .mobile-menu-container -->

    <!-- Plugins JS -->
    <script src="{{ asset('assets/shop/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/shop/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/shop/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('assets/shop/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/shop/js/superfish.min.js') }}"></script>
    <script src="{{ asset('assets/shop/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/shop/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('assets/shop/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/shop/js/jquery.countdown.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/shop/js/main.js') }}"></script>
    <script src="{{ asset('assets/shop/js/demos/demo-2.js') }}"></script>

    @yield('scripts')
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="david Hida">
    <meta name="description"
        content="Le Centre Africain d'Action pour la Recherche et l'Innovation Communautaire en Santé (CARICS-Togo) est un centre indépendant de recherche, d'innovation et d'action en santé publique basé au Togo.">
    <meta name="keywords"
        content="CARICS, CARICS-Togo, Innovation, Recherce, Santé, TOGO, AFRIQUE, COMMUNAUTAIRE, ACTION, SANTE PUBLIQUE">
    <!-- page title -->
    <title>{{ $title ?? config('app.name') }}</title>

    <!-- favicon icon -->

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">
    <!-- font awesome css -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css')}}">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css')}}">
    <!-- image comparision css -->
    <link rel="stylesheet" href="{{ asset('assets/css/twentytwenty.css')}}">
    <!-- magnific css -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css')}}">
    <!-- main css  -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>



    <div class="page-wrapper">
        <!-- preloader start -->
        <div class="preloader">
            <div class="preloader-icon">
                <img src="{{ asset('logo.jpeg') }}" alt="loader image">
            </div>
            <div class="preloader-text">
                <p>C</p>
                <p>A</p>
                <p>R</p>
                <p>I</p>
                <p>C</p>
                <p>S</p>
            </div>
        </div>
        <!-- preloader end -->

        <!-- back to top start -->
        <button id="back-top" class="back-to-top" aria-label="back to top">
            <i class="fa-solid fa-chevron-up"></i>
        </button>
        <!-- back to top end -->

        <!-- mouse cursor start -->
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>
        <!-- mouse cursor end -->

        <x-offcanvas-site />
        <!-- header start -->
        <x-parts.header />
        <!-- header end-->

        <main class="main">
            {{ $slot }}
        </main>

        <!-- footer start -->
        <x-parts.footer />
        <!-- footer end -->
    </div>

    @livewireScripts

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- swiper js -->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>

    <!-- jquery meanmenu js -->
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>

    <!-- wow Js -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- validate js -->
    <script src="{{ asset('assets/js/validate.min.js') }}"></script>
    <!-- ajax form Js -->
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <!-- image comparision js -->
    <script src="{{ asset('assets/js/jquery.event.move.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.twentytwenty.js') }}"></script>
    <!-- appear Js -->
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <!-- magnific Js -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- SmoothScroll Js -->
    <script src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
    <!-- main Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
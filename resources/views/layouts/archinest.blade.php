<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

    <!-- Stylesheets -->
    <link href="{{ asset('archinest/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('archinest/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('archinest/css/style-home-3.css') }}" rel="stylesheet">
    <link href="{{ asset('archinest/css/custom.css') }}" rel="stylesheet">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader start -->
        <div class="preloader">
            <svg viewbox="0 0 1000 1000" preserveaspectratio="none">
                <path id="preloaderSvg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
            </svg>
            <div class="preloader-heading">
                <div class="load-text">
                    <span>C</span>
                    <span>a</span>
                    <span>r</span>
                    <span>i</span>
                    <span>c</span>
                    <span>s</span>
                </div>
            </div>
        </div>
        <!-- Preloader end -->
        <!-- Main Header-->
        <x-archinest.header />

        <!--End Main Header -->

        {{ $slot }}

        <!-- Main Footer -->
        <x-archinest.footer />
        <!--End Main Footer -->

    </div><!-- End Page Wrapper -->

    @livewireScripts


    {{--
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
    <script src="{{ asset('archinest/js/jquery.js') }}"></script>
    <script src="{{ asset('archinest/js/popper.min.js') }}"></script>
    <script src="{{ asset('archinest/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('archinest/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('archinest/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('archinest/js/wow.js') }}"></script>
    <script src="{{ asset('archinest/js/appear.js') }}"></script>
    <script src="{{ asset('archinest/js/select2.min.js') }}"></script>
    <script src="{{ asset('archinest/js/knob.js') }}"></script>
    <script src="{{ asset('archinest/js/swiper.min.js') }}"></script>

    <script src="{{ asset('archinest/js/gsap.min.js') }}"></script>
    <script src="{{ asset('archinest/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('archinest/js/splitType.js') }}"></script>
    <script src="{{ asset('archinest/js/gsap-scroll-smoother.js') }}"></script>
    <script src="{{ asset('archinest/js/gsap-scroll-to-plugin.js') }}"></script>
    <script src="{{ asset('archinest/js/SplitText.min.js') }}"></script>
    <script src="{{ asset('archinest/js/custom-gsap.js') }}"></script>
    <script src="{{ asset('archinest/js/jquery-scrolltofixed-min.js') }}"></script>

    <script src="{{ asset('archinest/js/script.js') }}"></script>
    <script defer="" src="{{ asset('archinest/js/beacon.min.js') }}"></script>
</body>

</html>
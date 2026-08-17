<html lang="en" style="scroll-behavior: smooth;">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="david Hida">
    <meta name="description"
        content="The African Action Center for Research and Community Innovation in Health (CARICS-Togo) is an independent center for research, innovation, and action in public health based in Togo.">
    <meta name="keywords"
        content="CARICS, CARICS-Togo, Innovation, Research, Health, Togo, Africa, Community, Action, Public Health">
    <!-- page title -->
    <title>CARICS</title>

    <!-- favicon icon -->

    <link rel="apple-touch-icon" sizes="180x180" href="http://carics-togo.test/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://carics-togo.test/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://carics-togo.test/favicons/favicon-16x16.png">
    <link rel="manifest" href="http://carics-togo.test/favicons/site.webmanifest">
    <!-- font awesome css -->

    <!-- Stylesheets -->
    <link href="http://carics-togo.test/archinest/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://carics-togo.test/archinest/css/style.css" rel="stylesheet">
    <link href="http://carics-togo.test/archinest/css/style-home-3.css" rel="stylesheet">
    <link href="http://carics-togo.test/archinest/css/custom.css" rel="stylesheet">


    <link rel="preload" as="style" href="http://carics-togo.test/build/assets/app-vksiywtr.css">
    <link rel="modulepreload" as="script" href="http://carics-togo.test/build/assets/app-BvRk9kiK.js">
    <link rel="stylesheet" href="http://carics-togo.test/build/assets/app-vksiywtr.css" data-navigate-track="reload">
    <script type="module" src="http://carics-togo.test/build/assets/app-BvRk9kiK.js"
        data-navigate-track="reload"></script> <!-- Livewire Styles -->
    <style>
        [wire\:loading][wire\:loading],
        [wire\:loading\.delay][wire\:loading\.delay],
        [wire\:loading\.list-item][wire\:loading\.list-item],
        [wire\:loading\.inline-block][wire\:loading\.inline-block],
        [wire\:loading\.inline][wire\:loading\.inline],
        [wire\:loading\.block][wire\:loading\.block],
        [wire\:loading\.flex][wire\:loading\.flex],
        [wire\:loading\.table][wire\:loading\.table],
        [wire\:loading\.grid][wire\:loading\.grid],
        [wire\:loading\.inline-flex][wire\:loading\.inline-flex] {
            display: none;
        }

        [wire\:loading\.delay\.none][wire\:loading\.delay\.none],
        [wire\:loading\.delay\.shortest][wire\:loading\.delay\.shortest],
        [wire\:loading\.delay\.shorter][wire\:loading\.delay\.shorter],
        [wire\:loading\.delay\.short][wire\:loading\.delay\.short],
        [wire\:loading\.delay\.default][wire\:loading\.delay\.default],
        [wire\:loading\.delay\.long][wire\:loading\.delay\.long],
        [wire\:loading\.delay\.longer][wire\:loading\.delay\.longer],
        [wire\:loading\.delay\.longest][wire\:loading\.delay\.longest] {
            display: none;
        }

        [wire\:offline][wire\:offline] {
            display: none;
        }

        [wire\:dirty]:not(textarea):not(input):not(select) {
            display: none;
        }

        :root {
            --livewire-progress-bar-color: #2299dd;
        }

        [x-cloak] {
            display: none !important;
        }

        [wire\:cloak] {
            display: none !important;
        }

        dialog#livewire-error::backdrop {
            background-color: rgba(0, 0, 0, .6);
        }
    </style>
    <script id="browser-logger-active">
        (function () {
            const ENDPOINT = 'http://carics-togo.test/_boost/browser-logs';
            const logQueue = [];
            let flushTimeout = null;

            console.log('🔍 Browser logger active (MCP server detected). Posting to: ' + ENDPOINT);

            // Store original console methods
            const originalConsole = {
                log: console.log,
                info: console.info,
                error: console.error,
                warn: console.warn,
                table: console.table
            };

            // Helper to safely stringify values
            function safeStringify(obj) {
                const seen = new WeakSet();
                return JSON.stringify(obj, (key, value) => {
                    if (typeof value === 'object' && value !== null) {
                        if (seen.has(value)) return '[Circular]';
                        seen.add(value);
                    }
                    if (value instanceof Error) {
                        return {
                            name: value.name,
                            message: value.message,
                            stack: value.stack
                        };
                    }
                    return value;
                });
            }

            // Batch and send logs
            function flushLogs() {
                if (logQueue.length === 0) return;

                const batch = logQueue.splice(0, logQueue.length);

                fetch(ENDPOINT, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ logs: batch })
                }).catch(err => {
                    // Silently fail to avoid infinite loops
                    originalConsole.error('Failed to send logs:', err);
                });
            }

            // Debounced flush (100ms)
            function scheduleFlush() {
                if (flushTimeout) clearTimeout(flushTimeout);
                flushTimeout = setTimeout(flushLogs, 100);
            }

            // Intercept console methods
            ['log', 'info', 'error', 'warn', 'table'].forEach(method => {
                console[method] = function (...args) {
                    // Call original method
                    originalConsole[method].apply(console, args);

                    // Capture log data
                    try {
                        logQueue.push({
                            type: method,
                            timestamp: new Date().toISOString(),
                            data: args.map(arg => {
                                try {
                                    return typeof arg === 'object' ? JSON.parse(safeStringify(arg)) : arg;
                                } catch (e) {
                                    return String(arg);
                                }
                            }),
                            url: window.location.href,
                            userAgent: navigator.userAgent
                        });

                        scheduleFlush();
                    } catch (e) {
                        // Fail silently
                    }
                };
            });

            // Global error handlers for uncaught errors
            const originalOnError = window.onerror;
            window.onerror = function boostErrorHandler(errorMsg, url, lineNumber, colNumber, error) {
                try {
                    logQueue.push({
                        type: 'uncaught_error',
                        timestamp: new Date().toISOString(),
                        data: [{
                            message: errorMsg,
                            filename: url,
                            lineno: lineNumber,
                            colno: colNumber,
                            error: error ? {
                                name: error.name,
                                message: error.message,
                                stack: error.stack
                            } : null
                        }],
                        url: window.location.href,
                        userAgent: navigator.userAgent
                    });

                    scheduleFlush();
                } catch (e) {
                    // Fail silently
                }

                // Call original handler if it exists
                if (originalOnError && typeof originalOnError === 'function') {
                    return originalOnError(errorMsg, url, lineNumber, colNumber, error);
                }

                // Let the error continue to propagate
                return false;
            }
            window.addEventListener('error', (event) => {
                try {
                    logQueue.push({
                        type: 'window_error',
                        timestamp: new Date().toISOString(),
                        data: [{
                            message: event.message,
                            filename: event.filename,
                            lineno: event.lineno,
                            colno: event.colno,
                            error: event.error ? {
                                name: event.error.name,
                                message: event.error.message,
                                stack: event.error.stack
                            } : null
                        }],
                        url: window.location.href,
                        userAgent: navigator.userAgent
                    });

                    scheduleFlush();
                } catch (e) {
                    // Fail silently
                }

                // Let the error continue to propagate
                return false;
            });
            window.addEventListener('unhandledrejection', (event) => {
                try {
                    logQueue.push({
                        type: 'error',
                        timestamp: new Date().toISOString(),
                        data: [{
                            message: 'Unhandled Promise Rejection',
                            reason: event.reason instanceof Error ? {
                                name: event.reason.name,
                                message: event.reason.message,
                                stack: event.reason.stack
                            } : event.reason
                        }],
                        url: window.location.href,
                        userAgent: navigator.userAgent
                    });

                    scheduleFlush();
                } catch (e) {
                    // Fail silently
                }

                // Let the rejection continue to propagate
                return false;
            });

            // Flush on page unload
            window.addEventListener('beforeunload', () => {
                if (logQueue.length > 0) {
                    navigator.sendBeacon(ENDPOINT, JSON.stringify({ logs: logQueue }));
                }
            });
        })();
    </script>
    <link id="dynamic-style" rel="stylesheet" charset="utf-8" media="all" type="text/css"
        href="chrome-extension://lgbjhdkjmpgjgcbcdlhkokkckpjmedgc/inject/comm.css">
    <script type="text/javascript" src="chrome-extension://lgbjhdkjmpgjgcbcdlhkokkckpjmedgc/inject/comm.js"></script>
    <style>
        /* Make clicks pass-through */

        #nprogress {
            pointer-events: none;
        }

        #nprogress .bar {
            background: var(--livewire-progress-bar-color, #29d);

            position: fixed;
            z-index: 1031;
            top: 0;
            left: 0;

            width: 100%;
            height: 2px;
        }

        /* Fancy blur effect */
        #nprogress .peg {
            display: block;
            position: absolute;
            right: 0px;
            width: 100px;
            height: 100%;
            box-shadow: 0 0 10px var(--livewire-progress-bar-color, #29d), 0 0 5px var(--livewire-progress-bar-color, #29d);
            opacity: 1.0;

            -webkit-transform: rotate(3deg) translate(0px, -4px);
            -ms-transform: rotate(3deg) translate(0px, -4px);
            transform: rotate(3deg) translate(0px, -4px);
        }

        /* Remove these to get rid of the spinner */
        #nprogress .spinner {
            display: block;
            position: fixed;
            z-index: 1031;
            top: 15px;
            right: 15px;
        }

        #nprogress .spinner-icon {
            width: 18px;
            height: 18px;
            box-sizing: border-box;

            border: solid 2px transparent;
            border-top-color: var(--livewire-progress-bar-color, #29d);
            border-left-color: var(--livewire-progress-bar-color, #29d);
            border-radius: 50%;

            -webkit-animation: nprogress-spinner 400ms linear infinite;
            animation: nprogress-spinner 400ms linear infinite;
        }

        .nprogress-custom-parent {
            overflow: hidden;
            position: relative;
        }

        .nprogress-custom-parent #nprogress .spinner,
        .nprogress-custom-parent #nprogress .bar {
            position: absolute;
        }

        @-webkit-keyframes nprogress-spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes nprogress-spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body style="">

    <div class="page-wrapper">

        <!-- Preloader start -->

        <!-- Preloader end -->
        <!-- Main Header-->
        <header class="main-header header-style-one fixed-header">
            <div class="outer-box">
                <div class="header-top">
                    <div class="container">
                        <div class="inner-top p-0">
                            <ul class="list">
                                <li><a href="mailto:info@carics.org"><i
                                            class="fa-regular fa-envelope-badge"></i><span>info@carics.org</span></a>
                                </li>
                            </ul>
                            <ul class="list">
                                <li><a href="tel:+228 91 37 21 34"><i class="fa-regular fa-phone-circle-down"></i>
                                        +228 91 37 21 34</a>
                                </li>
                                <li class="line"></li>
                                <li><a href="tel:+228 90 99 18 59"><i class="fa-regular fa-phone"></i>
                                        +228 90 99 18 59</a>
                                </li>
                                <li class="line"></li>
                                <li><a href="tel:+228 99 56 10 55"><i class="fa-regular fa-phone"></i>
                                        +228 99 56 10 55</a>
                                </li>
                                <li class="line"></li>
                                <li>
                                    <ul class="list" x-data="{ open: false }"
                                        style="margin-left:auto; position:relative;">
                                        <li>
                                            <div @click="open = !open" @click.outside="open = false"
                                                style="cursor:pointer; display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; letter-spacing:.04em; user-select:none;">
                                                <i class="fa-regular fa-globe text-white" style="font-size:14px;"></i>
                                                <span class="text-white">EN</span>
                                                <i class="fa-solid fa-angle-down text-white" style=""
                                                    :style="open ? 'transform:rotate(180deg)' : ''"></i>
                                            </div>
                                            <div x-show="open" x-transition=""
                                                style="position:absolute; top:calc(100% + 6px); right:0; background:#fff; border:1px solid #e5e7eb; border-radius:6px; min-width:90px; box-shadow:0 4px 16px rgba(0,0,0,.1); z-index:9999; overflow:hidden; display:none;">
                                                <a href="http://carics-togo.test/lang/fr"
                                                    style="display:flex; align-items:center; gap:8px; padding:8px 14px; font-size:13px; font-weight:600; color:#16344F; text-decoration:none; transition:background .15s; "
                                                    onmouseover="this.style.background='#f3f4f6'"
                                                    onmouseout="this.style.background=''" @click="open=false">
                                                    🇫🇷 Français
                                                </a>
                                                <a href="http://carics-togo.test/lang/en"
                                                    style="display:flex; align-items:center; gap:8px; padding:8px 14px; font-size:13px; font-weight:600; color:#16344F; text-decoration:none; transition:background .15s; background:#e0f2fe; color:#0284c7;"
                                                    onmouseover="this.style.background='#f3f4f6'"
                                                    onmouseout="this.style.background='#e0f2fe'" @click="open=false">
                                                    🇬🇧 English
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header-lower anim-fade-move" data-delay="0.25"
                    style="background-color: var(--theme-color-white); translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">
                    <div class="auto-container">
                        <div class="inner-lower px-0">
                            <!-- Main box -->
                            <div class="main-box">
                                <div class="logo-box">
                                    <div class="logo"><a href="http://carics-togo.test"><img
                                                src="http://carics-togo.test/logo_resize.png" alt="Logo"></a>
                                    </div>
                                </div>

                                <!--Nav Box-->
                                <div class="nav-outer">
                                    <nav class="nav main-menu mx-auto">
                                        <ul class="navigation">
                                            <li class="current"><a href="http://carics-togo.test" wire:current=""
                                                    class="" data-current="">Home</a>
                                            </li>
                                            <li class="dropdown"><a href="http://carics-togo.test/a-propos">About</a>
                                                <ul>
                                                    <li><a href="http://carics-togo.test/a-propos">About</a></li>
                                                    <li><a href="http://carics-togo.test/equipe">Governance &amp;
                                                            Leadership</a></li>
                                                </ul>
                                                <div class="dropdown-btn"><i class="fa fa-angle-down"></i></div>
                                            </li>
                                            <li class=""><a
                                                    href="http://carics-togo.test/recherche-expertize-projet">Research
                                                    &amp; Projects</a>
                                            </li>
                                            <li class=""><a
                                                    href="http://carics-togo.test/ressource-publication">Resources &amp;
                                                    Publications</a>
                                            </li>
                                            <li>
                                                <a href="http://carics-togo.test/actu-opportunites">News &amp;
                                                    Opportunities</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                                <!-- Outer Box -->
                                <div class="action-box">
                                    <a href="http://carics-togo.test/contact"
                                        class="theme-btn btn-style-one d-none d-md-flex">
                                        <span class="btn-title">Contact Us</span>
                                    </a>
                                    <!-- Mobile Nav toggler -->
                                    <div class="mobile-nav-toggler"><i class="icon fa-solid fa-bars-staggered"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu  -->
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                <nav class="menu-box">
                    <div class="upper-box">
                        <div class="nav-logo"><a href="http://carics-togo.test"><img
                                    src="http://carics-togo.test/logo.jpeg" alt=""></a>
                        </div>
                        <div class="close-btn"><i class="icon fa fa-times"></i></div>
                    </div>
                    <ul class="navigation clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->

                        <li class="current"><a href="http://carics-togo.test" wire:current="" class=""
                                data-current="">Home</a>
                        </li>
                        <li class="dropdown"><a href="http://carics-togo.test/a-propos">About</a>
                            <ul>
                                <li><a href="http://carics-togo.test/a-propos">About</a></li>
                                <li><a href="http://carics-togo.test/equipe">Governance &amp; Leadership</a></li>
                            </ul>
                            <div class="dropdown-btn"><i class="fa fa-angle-down"></i></div>
                        </li>
                        <li class=""><a href="http://carics-togo.test/recherche-expertize-projet">Research &amp;
                                Projects</a>
                        </li>
                        <li class=""><a href="http://carics-togo.test/ressource-publication">Resources &amp;
                                Publications</a>
                        </li>
                        <li>
                            <a href="http://carics-togo.test/actu-opportunites">News &amp; Opportunities</a>
                        </li>
                    </ul>
                    <ul class="contact-list-one">
                        <li>
                            <i class="icon fal fa-envelope"></i>
                            <span class="title">Send an email</span>
                            <div class="text"><a href="mailto:info@carics.org">info@carics.org</a>
                            </div>
                        </li>
                        <li>
                            <i class="icon fal fa-phone"></i>
                            <span class="title">Call us</span>
                            <div class="text"><a href="tel:+228 91 37 21 34">+228 91 37 21 34</a>
                            </div>
                        </li>
                        <li>
                            <i class="icon fal fa-phone"></i>
                            <span class="title">Call us</span>
                            <div class="text"><a href="tel:+228 90 99 18 59">+228 90 99 18 59</a>
                            </div>
                        </li>
                        <li>
                            <i class="icon fal fa-phone"></i>
                            <span class="title">Call us</span>
                            <div class="text"><a href="tel:+228 99 56 10 55">+228 99 56 10 55</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="social-links">
                        <li><a href="#"><i class="icon fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="icon fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="icon fab fa-pinterest-p"></i></a></li>
                        <li><a href="#"><i class="icon fab fa-vimeo-v"></i></a></li>
                    </ul>
                </nav>
            </div><!-- End Mobile Menu -->

            <!-- Header Search -->
            <div class="search-popup">
                <span class="search-back-drop"></span>
                <button class="close-search"><span class="fa fa-times"></span></button>

                <div class="search-inner">
                    <form method="post" action="http://carics-togo.test">
                        <div class="form-group">
                            <input type="search" name="search-field" value="" placeholder="Search..." required="">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Header Search -->


        </header>
        <!--End Main Header -->

        <div wire:snapshot="{&quot;data&quot;:{&quot;search&quot;:&quot;&quot;,&quot;selectedStatus&quot;:&quot;all&quot;},&quot;memo&quot;:{&quot;id&quot;:&quot;sMKYKaiUE6T9DAezxOpP&quot;,&quot;name&quot;:&quot;archinest::research_expertize_project&quot;,&quot;path&quot;:&quot;recherche-expertize-projet&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;release&quot;:&quot;a-a-a&quot;,&quot;children&quot;:[],&quot;scripts&quot;:[],&quot;assets&quot;:[],&quot;errors&quot;:[],&quot;locale&quot;:&quot;en&quot;,&quot;islands&quot;:[]},&quot;checksum&quot;:&quot;60a4aa50c08abcfddc882577fbd1f95afa549d53b66d12fe3c2745172996c077&quot;}"
            wire:effects="{&quot;partials&quot;:[],&quot;url&quot;:{&quot;search&quot;:{&quot;as&quot;:&quot;q&quot;,&quot;use&quot;:&quot;replace&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;selectedStatus&quot;:{&quot;as&quot;:&quot;status&quot;,&quot;use&quot;:&quot;replace&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null}}}"
            wire:id="sMKYKaiUE6T9DAezxOpP" wire:name="archinest::research_expertize_project" x-data="{ 
    selectedProject: null,
    openProjectModal(project) {
        this.selectedProject = project;
    },
    closeProjectModal() {
        this.selectedProject = null;
    }
}">
            <!-- Start main-content -->
            <section class="page-title" style="background-image: url(http://carics-togo.test/images/banner.jpg);">
                <div class="auto-container">
                    <div class="title-outer text-center">
                        <h1 class="title">Our Areas of Expertise</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="http://carics-togo.test">Home</a></li>
                            <li>Our Areas of Expertise</li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- end main-content -->

            <!-- ============ SECTION 1 : DOMAINES D'EXPERTISE & PRIORITÉS SCIENTIFIQUES ============ -->
            <section class="section py-5" style="background: #ffffff;">
                <div class="container">
                    <!-- En-tête de section -->
                    <div class="row align-items-end mb-5">
                        <div class="col-lg-8">
                            <div
                                class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                                <i class="fa fa-solid fa-flask-vial"></i> Pôle d'Excellence &amp; Axes Stratégiques
                            </div>
                            <h2 class="h2 fw-bold text-dark mb-2">Our Expertise &amp; Research</h2>
                            <p class="text-secondary lead mb-0" style="font-size: 1.08rem; line-height: 1.7;">
                                CARICS-Togo designs and implements applied research, program evaluation, and public
                                health innovation to produce reliable evidence for decision-making.
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <a href="http://carics-togo.test/contact"
                                class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
                                <span>Learn more</span>
                                <i class="fa fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Grille Bento des 6 Domaines d'Expertise -->
                    <div class="row g-4 mb-5">
                        <!-- Domaine 1 -->
                        <div class="col-md-6 col-lg-4">
                            <div
                                class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary-subtle text-primary mb-3"
                                        style="width: 48px; height: 48px; font-size: 1.4rem;">
                                        <i class="fa fa-solid fa-microscope"></i>
                                    </div>
                                    <h3 class="h5 fw-bold text-dark mb-2">Public Health and Epidemiology</h3>
                                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                        Generation, analysis, and interpretation of data to understand health
                                        determinants, monitor epidemiological trends, and inform public health policies
                                        and programs.
                                    </p>
                                </div>
                                <div class="pt-3 mt-3 border-top text-primary small fw-semibold">
                                    <i class="fa fa-solid fa-check-circle me-1"></i> Épidémiologie appliquée
                                </div>
                            </div>
                        </div>

                        <!-- Domaine 2 -->
                        <div class="col-md-6 col-lg-4">
                            <div
                                class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success-subtle text-success mb-3"
                                        style="width: 48px; height: 48px; font-size: 1.4rem;">
                                        <i class="fa fa-solid fa-gears"></i>
                                    </div>
                                    <h3 class="h5 fw-bold text-dark mb-2">Operational Research and Implementation
                                        Science</h3>
                                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                        Evaluating health interventions under real-world implementation conditions to
                                        identify factors influencing their coverage, quality, effectiveness, and
                                        sustainability.
                                    </p>
                                </div>
                                <div class="pt-3 mt-3 border-top text-success small fw-semibold">
                                    <i class="fa fa-solid fa-check-circle me-1"></i> Sciences de la mise en œuvre
                                </div>
                            </div>
                        </div>

                        <!-- Domaine 3 -->
                        <div class="col-md-6 col-lg-4">
                            <div
                                class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-info-subtle text-info mb-3"
                                        style="width: 48px; height: 48px; font-size: 1.4rem;">
                                        <i class="fa fa-solid fa-people-roof"></i>
                                    </div>
                                    <h3 class="h5 fw-bold text-dark mb-2">Community Health</h3>
                                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                        Designing, implementing, and evaluating innovative approaches to enhance access,
                                        utilization, and quality of community-level health services.
                                    </p>
                                </div>
                                <div class="pt-3 mt-3 border-top text-info small fw-semibold">
                                    <i class="fa fa-solid fa-check-circle me-1"></i> Approches communautaires
                                </div>
                            </div>
                        </div>

                        <!-- Domaine 4 -->
                        <div class="col-md-6 col-lg-4">
                            <div
                                class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-warning-subtle text-warning-emphasis mb-3"
                                        style="width: 48px; height: 48px; font-size: 1.4rem;">
                                        <i class="fa fa-solid fa-landmark"></i>
                                    </div>
                                    <h3 class="h5 fw-bold text-dark mb-2">Health Systems and Public Policy</h3>
                                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                        Analyses and evaluations aimed at improving health systems performance,
                                        resilience, equity, and governance.
                                    </p>
                                </div>
                                <div class="pt-3 mt-3 border-top text-warning-emphasis small fw-semibold">
                                    <i class="fa fa-solid fa-check-circle me-1"></i> Gouvernance &amp; Équité
                                </div>
                            </div>
                        </div>

                        <!-- Domaine 5 -->
                        <div class="col-md-6 col-lg-4">
                            <div
                                class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-danger-subtle text-danger mb-3"
                                        style="width: 48px; height: 48px; font-size: 1.4rem;">
                                        <i class="fa fa-solid fa-chart-pie"></i>
                                    </div>
                                    <h3 class="h5 fw-bold text-dark mb-2">Design, Implementation, and M&amp;E of Health
                                        Programs</h3>
                                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                        Technical support to institutions, organizations, and partners for planning,
                                        implementation, monitoring, and evaluation of public health programs and
                                        projects.
                                    </p>
                                </div>
                                <div class="pt-3 mt-3 border-top text-danger small fw-semibold">
                                    <i class="fa fa-solid fa-check-circle me-1"></i> Suivi-évaluation &amp; Données
                                </div>
                            </div>
                        </div>

                        <!-- Domaine 6 -->
                        <div class="col-md-6 col-lg-4">
                            <div
                                class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-purple-subtle text-primary mb-3"
                                        style="width: 48px; height: 48px; font-size: 1.4rem; background: #ede9fe; color: #6d28d9;">
                                        <i class="fa fa-solid fa-laptop-medical"></i>
                                    </div>
                                    <h3 class="h5 fw-bold text-dark mb-2">Digital Innovation and Artificial Intelligence
                                    </h3>
                                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                        Developing and leveraging digital solutions, data management and analytics
                                        tools, and innovative approaches to boost health program performance.
                                    </p>
                                </div>
                                <div class="pt-3 mt-3 border-top text-primary small fw-semibold">
                                    <i class="fa fa-solid fa-check-circle me-1"></i> Santé numérique &amp; IA
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panneau des 8 Priorités de Recherche Nationales -->
                    <div class="card border-0 rounded-4 shadow-sm p-4 p-lg-5 text-white"
                        style="background: linear-gradient(135deg, #1B3A6B 0%, #008A5E 100%);">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-4">
                                <div
                                    class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-20 text-white fw-semibold small mb-2">
                                    <i class="fa fa-solid fa-bullseye"></i> Orientations Stratégiques
                                </div>
                                <h3 class="h3 fw-bold text-white mb-2">Research Priorities</h3>
                                <p class="text-white-50 small mb-0">
                                    CARICS research activities primarily focus on the following domains:
                                </p>
                            </div>
                            <div class="col-lg-8">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div
                                            class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                            <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                                style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">1</span>
                                            <span class="small text-white">Infectious and tropical diseases;</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                            <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                                style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">2</span>
                                            <span class="small text-white">Maternal, newborn, child, and adolescent
                                                health;</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                            <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                                style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">3</span>
                                            <span class="small text-white">Health systems strengthening;</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                            <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                                style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">4</span>
                                            <span class="small text-white">Community health;</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                            <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                                style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">5</span>
                                            <span class="small text-white">Fragile, humanitarian, and conflict-affected
                                                settings;</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                            <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                                style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">6</span>
                                            <span class="small text-white">Digital health and health information
                                                systems;</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                            <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                                style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">7</span>
                                            <span class="small text-white">Implementation science and operational
                                                research;</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                            <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                                style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">8</span>
                                            <span class="small text-white">Non-communicable disease prevention and
                                                control.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============ SECTION 2 : PROJET PHARE EN VEDETTE (SHOWCASE HERO) ============ -->
            <section class="section py-5 bg-light" id="projet-phare">
                <div class="container">
                    <div class="card border-0 rounded-4 shadow-sm overflow-hidden bg-white p-4 p-lg-5">
                        <!-- En-tête du Projet Phare -->
                        <div class="row align-items-center mb-4 pb-4 border-bottom g-3">
                            <div class="col-lg-8">
                                <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                                    <span class="badge bg-primary text-white fw-semibold px-3 py-1 rounded-pill">
                                        <i class="fa fa-solid fa-star me-1 text-warning"></i> Our Current Flagship
                                        Project
                                    </span>
                                    <!--[if BLOCK]><![endif]--> <span
                                        class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-semibold">
                                        <i class="fa fa-solid fa-circle-dot me-1"></i> Ongoing project
                                    </span>
                                    <!--[if ENDBLOCK]><![endif]--> <!--[if BLOCK]><![endif]--> <span
                                        class="badge bg-light text-muted border px-3 py-1 rounded-pill small">
                                        <i class="fa fa-solid fa-location-dot text-danger me-1"></i> Région des Savanes
                                    </span>
                                    <!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <h2 class="h3 fw-bold text-dark mb-0" style="line-height: 1.4;">
                                    Évaluation de la fidélité de mise en œuvre, de la couverture et de l’adhésion à la
                                    ChimioPrévention du Paludisme Saisonnier (CPS) dans la Région des Savanes au Togo
                                </h2>
                            </div>
                            <div class="col-lg-4 text-lg-end">
                                <a href="http://carics-togo.test/contact"
                                    class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                                    <i class="fa fa-solid fa-handshake me-1"></i> navigation.actions.collaborate
                                </a>
                            </div>
                        </div>

                        <!-- Métadonnées en cartes badges -->
                        <div class="row g-3 mb-4">
                            <!-- Période -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 h-100 border">
                                    <div class="text-muted small mb-1"><i
                                            class="fa fa-regular fa-calendar text-primary me-1"></i> Period:</div>
                                    <strong class="text-dark">
                                        <!--[if BLOCK]><![endif]--> 2026 – 2027
                                        <!--[if ENDBLOCK]><![endif]--> </strong>
                                </div>
                            </div>

                            <!-- Financement / Bailleur -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 h-100 border">
                                    <div class="text-muted small mb-1"><i
                                            class="fa fa-solid fa-hand-holding-dollar text-success me-1"></i> Funding:
                                    </div>
                                    <strong class="text-dark">Royal Society of Tropical Medicine and Hygiene
                                        (RSTMH)</strong>
                                </div>
                            </div>

                            <!-- Zone d'intervention -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 h-100 border">
                                    <div class="text-muted small mb-1"><i
                                            class="fa fa-solid fa-map-pin text-danger me-1"></i> Intervention Area:
                                    </div>
                                    <strong class="text-dark">
                                        <!--[if BLOCK]><![endif]--> <!--[if BLOCK]><![endif]--> Tône, Kpendjal,
                                        Kpendjal-Ouest, Oti, Oti-Sud, Tandjouaré, Cinkassé
                                        <!--[if ENDBLOCK]><![endif]--> <!--[if ENDBLOCK]><![endif]--> </strong>
                                </div>
                            </div>

                            <!-- Chef de projet / Investigateur -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 h-100 border">
                                    <div class="text-muted small mb-1"><i
                                            class="fa fa-solid fa-user-tie text-primary me-1"></i> Investigateur
                                        Principal</div>
                                    <strong class="text-dark">
                                        <!--[if BLOCK]><![endif]--> <a
                                            href="http://carics-togo.test/equipe/gountante-kombate"
                                            class="text-decoration-none text-primary">
                                            Dr Gountante KOMBATE
                                        </a>
                                        <!--[if ENDBLOCK]><![endif]--> </strong>
                                </div>
                            </div>
                        </div>

                        <!-- Corps du Projet Phare (2 Colonnes) -->
                        <div class="row g-4">
                            <!-- Colonne Gauche : Contexte & Objectifs -->
                            <div class="col-lg-6">
                                <!-- Contexte -->
                                <div class="mb-4">
                                    <h3 class="h5 fw-bold text-dark mb-3">
                                        <i class="fa fa-solid fa-book-open text-primary me-2"></i> Context
                                    </h3>
                                    <div class="text-secondary" style="line-height: 1.8;">
                                        La Région des Savanes au Togo fait face à une transmission palustre hautement
                                        saisonnière et à des défis sécuritaires et migratoires transfrontaliers. La CPS
                                        y constitue une stratégie clé pour protéger les enfants de moins de 5 ans contre
                                        le paludisme grave.
                                    </div>
                                </div>

                                <!-- Objectifs -->
                                <div class="mb-4">
                                    <h3 class="h5 fw-bold text-dark mb-3">
                                        <i class="fa fa-solid fa-bullseye text-success me-2"></i> Objective
                                    </h3>
                                    <div class="text-secondary" style="line-height: 1.8;">
                                        Mesurer avec rigueur la fidélité de mise en œuvre des cycles de CPS, évaluer la
                                        couverture effective et identifier les déterminants socio-comportementaux de
                                        l'adhésion complète au traitement chez les enfants ciblés.
                                    </div>
                                </div>
                            </div>

                            <!-- Colonne Droite : Résultats attendus & Perspectives -->
                            <div class="col-lg-6">
                                <div class="p-4 rounded-4 bg-light border h-100">
                                    <!-- Résultats attendus -->
                                    <div class="mb-4">
                                        <h3 class="h5 fw-bold text-dark mb-3">
                                            <i class="fa fa-solid fa-clipboard-check text-primary me-2"></i> Expected
                                            Results
                                        </h3>
                                        <div>
                                            <!--[if BLOCK]><![endif]--> <!--[if BLOCK]><![endif]-->
                                            <ul class="list-unstyled mb-0">
                                                <!--[if BLOCK]><![endif]-->
                                                <li class="d-flex align-items-start gap-2 mb-3">
                                                    <i class="fa fa-solid fa-circle-check text-success mt-1"></i>
                                                    <div class="small text-secondary" style="line-height: 1.6;">
                                                        Estimation précise des taux de couverture administrative vs
                                                        couverture réelle vérifiée.
                                                    </div>
                                                </li>
                                                <li class="d-flex align-items-start gap-2 mb-3">
                                                    <i class="fa fa-solid fa-circle-check text-success mt-1"></i>
                                                    <div class="small text-secondary" style="line-height: 1.6;">
                                                        Cartographie des goulots d'étranglement de la fidélité
                                                        d'administration des jours 2 et 3.
                                                    </div>
                                                </li>
                                                <li class="d-flex align-items-start gap-2 mb-3">
                                                    <i class="fa fa-solid fa-circle-check text-success mt-1"></i>
                                                    <div class="small text-secondary" style="line-height: 1.6;">
                                                        Recommandations opérationnelles concrètes transmises au
                                                        Ministère de la Santé et au PNLP pour adapter les futures
                                                        campagnes.
                                                    </div>
                                                </li>
                                                <li class="d-flex align-items-start gap-2 mb-3">
                                                    <i class="fa fa-solid fa-circle-check text-success mt-1"></i>
                                                    <div class="small text-secondary" style="line-height: 1.6;">
                                                        Publications scientifiques internationales et notes de politique
                                                        pour les décideurs de la sous-région.
                                                    </div>
                                                </li>
                                                <!--[if ENDBLOCK]><![endif]-->
                                            </ul>
                                            <!--[if ENDBLOCK]><![endif]--> <!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </div>

                                    <!-- Perspectives -->
                                    <div class="pt-3 border-top">
                                        <h4 class="h6 fw-bold text-dark mb-2">
                                            <i class="fa fa-solid fa-compass text-info me-2"></i> Perspectives
                                        </h4>
                                        <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                            CARICS is currently expanding its portfolio of research projects and
                                            scientific partnerships across multiple priority public health areas in Togo
                                            and West Africa.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============ SECTION 3 : CARTE INTERACTIVE DES INTERVENTIONS AU TOGO ============ -->
            <section class="section py-5 bg-white">
                <div class="container">
                    <div class="text-center max-w-700 mx-auto mb-5">
                        <div
                            class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                            <i class="fa fa-solid fa-map-location-dot"></i> Couverture Nationale
                        </div>
                        <h2 class="h3 fw-bold text-dark mb-2">Implantation Territoriale &amp; Sites d'Intervention</h2>
                        <p class="text-muted">
                            Découvrez la répartition des projets de recherche et d'action sociale menés par le CARICS à
                            travers les 5 régions du Togo.
                        </p>
                    </div>

                    <div x-data="{
        activeRegion: 'Maritime',
        regionData: {
            'Savanes': {
                name: 'Région des Savanes',
                chefLieu: 'Dapaong',
                projectsCount: 1,
                description: 'Interventions prioritaires en santé maternelle, résilience communautaire et accès aux soins de santé primaire dans l\'extrême nord.'
            },
            'Kara': {
                name: 'Région de la Kara',
                chefLieu: 'Kara',
                projectsCount: 0,
                description: 'Études épidémiologiques régionales, santé communautaire et renforcement des capacités des agents de santé.'
            },
            'Centrale': {
                name: 'Région Centrale',
                chefLieu: 'Sokodé',
                projectsCount: 0,
                description: 'Programmes de changement de comportement, nutrition communautaire et appui aux centres médico-sociaux.'
            },
            'Plateaux': {
                name: 'Région des Plateaux',
                chefLieu: 'Atakpamé / Kpalimé',
                projectsCount: 0,
                description: 'Recherche-action sur la santé reproductive des adolescents, hygiène de l\'eau et maladies infectieuses endémiques.'
            },
            'Maritime': {
                name: 'Région Maritime &amp; Grand Lomé',
                chefLieu: 'Lomé',
                projectsCount: 0,
                description: 'Siège opérationnel, études cliniques urbaines et périurbaines, coordination nationale des enquêtes socio-sanitaires.'
            }
        }
    }" class="card border-0 shadow-lg rounded-4 overflow-hidden p-4 p-lg-5"
                        style="background: linear-gradient(145deg, #ffffff 0%, #f4f8fc 100%);">
                        <div class="row align-items-center g-4">
                            <!-- SVG Map Container -->
                            <div class="col-lg-5 text-center">
                                <div class="position-relative d-inline-block">
                                    <svg viewBox="0 0 280 500" class="togo-map-svg"
                                        style="max-height: 420px; width: auto; filter: drop-shadow(0 10px 15px rgba(27, 58, 107, 0.15));">
                                        <defs>
                                            <linearGradient id="gradMaritime" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" stop-color="#008A5E"></stop>
                                                <stop offset="100%" stop-color="#1B3A6B"></stop>
                                            </linearGradient>
                                            <linearGradient id="gradHover" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" stop-color="#22c55e"></stop>
                                                <stop offset="100%" stop-color="#15803d"></stop>
                                            </linearGradient>
                                        </defs>

                                        <!-- Savanes (Nord) -->
                                        <path d="M60,20 L220,15 L230,75 L180,105 L80,95 L50,60 Z"
                                            :fill="activeRegion === 'Savanes' ? '#1B3A6B' : '#93c5fd'"
                                            :stroke="activeRegion === 'Savanes' ? '#ffffff' : '#ffffff'"
                                            stroke-width="2" @click="activeRegion = 'Savanes'"
                                            @mouseenter="activeRegion = 'Savanes'"
                                            class="region-path cursor-pointer transition-all"
                                            style="transition: all 0.3s ease;" fill="#93c5fd" stroke="#ffffff">
                                            <title>Région des Savanes</title>
                                        </path>
                                        <text x="140" y="55" text-anchor="middle" fill="#ffffff" font-size="11"
                                            font-weight="bold" pointer-events="none"
                                            class="animate-stroke">SAVANES</text>

                                        <!-- Kara (Nord-Centre) -->
                                        <path d="M80,95 L180,105 L210,165 L170,195 L95,185 L65,135 Z"
                                            :fill="activeRegion === 'Kara' ? '#1B3A6B' : '#60a5fa'"
                                            :stroke="activeRegion === 'Kara' ? '#ffffff' : '#ffffff'" stroke-width="2"
                                            @click="activeRegion = 'Kara'" @mouseenter="activeRegion = 'Kara'"
                                            class="region-path cursor-pointer transition-all"
                                            style="transition: all 0.3s ease;" fill="#60a5fa" stroke="#ffffff">
                                            <title>Région de la Kara</title>
                                        </path>
                                        <text x="135" y="145" text-anchor="middle" fill="#ffffff" font-size="11"
                                            font-weight="bold" pointer-events="none">KARA</text>

                                        <!-- Centrale (Centre) -->
                                        <path d="M95,185 L170,195 L200,270 L140,290 L75,275 L80,215 Z"
                                            :fill="activeRegion === 'Centrale' ? '#1B3A6B' : '#3b82f6'"
                                            :stroke="activeRegion === 'Centrale' ? '#ffffff' : '#ffffff'"
                                            stroke-width="2" @click="activeRegion = 'Centrale'"
                                            @mouseenter="activeRegion = 'Centrale'"
                                            class="region-path cursor-pointer transition-all"
                                            style="transition: all 0.3s ease;" fill="#3b82f6" stroke="#ffffff">
                                            <title>Région Centrale</title>
                                        </path>
                                        <text x="135" y="235" text-anchor="middle" fill="#ffffff" font-size="11"
                                            font-weight="bold" pointer-events="none">CENTRALE</text>

                                        <!-- Plateaux (Sud-Centre) -->
                                        <path d="M75,275 L140,290 L195,330 L180,410 L90,400 L50,335 Z"
                                            :fill="activeRegion === 'Plateaux' ? '#1B3A6B' : '#2563eb'"
                                            :stroke="activeRegion === 'Plateaux' ? '#ffffff' : '#ffffff'"
                                            stroke-width="2" @click="activeRegion = 'Plateaux'"
                                            @mouseenter="activeRegion = 'Plateaux'"
                                            class="region-path cursor-pointer transition-all"
                                            style="transition: all 0.3s ease;" fill="#2563eb" stroke="#ffffff">
                                            <title>Région des Plateaux</title>
                                        </path>
                                        <text x="125" y="345" text-anchor="middle" fill="#ffffff" font-size="11"
                                            font-weight="bold" pointer-events="none">PLATEAUX</text>

                                        <!-- Maritime & Lomé (Sud) -->
                                        <path d="M90,400 L180,410 L195,475 L120,490 L85,465 Z"
                                            :fill="activeRegion === 'Maritime' ? '#1B3A6B' : '#1d4ed8'"
                                            :stroke="activeRegion === 'Maritime' ? '#ffffff' : '#ffffff'"
                                            stroke-width="2" @click="activeRegion = 'Maritime'"
                                            @mouseenter="activeRegion = 'Maritime'"
                                            class="region-path cursor-pointer transition-all"
                                            style="transition: all 0.3s ease;" fill="#1B3A6B" stroke="#ffffff">
                                            <title>Région Maritime &amp; Lomé</title>
                                        </path>
                                        <text x="135" y="445" text-anchor="middle" fill="#ffffff" font-size="11"
                                            font-weight="bold" pointer-events="none">MARITIME</text>

                                        <!-- Point Capitale Lomé -->
                                        <circle cx="125" cy="480" r="5" fill="#f59e0b" stroke="#ffffff"
                                            stroke-width="2"></circle>
                                        <text x="140" y="484" fill="#1B3A6B" font-size="9" font-weight="bold">Lomé
                                            (Siège)</text>
                                    </svg>
                                </div>
                                <p class="text-muted small mt-2">
                                    <i class="fa fa-solid fa-hand-pointer text-primary me-1"></i> Cliquez sur une région
                                    pour afficher les détails d'intervention
                                </p>
                            </div>

                            <!-- Region Details Panel -->
                            <div class="col-lg-7">
                                <div class="p-4 bg-white rounded-4 border shadow-sm">
                                    <!-- En-tête Région -->
                                    <div
                                        class="d-flex justify-content-between align-items-start mb-3 border-bottom pb-3">
                                        <div>
                                            <span
                                                class="badge bg-primary-subtle text-primary fw-semibold px-3 py-1 rounded-pill mb-1">
                                                Zone d'Intervention
                                            </span>
                                            <h3 class="h4 fw-bold text-dark mb-0"
                                                x-text="regionData[activeRegion].name">Région Maritime &amp; Grand Lomé
                                            </h3>
                                        </div>
                                        <div class="text-end">
                                            <span
                                                class="badge bg-success-subtle text-success fs-6 px-3 py-2 rounded-pill">
                                                <i class="fa fa-solid fa-microscope me-1"></i>
                                                <strong x-text="regionData[activeRegion].projectsCount">0</strong>
                                                projets
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Chef lieu -->
                                    <p class="text-muted small mb-3">
                                        <i class="fa fa-solid fa-location-dot text-danger me-1"></i>
                                        Pôle régional : <strong class="text-dark"
                                            x-text="regionData[activeRegion].chefLieu">Lomé</strong>
                                    </p>

                                    <!-- Description -->
                                    <div class="p-3 bg-light rounded-3 mb-4">
                                        <p class="text-secondary small mb-0" style="line-height: 1.6;"
                                            x-text="regionData[activeRegion].description">Siège opérationnel, études
                                            cliniques urbaines et périurbaines, coordination nationale des enquêtes
                                            socio-sanitaires.</p>
                                    </div>

                                    <!-- Boutons Sélecteurs rapides de Régions -->
                                    <div class="d-flex flex-wrap gap-2">
                                        <template x-for="(data, key) in regionData" :key="key">
                                            <button type="button" @click="activeRegion = key"
                                                class="btn btn-sm rounded-pill px-3 transition-all"
                                                :class="activeRegion === key ? 'btn-primary shadow-sm' : 'btn-outline-secondary bg-white'"
                                                x-text="key"></button>
                                        </template><button type="button" @click="activeRegion = key"
                                            class="btn btn-sm rounded-pill px-3 transition-all btn-outline-secondary bg-white"
                                            :class="activeRegion === key ? 'btn-primary shadow-sm' : 'btn-outline-secondary bg-white'"
                                            x-text="key">Savanes</button><button type="button"
                                            @click="activeRegion = key"
                                            class="btn btn-sm rounded-pill px-3 transition-all btn-outline-secondary bg-white"
                                            :class="activeRegion === key ? 'btn-primary shadow-sm' : 'btn-outline-secondary bg-white'"
                                            x-text="key">Kara</button><button type="button" @click="activeRegion = key"
                                            class="btn btn-sm rounded-pill px-3 transition-all btn-outline-secondary bg-white"
                                            :class="activeRegion === key ? 'btn-primary shadow-sm' : 'btn-outline-secondary bg-white'"
                                            x-text="key">Centrale</button><button type="button"
                                            @click="activeRegion = key"
                                            class="btn btn-sm rounded-pill px-3 transition-all btn-outline-secondary bg-white"
                                            :class="activeRegion === key ? 'btn-primary shadow-sm' : 'btn-outline-secondary bg-white'"
                                            x-text="key">Plateaux</button><button type="button"
                                            @click="activeRegion = key"
                                            class="btn btn-sm rounded-pill px-3 transition-all btn-primary shadow-sm"
                                            :class="activeRegion === key ? 'btn-primary shadow-sm' : 'btn-outline-secondary bg-white'"
                                            x-text="key">Maritime</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============ SECTION 4 : EXPLORATEUR DE TOUS LES PROJETS DE RECHERCHE ============ -->
            <section class="section py-5 bg-light" id="repertoire-projets">
                <div class="container">
                    <!-- En-tête & Barre de recherche -->
                    <div class="row align-items-center mb-4">
                        <div class="col-lg-7">
                            <div
                                class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success-subtle text-success fw-semibold small mb-2">
                                <i class="fa fa-solid fa-folder-tree"></i> Répertoire Scientifique
                            </div>
                            <h2 class="h3 fw-bold text-dark mb-1">Tous nos Projets de Recherche</h2>
                            <p class="text-muted mb-0">Consultez l'ensemble des études menées par nos équipes et
                                partenaires.</p>
                        </div>
                        <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                            <span class="badge bg-white text-dark border px-3 py-2 fs-6 shadow-sm rounded-pill">
                                <strong class="text-primary">1</strong> projets répertoriés
                            </span>
                        </div>
                    </div>

                    <!-- Filtres interactifs -->
                    <div class="card p-3 p-md-4 border-0 shadow-sm rounded-4 mb-4"
                        style="background: linear-gradient(135deg, #f8faff 0%, #f0f6ff 100%);">
                        <div class="row g-3 align-items-center">
                            <div class="col-lg-7">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                                        <i class="fa fa-solid fa-search text-muted"></i>
                                    </span>
                                    <input type="text" wire:model.live.debounce.300ms="search"
                                        class="form-control border-start-0 rounded-end-pill py-2 shadow-none"
                                        placeholder="Rechercher par mot-clé, thématique, bailleur, région...">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="d-flex gap-2">
                                    <select wire:model.live="selectedStatus"
                                        class="form-select rounded-pill py-2 shadow-none">
                                        <option value="all">🔍 Tous les statuts</option>
                                        <option value="en_cours">🟢 En cours</option>
                                        <option value="termine">🔵 Achevés</option>
                                        <option value="en_attente">🟡 En préparation</option>
                                    </select>
                                    <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </div>

                        <!-- Onglets statut rapides -->
                        <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">
                            <button type="button" wire:click="$set('selectedStatus', 'all')"
                                class="btn btn-sm rounded-pill px-3 btn-primary">
                                Tous les projets
                            </button>
                            <button type="button" wire:click="$set('selectedStatus', 'en_cours')"
                                class="btn btn-sm rounded-pill px-3 btn-outline-secondary bg-white">
                                🟢 En cours
                            </button>
                            <button type="button" wire:click="$set('selectedStatus', 'termine')"
                                class="btn btn-sm rounded-pill px-3 btn-outline-secondary bg-white">
                                🔵 Achevés
                            </button>
                            <button type="button" wire:click="$set('selectedStatus', 'en_attente')"
                                class="btn btn-sm rounded-pill px-3 btn-outline-secondary bg-white">
                                🟡 En préparation
                            </button>
                        </div>
                    </div>

                    <!-- Grille de cartes de projets -->
                    <div wire:loading.flex="" class="justify-content-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Chargement des projets...</span>
                        </div>
                    </div>

                    <div wire:loading.remove="">
                        <!--[if BLOCK]><![endif]-->
                        <div class="row g-4">
                            <!--[if BLOCK]><![endif]-->
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="card h-100 border rounded-4 shadow-sm bg-white p-4 d-flex flex-column justify-content-between transition-all hover-shadow">
                                    <div>
                                        <!-- En-tête de carte -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span
                                                class="badge bg-success-subtle text-success fw-semibold px-3 py-1 rounded-pill small">
                                                En cours
                                            </span>
                                            <!--[if BLOCK]><![endif]--> <span
                                                class="badge bg-light text-muted border small">
                                                <i class="fa fa-solid fa-location-dot me-1 text-danger"></i>Région des
                                                Savanes
                                            </span>
                                            <!--[if ENDBLOCK]><![endif]-->
                                        </div>

                                        <!-- Titre -->
                                        <h3 class="h5 fw-bold text-dark mb-2" style="line-height: 1.4;">
                                            Évaluation de la fidélité de mise en œuvre, de la couverture et de
                                            l’adhésion à la ChimioPrévention du Paludisme Saisonnier (CPS) dans la
                                            Région des Savanes au Togo
                                        </h3>

                                        <!-- Bailleur & Date -->
                                        <div class="d-flex flex-wrap gap-2 text-muted small mb-3">
                                            <!--[if BLOCK]><![endif]--> <span><i
                                                    class="fa fa-solid fa-hand-holding-dollar text-success me-1"></i>Royal
                                                Society of Tropical Medicine and Hygiene (RSTMH)</span>
                                            <!--[if ENDBLOCK]><![endif]--> <!--[if BLOCK]><![endif]--> <span>• <i
                                                    class="fa fa-regular fa-calendar me-1"></i>2026–2027</span>
                                            <!--[if ENDBLOCK]><![endif]-->
                                        </div>

                                        <!-- Extrait Contexte -->
                                        <!--[if BLOCK]><![endif]-->
                                        <p class="text-secondary small mb-3" style="line-height: 1.6;">
                                            La Région des Savanes au Togo fait face à une transmission palustre
                                            hautement saisonnière et à des défis sécuritaires et migratoir...
                                        </p>
                                        <!--[if ENDBLOCK]><![endif]-->
                                    </div>

                                    <!-- Pied de carte -->
                                    <div
                                        class="pt-3 border-top d-flex justify-content-between align-items-center gap-2">
                                        <small class="text-muted text-truncate" style="max-width: 140px;">
                                            <!--[if BLOCK]><![endif]--> <i class="fa fa-solid fa-user-tie me-1"></i> Dr
                                            Gountante KOMBATE
                                            <!--[if ENDBLOCK]><![endif]--> </small>

                                        <div class="d-flex gap-1">
                                            <button type="button"
                                                @click="openProjectModal(JSON.parse('{\u0022title\u0022:\u0022Évaluation de la fidélité de mise en œuvre, de la couverture et de l’adhésion à la ChimioPrévention du Paludisme Saisonnier (CPS) dans la Région des Savanes au Togo\u0022,\u0022status\u0022:\u0022en_cours\u0022,\u0022statusLabel\u0022:\u0022En cours\u0022,\u0022statusClass\u0022:\u0022bg-success-subtle text-success\u0022,\u0022region\u0022:\u0022Région des Savanes\u0022,\u0022funder\u0022:\u0022Royal Society of Tropical Medicine and Hygiene (RSTMH)\u0022,\u0022period\u0022:\u00222026 – 2027\u0022,\u0022lead\u0022:\u0022Dr Gountante KOMBATE\u0022,\u0022context\u0022:\u0022La Région des Savanes au Togo fait face à une transmission palustre hautement saisonnière et à des défis sécuritaires et migratoires transfrontaliers. La CPS y constitue une stratégie clé pour protéger les enfants de moins de 5 ans contre le paludisme grave.\u0022,\u0022objective\u0022:\u0022Mesurer avec rigueur la fidélité de mise en œuvre des cycles de CPS, évaluer la couverture effective et identifier les déterminants socio-comportementaux de l\\u0027adhésion complète au traitement chez les enfants ciblés.\u0022,\u0022methodology\u0022:\u0022Approche mixte combinant des enquêtes quantitatives représentatives auprès des ménages après chaque passage de CPS, des observations directes de l\\u0027administration des doses par les distributeurs communautaires, et des entretiens qualitatifs approfondis avec les soignants, leaders communautaires et professionnels de santé.\u0022,\u0022expectedResults\u0022:[\u0022Estimation précise des taux de couverture administrative vs couverture réelle vérifiée.\u0022,\u0022Cartographie des goulots d\\u0027étranglement de la fidélité d\\u0027administration des jours 2 et 3.\u0022,\u0022Recommandations opérationnelles concrètes transmises au Ministère de la Santé et au PNLP pour adapter les futures campagnes.\u0022,\u0022Publications scientifiques internationales et notes de politique pour les décideurs de la sous-région.\u0022],\u0022zones\u0022:\u0022Tône, Kpendjal, Kpendjal-Ouest, Oti, Oti-Sud, Tandjouaré, Cinkassé\u0022}'))"
                                                class="btn btn-sm btn-light border rounded-pill px-3">
                                                <i class="fa fa-solid fa-circle-info me-1"></i> Détails
                                            </button>

                                            <a href="http://carics-togo.test/contact"
                                                class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                Partenariat <i class="fa fa-solid fa-arrow-right ms-1 small"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </section>

            <!-- ============ MODAL ALPINE.JS : DÉTAILS COMPLETS DU PROJET ============ -->
            <template x-teleport="body" data-teleport-template="true">
                <div x-show="selectedProject !== 'hrtr'" x-cloak=""
                    class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center p-3"
                    style="background: rgba(15, 23, 42, 0.65); z-index: 1050; backdrop-filter: blur(4px);"
                    @keydown.escape.window="closeProjectModal()">
                    <div @click.away="closeProjectModal()"
                        class="card border-0 rounded-4 shadow-lg w-100 overflow-hidden bg-white"
                        style="max-width: 800px; max-height: 90vh;">
                        <!-- En-tête Modal -->
                        <div class="p-4 border-bottom d-flex justify-content-between align-items-start bg-light">
                            <div class="pe-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                                    <span class="badge" :class="selectedProject?.statusClass"
                                        x-text="selectedProject?.statusLabel"></span>
                                    <template x-if="selectedProject?.region">
                                        <span class="badge bg-white text-muted border">
                                            <i class="fa fa-solid fa-location-dot text-danger me-1"></i>
                                            <span x-text="selectedProject?.region"></span>
                                        </span>
                                    </template>
                                </div>
                                <h3 class="h5 fw-bold text-dark mb-0" x-text="selectedProject?.title"></h3>
                            </div>
                            <button type="button" @click="closeProjectModal()"
                                class="btn btn-sm btn-light rounded-circle p-2 shadow-none"
                                style="width: 36px; height: 36px;">
                                <i class="fa fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <!-- Corps Modal (Déroulant) -->
                        <div class="p-4 overflow-auto" style="max-height: calc(90vh - 140px);">
                            <!-- Métadonnées rapides -->
                            <div class="row g-2 mb-4">
                                <template x-if="selectedProject?.funder">
                                    <div class="col-sm-6">
                                        <div class="p-2 bg-light rounded-3 border small">
                                            <span class="text-muted">Bailleur :</span>
                                            <strong class="text-dark ms-1" x-text="selectedProject?.funder"></strong>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="selectedProject?.period">
                                    <div class="col-sm-6">
                                        <div class="p-2 bg-light rounded-3 border small">
                                            <span class="text-muted">Période :</span>
                                            <strong class="text-dark ms-1" x-text="selectedProject?.period"></strong>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="selectedProject?.lead">
                                    <div class="col-sm-6">
                                        <div class="p-2 bg-light rounded-3 border small">
                                            <span class="text-muted">Investigateur :</span>
                                            <strong class="text-dark ms-1" x-text="selectedProject?.lead"></strong>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="selectedProject?.zones">
                                    <div class="col-sm-6">
                                        <div class="p-2 bg-light rounded-3 border small">
                                            <span class="text-muted">Zones :</span>
                                            <strong class="text-dark ms-1" x-text="selectedProject?.zones"></strong>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Contexte -->
                            <template x-if="selectedProject?.context">
                                <div class="mb-4">
                                    <h4 class="h6 fw-bold text-dark mb-2">
                                        <i class="fa fa-solid fa-book-open text-primary me-2"></i> Contexte &amp;
                                        Problématique
                                    </h4>
                                    <div class="text-secondary small" style="line-height: 1.7;"
                                        x-html="selectedProject?.context"></div>
                                </div>
                            </template>

                            <!-- Objectifs -->
                            <template x-if="selectedProject?.objective">
                                <div class="mb-4">
                                    <h4 class="h6 fw-bold text-dark mb-2">
                                        <i class="fa fa-solid fa-bullseye text-success me-2"></i> Objectifs de l'Étude
                                    </h4>
                                    <div class="text-secondary small" style="line-height: 1.7;"
                                        x-html="selectedProject?.objective"></div>
                                </div>
                            </template>

                            <!-- Méthodologie -->
                            <template x-if="selectedProject?.methodology">
                                <div class="mb-4">
                                    <h4 class="h6 fw-bold text-dark mb-2">
                                        <i class="fa fa-solid fa-microscope text-info me-2"></i> Méthodologie
                                    </h4>
                                    <div class="text-secondary small" style="line-height: 1.7;"
                                        x-html="selectedProject?.methodology"></div>
                                </div>
                            </template>
                        </div>

                        <!-- Pied de Modal -->
                        <div class="p-3 border-top d-flex justify-content-between align-items-center bg-light">
                            <button type="button" @click="closeProjectModal()"
                                class="btn btn-sm btn-outline-secondary rounded-pill px-4">
                                Fermer
                            </button>
                            <a href="http://carics-togo.test/contact"
                                class="btn btn-sm btn-primary rounded-pill px-4 fw-semibold">
                                Initier une collaboration <i class="fa fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer footer-style-one">
            <div class="anim-icon-one">
                <img src="archinest/images/icons/footer-h1-1.png" alt="">
            </div>
            <div class="anim-icon-two">
                <img src="archinest/images/icons/footer-h1-2.png" alt="">
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="footer-logo">
                            <div><a href="http://carics-togo.test"><img src="http://carics-togo.test/logo_resize.png"
                                        alt=""></a></div>
                        </div>
                        <div class="widgets-section">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 footer-column">
                                    <div class="footer-widget links-widget">
                                        <h4 class="widget-title">Useful Links</h4>
                                        <div class="widget-content">
                                            <ul class="user-links">
                                                <li><a href="http://carics-togo.test">Home</a></li>
                                                <li><a href="http://carics-togo.test/a-propos">About</a></li>
                                                <li><a href="http://carics-togo.test/recherche-expertize-projet">Research
                                                        &amp; Projects</a></li>
                                                <li><a href="http://carics-togo.test/ressource-publication">Resources
                                                        &amp; Publications</a></li>
                                                <li><a href="http://carics-togo.test/actu-opportunites">News &amp;
                                                        Opportunities</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 footer-column">
                                    <div class="footer-widget links-widget">
                                        <h4 class="widget-title">Other Links</h4>
                                        <div class="widget-content">
                                            <ul class="user-links">
                                                <li><a href="http://carics-togo.test/equipe">Governance &amp;
                                                        Leadership</a></li>
                                                <li><a href="http://carics-togo.test/actu-opportunites">News</a></li>
                                                <li><a
                                                        href="http://carics-togo.test/actu-opportunites">Opportunities</a>
                                                </li>
                                                <li><a href="http://carics-togo.test/contact">Contact Us</a></li>
                                                <li><a href="http://carics-togo.test/contact">Partnerships</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 footer-column">
                                    <div class="footer-widget info-widget mb-0">
                                        <h4 class="widget-title">Our Contact Info</h4>
                                        <div class="widget-content">
                                            <div class="user-info">
                                                <div class="info-box">
                                                    <span>Phone 1:</span>

                                                    <a class="info-link" href="tel:+228 91 37 21 34">+228 91 37 21
                                                        34</a>
                                                </div>
                                                <div class="info-box">
                                                    <span>Phone 2:</span>
                                                    <a class="info-link" href="tel:+228 90 99 18 59">+228 90 99 18
                                                        59</a>
                                                </div>
                                                <div class="info-box">
                                                    <span>Phone 3:</span>
                                                    <a class="info-link" href="tel:+228 99 56 10 55">+228 99 56 10
                                                        55</a>
                                                </div>

                                                <div class="info-box">
                                                    <span>Address:</span>
                                                    <span class="">Tone 1 Municipality, Tone Prefecture</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="big-title">CARICS</div>
                        <div class="footer-bottom">
                            <div class="copyright">© 2026 CARICS - All rights reserved.</div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-contact">
                            <div class="inner-contact">
                                <h2 class="contact-title">A project or a Collaboration? <br>Let’s talk.</h2>
                                <div class="widget-outer">
                                    <a href="http://carics-togo.test/contact" class="contact-buton"><i
                                            class="icon fa-light fa-arrow-right"></i> <span>Contact Us</span></a>
                                    <div class="footer-widget social-widget">
                                        <h4 class="widget-title">Follow us on social media</h4>
                                        <ul class="social-link">
                                            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa-regular fa-x"></i></a></li>
                                            <li><a href="#"><i class="fa-solid fa-link-slash"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer> <!--End Main Footer -->

    </div><!-- End Page Wrapper -->

    <!-- Livewire Scripts -->
    <script src="http://carics-togo.test/livewire-fc7d731d/livewire.js?id=4735e441"
        data-csrf="9LvsiHdlS5a666cE1k4uTUtDM7jlsQuO0Kt9I0P7" data-module-url="http://carics-togo.test/livewire-fc7d731d"
        data-update-uri="http://carics-togo.test/livewire-fc7d731d/update" data-navigate-once="true"></script>



    <script src="http://carics-togo.test/archinest/js/jquery.js"></script>
    <script src="http://carics-togo.test/archinest/js/popper.min.js"></script>
    <script src="http://carics-togo.test/archinest/js/bootstrap.min.js"></script>
    <script src="http://carics-togo.test/archinest/js/jquery.fancybox.js"></script>
    <script src="http://carics-togo.test/archinest/js/jquery-ui.js"></script>
    <script src="http://carics-togo.test/archinest/js/wow.js"></script>
    <script src="http://carics-togo.test/archinest/js/appear.js"></script>
    <script src="http://carics-togo.test/archinest/js/select2.min.js"></script>
    <script src="http://carics-togo.test/archinest/js/knob.js"></script>
    <script src="http://carics-togo.test/archinest/js/swiper.min.js"></script>

    <script src="http://carics-togo.test/archinest/js/gsap.min.js"></script>
    <script src="http://carics-togo.test/archinest/js/ScrollTrigger.min.js"></script>
    <script src="http://carics-togo.test/archinest/js/splitType.js"></script>
    <script src="http://carics-togo.test/archinest/js/gsap-scroll-smoother.js"></script>
    <script src="http://carics-togo.test/archinest/js/gsap-scroll-to-plugin.js"></script>
    <script src="http://carics-togo.test/archinest/js/SplitText.min.js"></script>
    <script src="http://carics-togo.test/archinest/js/custom-gsap.js"></script>
    <script src="http://carics-togo.test/archinest/js/jquery-scrolltofixed-min.js"></script>

    <script src="http://carics-togo.test/archinest/js/script.js"></script>
    <script defer="" src="http://carics-togo.test/archinest/js/beacon.min.js"></script>


    <div x-show="selectedProject !== 'hrtr'"
        class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center p-3"
        style="background: rgba(15, 23, 42, 0.65); z-index: 1050; backdrop-filter: blur(4px);"
        @keydown.escape.window="closeProjectModal()" data-teleport-target="true">
        <div @click.away="closeProjectModal()" class="card border-0 rounded-4 shadow-lg w-100 overflow-hidden bg-white"
            style="max-width: 800px; max-height: 90vh;">
            <!-- En-tête Modal -->
            <div class="p-4 border-bottom d-flex justify-content-between align-items-start bg-light">
                <div class="pe-3">
                    <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                        <span class="badge" :class="selectedProject?.statusClass"
                            x-text="selectedProject?.statusLabel"></span>
                        <template x-if="selectedProject?.region">
                            <span class="badge bg-white text-muted border">
                                <i class="fa fa-solid fa-location-dot text-danger me-1"></i>
                                <span x-text="selectedProject?.region"></span>
                            </span>
                        </template>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-0" x-text="selectedProject?.title"></h3>
                </div>
                <button type="button" @click="closeProjectModal()"
                    class="btn btn-sm btn-light rounded-circle p-2 shadow-none" style="width: 36px; height: 36px;">
                    <i class="fa fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Corps Modal (Déroulant) -->
            <div class="p-4 overflow-auto" style="max-height: calc(90vh - 140px);">
                <!-- Métadonnées rapides -->
                <div class="row g-2 mb-4">
                    <template x-if="selectedProject?.funder">
                        <div class="col-sm-6">
                            <div class="p-2 bg-light rounded-3 border small">
                                <span class="text-muted">Bailleur :</span>
                                <strong class="text-dark ms-1" x-text="selectedProject?.funder"></strong>
                            </div>
                        </div>
                    </template>
                    <template x-if="selectedProject?.period">
                        <div class="col-sm-6">
                            <div class="p-2 bg-light rounded-3 border small">
                                <span class="text-muted">Période :</span>
                                <strong class="text-dark ms-1" x-text="selectedProject?.period"></strong>
                            </div>
                        </div>
                    </template>
                    <template x-if="selectedProject?.lead">
                        <div class="col-sm-6">
                            <div class="p-2 bg-light rounded-3 border small">
                                <span class="text-muted">Investigateur :</span>
                                <strong class="text-dark ms-1" x-text="selectedProject?.lead"></strong>
                            </div>
                        </div>
                    </template>
                    <template x-if="selectedProject?.zones">
                        <div class="col-sm-6">
                            <div class="p-2 bg-light rounded-3 border small">
                                <span class="text-muted">Zones :</span>
                                <strong class="text-dark ms-1" x-text="selectedProject?.zones"></strong>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Contexte -->
                <template x-if="selectedProject?.context">
                    <div class="mb-4">
                        <h4 class="h6 fw-bold text-dark mb-2">
                            <i class="fa fa-solid fa-book-open text-primary me-2"></i> Contexte &amp; Problématique
                        </h4>
                        <div class="text-secondary small" style="line-height: 1.7;" x-html="selectedProject?.context">
                        </div>
                    </div>
                </template>

                <!-- Objectifs -->
                <template x-if="selectedProject?.objective">
                    <div class="mb-4">
                        <h4 class="h6 fw-bold text-dark mb-2">
                            <i class="fa fa-solid fa-bullseye text-success me-2"></i> Objectifs de l'Étude
                        </h4>
                        <div class="text-secondary small" style="line-height: 1.7;" x-html="selectedProject?.objective">
                        </div>
                    </div>
                </template>

                <!-- Méthodologie -->
                <template x-if="selectedProject?.methodology">
                    <div class="mb-4">
                        <h4 class="h6 fw-bold text-dark mb-2">
                            <i class="fa fa-solid fa-microscope text-info me-2"></i> Méthodologie
                        </h4>
                        <div class="text-secondary small" style="line-height: 1.7;"
                            x-html="selectedProject?.methodology"></div>
                    </div>
                </template>
            </div>

            <!-- Pied de Modal -->
            <div class="p-3 border-top d-flex justify-content-between align-items-center bg-light">
                <button type="button" @click="closeProjectModal()"
                    class="btn btn-sm btn-outline-secondary rounded-pill px-4">
                    Fermer
                </button>
                <a href="http://carics-togo.test/contact" class="btn btn-sm btn-primary rounded-pill px-4 fw-semibold">
                    Initier une collaboration <i class="fa fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
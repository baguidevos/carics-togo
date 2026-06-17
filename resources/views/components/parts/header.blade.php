<header class="header header-3">
    <!-- header lower start -->
    <div class="header-lower">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between g-0">
                <div class="col-12">
                    <!-- header content start -->
                    <div class="header-content d-flex justify-content-between align-items-center">
                        <!-- logo box start -->
                        <div class="logo-box">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <figure>
                                        <img src="{{ asset('logo.jpeg') }}" style="height: 60px" alt="header logo">
                                    </figure>
                                </a>
                            </div>
                        </div>
                        <!-- logo box end  -->

                        <!-- header navigation start -->
                        <div class="header-navigation d-flex align-items-center">
                            <!-- main menu -->
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li class="menu-thumb">
                                            <a href="index.html">{{ __('nav_links.home') }}</a>
                                        </li>
                                        <li>
                                            <a href="about.html">{{ __('nav_links.about') }}</a>
                                        </li>
                                        <li>
                                            <a href="services.html">{{ __('nav_links.domaines') }}<i class="fa-solid fa-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="services.html">Services</a></li>
                                                <li><a href="services-details.html">Services Details</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="about.html">{{ __('nav_links.resources') }}<i class="fa-solid fa-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="appointment.html">Appointment</a></li>
                                                <li class="has-dropdown">
                                                    <a href="doctor.html">Doctors <i
                                                            class="fa-solid fa-chevron-right"></i></a>
                                                    <ul class="submenu">
                                                        <li><a href="doctor.html">Doctors</a></li>
                                                        <li><a href="doctor-details.html">Doctors Details</a></li>
                                                    </ul>
                                                </li>
                                                <li class="has-dropdown">
                                                    <a href="portfolio.html">Portfolio <i
                                                            class="fa-solid fa-chevron-right"></i></a>
                                                    <ul class="submenu">
                                                        <li><a href="portfolio.html">Portfolio</a></li>
                                                        <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                                    </ul>
                                                </li>
                                                <li class="has-dropdown">
                                                    <a href="shop.html">Shop <i
                                                            class="fa-solid fa-chevron-right"></i></a>
                                                    <ul class="submenu">
                                                        <li><a href="shop.html">Shop</a></li>
                                                        <li><a href="shop-details.html">Shop Details</a></li>
                                                        <li><a href="cart.html">Cart</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                        <li><a href="wishlist.html">Wishlist</a></li>
                                                    </ul>
                                                </li>
                                                <li class="has-dropdown">
                                                    <a href="doctor.html">Gallery <i
                                                            class="fa-solid fa-chevron-right"></i></a>
                                                    <ul class="submenu">
                                                        <li><a href="image-gallery.html">Image Gallery</a></li>
                                                        <li><a href="video-gallery.html">Video Gallery</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="pricing.html">Pricing</a></li>
                                                <li><a href="testimonials.html">Testimonials</a></li>
                                                <li><a href="faq.html">Faq's</a></li>
                                                <li><a href="error.html">404 Error</a></li>
                                                <li class="has-dropdown">
                                                    <a href="sign-in.html">Authentication <i
                                                            class="fa-solid fa-chevron-right"></i></a>
                                                    <ul class="submenu">
                                                        <li><a href="sign-in.html">Sign In </a></li>
                                                        <li><a href="register.html">Register</a></li>
                                                        <li><a href="forget-password.html">Forgot Password</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="blog.html">{{ __('nav_links.actualites') }} <i class="fa-solid fa-chevron-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">Our Blog</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="contact.html">{{ __('nav_links.contact') }}</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- header navigation end -->

                        <!-- header right start -->
                        <div class="header-right d-flex align-items-center gap-lg-4 gap-3">
                            <!-- header button -->
                            <div class="header-button">
                                <a href="appointment.html" class="theme-button style-1" aria-label="Book Appointment">
                                    <span data-text="Book Appointment">{{ __('nav_links.mail') }}</span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                            <!-- header call -->
                            <div class="header-call">
                                <div class="header-call-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="header-call-content">
                                    <span>Nous envoyer un mail</span>
                                    <a href="mailto:contact@carics-togo.org">contact@carics-togo.org</a>
                                </div>
                            </div>
                            <!-- header sidebar -->
                            <div class="header-sidebar">
                                <a class="sidebar-toggler color-one" data-bs-toggle="offcanvas"
                                    href="#offcanvas-sidebar" aria-label="sidebar toggler" role="button"
                                    aria-controls="offcanvas-sidebar">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                        <!-- header right end -->
                    </div>
                    <!-- header content end -->
                </div>
            </div>
        </div>
    </div>
    <!-- header lower end -->
</header>
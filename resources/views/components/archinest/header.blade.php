<header class="main-header header-style-one">
    <div class="outer-box">
        <div class="header-top">
            <div class="container">
                <div class="inner-top p-0">
                    <ul class="list">
                        <li><a href="{{ config('site.href_email') }}"><i
                                    class="fa-regular fa-envelope-badge"></i><span>{{ config('site.email') }}</span></a>
                        </li>
                    </ul>
                    <ul class="list">
                        <li><a href="{{ config('site.href_phone1') }}"><i class="fa-regular fa-phone-circle-down"></i>
                                {{ config('site.phone1') }}</a>
                        </li>
                        <li class="line"></li>
                        <li><a href="{{ config('site.href_phone2') }}"><i class="fa-regular fa-phone"></i>
                                {{ config('site.phone2') }}</a>
                        </li>
                        <li class="line"></li>
                        <li><a href="{{ config('site.href_phone3') }}"><i class="fa-regular fa-phone"></i>
                                {{ config('site.phone3') }}</a>
                        </li>
                        <li class="line"></li>
                        <li>
                            <ul class="list" x-data="{ open: false }" style="margin-left:auto; position:relative;">
                                <li>
                                    <div @click="open = !open" @click.outside="open = false"
                                        style="cursor:pointer; display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; letter-spacing:.04em; user-select:none;">
                                        <i class="fa-regular fa-globe text-white" style="font-size:14px;"></i>
                                        <span x-text="$store.lang.current.toUpperCase()">FR</span>
                                        <span class="text-white">{{ str_replace('_', '-', strtoupper(app()->getLocale())) }}</span>
                                        <i class="fa-solid fa-angle-down text-white"
                                            style="font-size:10px; transition:transform .2s;"
                                            :style="open ? 'transform:rotate(180deg)' : ''"></i>
                                    </div>
                                    <div x-show="open" x-transition
                                        style="position:absolute; top:calc(100% + 6px); right:0; background:#fff; border:1px solid #e5e7eb; border-radius:6px; min-width:90px; box-shadow:0 4px 16px rgba(0,0,0,.1); z-index:9999; overflow:hidden; display:none;">
                                        <a href="{{ route('lang.switch', ['locale' => 'fr']) }}"
                                            style="display:flex; align-items:center; gap:8px; padding:8px 14px; font-size:13px; font-weight:600; color:#16344F; text-decoration:none; transition:background .15s;"
                                            onmouseover="this.style.background='#f3f4f6'"
                                            onmouseout="this.style.background=''" @click="open=false">
                                            FR
                                        </a>
                                        <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
                                            style="display:flex; align-items:center; gap:8px; padding:8px 14px; font-size:13px; font-weight:600; color:#16344F; text-decoration:none; transition:background .15s;"
                                            onmouseover="this.style.background='#f3f4f6'"
                                            onmouseout="this.style.background=''" @click="open=false">
                                            EN
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                </div>
            </div>
        </div>
        <div class="header-lower anim-fade-move" data-delay="0.25" style="background-color:var(--theme-color-white)">
            <div class="auto-container">
                <div class="inner-lower px-0">
                    <!-- Main box -->
                    <div class="main-box">
                        <div class="logo-box">
                            <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('logo_resize.png') }}"
                                        alt="Logo"></a>
                            </div>
                        </div>

                        <!--Nav Box-->
                        <div class="nav-outer">
                            <nav class="nav main-menu mx-auto">
                                <ul class="navigation">
                                    <li class="current"><a href="{{ route('home') }}" wire:current>Acceuil</a>
                                    </li>
                                    <li class="dropdown"><a href="{{ route('about') }}">A propos</a>
                                        <ul>
                                            <li><a href="{{ route('about') }}">A propos</a></li>
                                            <li><a href="{{ route('equipe') }}">Gouvernance &amp; Leadership</a></li>
                                        </ul>
                                    </li>
                                    <li class=""><a href="{{ route('recherche-expertize-projet') }}">Recherche &
                                            Projets</a>
                                    </li>
                                    <li class=""><a href="{{ route('ressource-publication') }}">Ressources &
                                            Publications</a>

                                    </li>
                                    <li>
                                        <a href="{{ route('actu-opportunites') }}">Actualités & Opportunités</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <!-- Outer Box -->
                        <div class="action-box">
                            <a href="{{ route('contact') }}" class="theme-btn btn-style-one d-none d-md-flex">
                                <span class="btn-title">Contactez-nous</span>
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
                <div class="nav-logo"><a href="{{ route('home') }}"><img src="{{ asset('logo.jpeg') }}" alt=""></a>
                </div>
                <div class="close-btn"><i class="icon fa fa-times"></i></div>
            </div>
            <ul class="navigation clearfix">
                <!--Keep This Empty / Menu will come through Javascript-->
            </ul>
            <ul class="contact-list-one">
                <li>
                    <i class="icon fal fa-envelope"></i>
                    <span class="title">Envoyer un mail</span>
                    <div class="text"><a href="{{ config('site.href_email') }}">{{ config('site.email') }}</a>
                    </div>
                </li>
                <li>
                    <i class="icon fal fa-phone"></i>
                    <span class="title">Appelez-nous</span>
                    <div class="text"><a href="{{ config('site.href_phone1') }}">{{ config('site.phone1') }}</a>
                    </div>
                </li>
                <li>
                    <i class="icon fal fa-phone"></i>
                    <span class="title">Appelez-nous</span>
                    <div class="text"><a href="{{ config('site.href_phone2') }}">{{ config('site.phone2') }}</a>
                    </div>
                </li>
                <li>
                    <i class="icon fal fa-phone"></i>
                    <span class="title">Appelez-nous</span>
                    <div class="text"><a href="{{ config('site.href_phone3') }}">{{ config('site.phone3') }}</a>
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
            <form method="post" action="{{ route('home') }}">
                <div class="form-group">
                    <input type="search" name="search-field" value="" placeholder="Search..." required="">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Header Search -->

    {{-- <!-- Sticky Header  -->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="inner-container">
                <!--Logo-->
                <div class="logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('logo.jpeg') }}" alt=""></a>
                </div>

                <!--Right Col-->
                <div class="nav-outer">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-collapse show collapse clearfix">
                            <ul class="navigation clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->

                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->

                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler"><i class="icon fa-solid fa-bars-staggered"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sticky Menu --> --}}
</header>
<footer class="main-footer footer-style-one">
    <div class="anim-icon-one">
        <img src="archinest/images/icons/footer-h1-1.png" alt="">
    </div>
    <div class="anim-icon-two">
        <img src="archinest/images/icons/footer-h1-2.png" alt="">
    </div>
    {{-- <div class="anim-icon-three">
        <img src="archinest/images/icons/footer-h2-3.png" alt="">
    </div> --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="footer-logo">
                    <div><a href="{{ route('home') }}"><img src="{{ asset('logo_resize.png') }}" alt=""></a></div>
                </div>
                <div class="widgets-section">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 footer-column">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">{{ __('navigation.footer.useful_links') }}</h4>
                                <div class="widget-content">
                                    <ul class="user-links">
                                        <li><a href="{{ route('home') }}">{{ __('navigation.menu.home') }}</a></li>
                                        <li><a href="{{ route('about') }}">{{ __('navigation.menu.about') }}</a></li>
                                        <li><a href="{{ route('recherche-expertize-projet') }}">{{ __('navigation.menu.research_projects') }}</a></li>
                                        <li><a href="{{ route('ressource-publication') }}">{{ __('navigation.menu.resources_publications') }}</a></li>
                                        <li><a href="{{ route('actu-opportunites') }}">{{ __('navigation.menu.news_opportunities') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 footer-column">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">{{ __('navigation.footer.other_links') }}</h4>
                                <div class="widget-content">
                                    <ul class="user-links">
                                        <li><a href="{{ route('equipe') }}">{{ __('navigation.menu.governance') }}</a></li>
                                        <li><a href="{{ route('actu-opportunites') }}">{{ __('navigation.footer.news') }}</a></li>
                                        <li><a href="{{ route('actu-opportunites') }}">{{ __('navigation.footer.opportunities') }}</a></li>
                                        <li><a href="{{ route('contact') }}">{{ __('navigation.header.contact_us') }}</a></li>
                                        <li><a href="{{ route('contact') }}">{{ __('navigation.footer.partnerships') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 footer-column">
                            <div class="footer-widget info-widget mb-0">
                                <h4 class="widget-title">{{ __('navigation.footer.contact_info') }}</h4>
                                <div class="widget-content">
                                    <div class="user-info">
                                        <div class="info-box">
                                            <span>{{ __('navigation.footer.phone_1') }}:</span>

                                            <a class="info-link"
                                                href="{{ config('site.href_phone1') }}">{{ config('site.phone1') }}</a>
                                        </div>
                                        <div class="info-box">
                                            <span>{{ __('navigation.footer.phone_2') }}:</span>
                                            <a class="info-link"
                                                href="{{ config('site.href_phone2') }}">{{ config('site.phone2') }}</a>
                                        </div>
                                        <div class="info-box">
                                            <span>{{ __('navigation.footer.phone_3') }}:</span>
                                            <a class="info-link"
                                                href="{{ config('site.href_phone3') }}">{{ config('site.phone3') }}</a>
                                        </div>

                                        <div class="info-box">
                                            <span>{{ __('navigation.footer.address') }}:</span>
                                            <span class="">{{ __('navigation.footer.address_value') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="big-title">CARICS</div>
                <div class="footer-bottom">
                    <div class="copyright">{{ __('navigation.footer.copyright') }}</div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-contact">
                    <div class="inner-contact">
                        <h2 class="contact-title">{!! __('navigation.footer.cta_title') !!}</h2>
                        <div class="widget-outer">
                            <a href="{{ route('contact') }}" class="contact-buton"><i
                                    class="icon fa-light fa-arrow-right"></i> <span>{{ __('navigation.footer.cta_button') }}</span></a>
                            <div class="footer-widget social-widget">
                                <h4 class="widget-title">{{ __('navigation.footer.social_title') }}</h4>
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
</footer>
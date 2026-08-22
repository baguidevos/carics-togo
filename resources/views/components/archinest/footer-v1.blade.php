<footer class="carics-footer-v1 pt-5 pb-4">
    <div class="container">
        <!-- Pre-Footer CTA Banner -->
        <div class="carics-prefooter-v1 mb-5">
            <div class="row align-items-center justify-content-between g-4">
                <div class="col-lg-7 text-success">
                    <span class="badge bg-success text-white mb-2 px-3 py-2 rounded-pill" style="font-family: var(--font-mono); font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase;">
                        {{ __('navigation.footer.partnerships_collaboration') }}
                    </span>
                    <h3 class="fw-bold mb-2 text-white" style="font-family: var(--font-display); font-size: clamp(1.4rem, 2.5vw, 1.9rem);">
                        {{ __('navigation.footer.prefooter_title') }}
                    </h3>
                    <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                        {{ __('navigation.footer.prefooter_desc') }}
                    </p>
                </div>
                <div class="col-lg-5 d-flex flex-wrap gap-3 justify-content-lg-end">
                    <a href="{{ route('contact') }}" class="btn btn-light px-4 py-2 rounded-pill fw-semibold text-primary d-inline-flex align-items-center gap-2 shadow-sm">
                        <span>{{ __('navigation.footer.cta_button') }}</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('recherche-expertize-projet') }}" class="btn btn-outline-light px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2">
                        <span>{{ __('navigation.footer.our_projects') }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- 4 Columns Footer Body -->
        <div class="row g-4 mb-5 pt-3">
            <!-- Col 1 : Identité & Mission -->
            <div class="col-lg-4 col-md-6 carics-footer-col-v1">
                <div class="mb-3">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('logo_resize.png') }}" alt="CARICS-TOGO" style="height: 48px; background: rgba(255,255,255,0.95); padding: 4px 8px; border-radius: 8px;">
                    </a>
                </div>
                <p class="text-white-50 mb-3" style="font-size: 0.88rem; line-height: 1.6;">
                    {{ __('navigation.footer.org_desc') }}
                </p>
                <div class="d-flex align-items-center gap-2">
                    <a href="https://facebook.com" target="_blank" class="carics-social-circle" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://twitter.com" target="_blank" class="carics-social-circle" title="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://linkedin.com" target="_blank" class="carics-social-circle" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="https://instagram.com" target="_blank" class="carics-social-circle" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>

            <!-- Col 2 : Navigation & Pôles -->
            <div class="col-lg-2 col-md-6 carics-footer-col-v1">
                <h5>{{ __('navigation.footer.poles_team') }}</h5>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right" style="font-size: 0.75rem;"></i> {{ __('navigation.menu.home') }}</a></li>
                    <li><a href="{{ route('about') }}"><i class="fa-solid fa-angle-right" style="font-size: 0.75rem;"></i> {{ __('navigation.menu.about_us') }}</a></li>
                    <li><a href="{{ route('equipe') }}"><i class="fa-solid fa-angle-right" style="font-size: 0.75rem;"></i> {{ __('navigation.menu.governance') }}</a></li>
                    <li><a href="{{ route('recherche-expertize-projet') }}"><i class="fa-solid fa-angle-right" style="font-size: 0.75rem;"></i> {{ __('navigation.menu.research_projects') }}</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fa-solid fa-angle-right" style="font-size: 0.75rem;"></i> {{ __('navigation.footer.partnerships') }}</a></li>
                </ul>
            </div>

            <!-- Col 3 : Ressources & Veille -->
            <div class="col-lg-3 col-md-6 carics-footer-col-v1">
                <h5>{{ __('navigation.footer.publications_monitoring') }}</h5>
                <ul>
                    <li><a href="{{ route('ressource-publication') }}"><i class="fa-solid fa-angle-right" style="font-size: 0.75rem;"></i> {{ __('navigation.menu.resources_publications') }}</a></li>
                    <li><a href="{{ route('actu-opportunites') }}"><i class="fa-solid fa-angle-right" style="font-size: 0.75rem;"></i> {{ __('navigation.footer.news') }}</a></li>
                    <li><a href="{{ route('actu-opportunites') }}"><i class="fa-solid fa-angle-right" style="font-size: 0.75rem;"></i> {{ __('navigation.footer.opportunities') }}</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fa-solid fa-angle-right" style="font-size: 0.75rem;"></i> {{ __('navigation.footer.submit_article') }}</a></li>
                </ul>
            </div>

            <!-- Col 4 : Contact & Ancrage Régional -->
            <div class="col-lg-3 col-md-6 carics-footer-col-v1">
                <h5>{{ __('navigation.footer.contact_info') }}</h5>
                <div class="d-flex flex-column gap-2" style="font-size: 0.88rem;">
                    <div class="d-flex align-items-start gap-2 text-white-50">
                        <i class="fa-solid fa-location-dot text-accent mt-1"></i>
                        <span>{{ config('site.address') }}</span>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-phone text-accent"></i>
                        <a href="{{ config('site.href_phone1') }}" class="text-white-50">{{ config('site.phone1') }}</a>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-phone-office text-accent"></i>
                        <a href="{{ config('site.href_phone2') }}" class="text-white-50">{{ config('site.phone2') }}</a>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-regular fa-envelope text-accent"></i>
                        <a href="{{ config('site.href_email') }}" class="text-white-50">{{ config('site.email') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Legal Bar -->
        <div class="pt-4 mt-2 border-top border-white border-opacity-10 d-flex flex-wrap justify-content-between align-items-center gap-3 text-white-50" style="font-size: 0.82rem;">
            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                <span>{{ __('navigation.footer.copyright') }}</span>
                <span class="d-none d-sm-inline text-white-50">•</span>
                <span>{{ __('navigation.footer.developed_by') }} <a href="tel:+22892407089" class="text-white text-decoration-none fw-semibold">HIDA Baguibassa David</a> (<a href="tel:+22892407089" class="text-accent text-decoration-none">+228 92 40 70 89</a>)</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" class="text-white-50 text-decoration-none">{{ __('navigation.footer.legal_notices') }}</a>
                <span>•</span>
                <a href="{{ route('home') }}" class="text-white-50 text-decoration-none">{{ __('navigation.footer.privacy_policy') }}</a>
                <span>•</span>
                <span>{{ __('navigation.footer.made_in_togo') }}</span>
            </div>
        </div>
    </div>
</footer>


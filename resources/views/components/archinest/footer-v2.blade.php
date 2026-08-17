<footer class="carics-footer-v2">
    <div class="container">
        <!-- Bento Grid Structure -->
        <div class="row g-4 mb-5">
            <!-- Bento Card 1 : Grand bloc Hub & Identité -->
            <div class="col-lg-5">
                <div class="carics-bento-card d-flex flex-column justify-content-between">
                    <div>
                        <div class="carics-bento-badge">
                            <span class="pulse-dot me-1"></span> Pôle Scientifique & Communautaire
                        </div>
                        <div class="mb-3">
                            <img src="{{ asset('logo_resize.png') }}" alt="CARICS" style="height: 46px; background: rgba(255,255,255,0.92); padding: 4px 10px; border-radius: 10px;">
                        </div>
                        <h4 class="text-white fw-bold mb-3" style="font-family: var(--font-display); font-size: 1.3rem;">
                            Construire des solutions de santé durables et inclusives.
                        </h4>
                        <p class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">
                            Centre indépendant au cœur de la Région des Savanes (Togo), engagé dans la recherche appliquée, la formation et les interventions terrain.
                        </p>
                    </div>

                    <div class="d-flex align-items-center gap-2 pt-3 border-top border-white border-opacity-10 mt-3">
                        <a href="https://facebook.com" target="_blank" class="carics-social-circle"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://twitter.com" target="_blank" class="carics-social-circle"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://linkedin.com" target="_blank" class="carics-social-circle"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://instagram.com" target="_blank" class="carics-social-circle"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <!-- Bento Card 2 : Liens Stratégiques & Navigation -->
            <div class="col-lg-3 col-md-6">
                <div class="carics-bento-card">
                    <div class="carics-bento-badge">
                        <i class="fa-regular fa-compass"></i> Navigation
                    </div>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2" style="font-size: 0.9rem;">
                        <li><a href="{{ route('home') }}" class="text-white-50 text-decoration-none hover-text-white d-flex align-items-center justify-content-between py-1 border-bottom border-white border-opacity-5"><span>{{ __('navigation.menu.home') }}</span> <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i></a></li>
                        <li><a href="{{ route('about') }}" class="text-white-50 text-decoration-none hover-text-white d-flex align-items-center justify-content-between py-1 border-bottom border-white border-opacity-5"><span>{{ __('navigation.menu.about_us') }}</span> <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i></a></li>
                        <li><a href="{{ route('equipe') }}" class="text-white-50 text-decoration-none hover-text-white d-flex align-items-center justify-content-between py-1 border-bottom border-white border-opacity-5"><span>{{ __('navigation.menu.governance') }}</span> <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i></a></li>
                        <li><a href="{{ route('recherche-expertize-projet') }}" class="text-white-50 text-decoration-none hover-text-white d-flex align-items-center justify-content-between py-1 border-bottom border-white border-opacity-5"><span>{{ __('navigation.menu.research_projects') }}</span> <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i></a></li>
                        <li><a href="{{ route('ressource-publication') }}" class="text-white-50 text-decoration-none hover-text-white d-flex align-items-center justify-content-between py-1"><span>{{ __('navigation.menu.resources_publications') }}</span> <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i></a></li>
                    </ul>
                </div>
            </div>

            <!-- Bento Card 3 : Point de Contact & Action Rapide -->
            <div class="col-lg-4 col-md-6">
                <div class="carics-bento-card d-flex flex-column justify-content-between">
                    <div>
                        <div class="carics-bento-badge">
                            <i class="fa-regular fa-paper-plane"></i> Contact Direct
                        </div>
                        
                        <div class="p-3 rounded-3 mb-3" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);">
                            <div class="d-flex align-items-center gap-2 mb-1 text-white fw-semibold" style="font-size: 0.88rem;">
                                <i class="fa-solid fa-location-dot text-accent"></i> Siège Principal :
                            </div>
                            <p class="text-muted mb-0" style="font-size: 0.82rem;">
                                {{ config('site.address') }}
                            </p>
                        </div>

                        <div class="d-flex flex-column gap-2 mb-3" style="font-size: 0.85rem;">
                            <a href="{{ config('site.href_phone1') }}" class="text-white-50 text-decoration-none d-flex align-items-center gap-2 hover-text-white">
                                <i class="fa-solid fa-phone-volume text-accent"></i> {{ config('site.phone1') }}
                            </a>
                            <a href="{{ config('site.href_email') }}" class="text-white-50 text-decoration-none d-flex align-items-center gap-2 hover-text-white">
                                <i class="fa-regular fa-envelope text-accent"></i> {{ config('site.email') }}
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('contact') }}" class="carics-btn-glow w-100 justify-content-center text-center">
                        <span>{{ __('navigation.footer.cta_button') }}</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bento Bottom Bar / Newsletter & Copyright -->
        <div class="p-4 rounded-4" style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.06);">
            <div class="row align-items-center justify-content-between g-3">
                <div class="col-md-7 text-muted d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2" style="font-size: 0.85rem;">
                    <span>{{ __('navigation.footer.copyright') }}</span>
                    <span class="d-none d-sm-inline text-muted">•</span>
                    <span>Développé par <a href="tel:+22892407089" class="text-white text-decoration-none fw-semibold">HIDA Baguibassa David</a> (<a href="tel:+22892407089" class="text-accent text-decoration-none">+228 92 40 70 89</a>)</span>
                </div>
                <div class="col-md-5 d-flex justify-content-md-end gap-3 text-muted" style="font-size: 0.85rem;">
                    <a href="{{ route('home') }}" class="text-muted text-decoration-none hover-text-white">Mentions Légales</a>
                    <span>•</span>
                    <a href="{{ route('home') }}" class="text-muted text-decoration-none hover-text-white">Confidentialité</a>
                    <span>•</span>
                    <span>Togo 🇹🇬</span>
                </div>
            </div>
        </div>
    </div>
</footer>

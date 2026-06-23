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
                                <h4 class="widget-title">Liens Utiles</h4>
                                <div class="widget-content">
                                    <ul class="user-links">
                                        <li><a href="{{ route('home') }}">Accueil</a></li>
                                        <li><a href="{{ route('about') }}">À propos</a></li>
                                        <li><a href="{{ route('recherche-expertize-projet') }}">Recherche &amp;
                                                Projets</a></li>
                                        <li><a href="{{ route('ressource-publication') }}">Ressources &amp;
                                                Publications</a></li>
                                        <li><a href="{{ route('actu-opportunites') }}">Actualités &amp; Opportunités</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 footer-column">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">Autres Liens</h4>
                                <div class="widget-content">
                                    <ul class="user-links">
                                        <li><a href="{{ route('equipe') }}">Gouvernance &amp; Leadership</a></li>
                                        <li><a href="{{ route('actu-opportunites') }}">Actualités</a></li>
                                        <li><a href="{{ route('actu-opportunites') }}">Opportunités</a></li>
                                        <li><a href="{{ route('contact') }}">Contactez-nous</a></li>
                                        <li><a href="{{ route('contact') }}">Partenariats</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 footer-column">
                            <div class="footer-widget info-widget mb-0">
                                <h4 class="widget-title">Nos Coordonnées</h4>
                                <div class="widget-content">
                                    <div class="user-info">
                                        <div class="info-box">
                                            <span>Téléphone 1:</span>

                                            <a class="info-link"
                                                href="{{ config('site.href_phone1') }}">{{ config('site.phone1') }}</a>
                                        </div>
                                        <div class="info-box">
                                            <span>Téléphone 2:</span>
                                            <a class="info-link"
                                                href="{{ config('site.href_phone2') }}">{{ config('site.phone2') }}</a>
                                        </div>
                                        <div class="info-box">
                                            <span>Téléphone 3:</span>
                                            <a class="info-link"
                                                href="{{ config('site.href_phone3') }}">{{ config('site.phone3') }}</a>
                                        </div>

                                        <div class="info-box">
                                            <span>Adresse:</span>
                                            <span class="">Commune de Tône 1, Préfecture de Tône</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="big-title">CARICS</div>
                <div class="footer-bottom">
                    <div class="copyright">© 2026 CARICS - Tous droits réservés.</div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-contact">
                    <div class="inner-contact">
                        <h2 class="contact-title">Un projet ou une Collaboration ? <br>Parlons-en.</h2>
                        <div class="widget-outer">
                            <a href="{{ route('contact') }}" class="contact-buton"><i
                                    class="icon fa-light fa-arrow-right"></i> <span>Nous Contacter</span></a>
                            <div class="footer-widget social-widget">
                                <h4 class="widget-title">Suivez-nous sur les réseaux</h4>
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
<header class="carics-header-v1" x-data="{ mobileOpen: false, searchOpen: false, isScrolled: false }" @scroll.window="isScrolled = (window.pageYOffset > 50)">
    <!-- Topbar Institutionnelle -->
    <div class="carics-topbar-v1 d-none d-lg-block">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Gauche : Localisation & Ancrage -->
                <div class="d-flex align-items-center gap-3">
                    <span class="d-flex align-items-center gap-2">
                        <span class="pulse-dot"></span>
                        <i class="fa-solid fa-location-dot text-white-50"></i>
                        <span>Dapaong, Savanes — Togo</span>
                    </span>
                    <span class="text-white-50">|</span>
                    <a href="{{ config('site.href_email') }}" class="d-flex align-items-center gap-2">
                        <i class="fa-regular fa-envelope text-white-50"></i>
                        <span>{{ config('site.email') }}</span>
                    </a>
                </div>

                <!-- Centre : Slogan -->
                <div class="d-none d-xl-block text-white-50" style="font-family: var(--font-mono); font-size: 0.75rem; letter-spacing: 0.12em; text-transform: uppercase;">
                    Recherche • Innovation • Action
                </div>

                <!-- Droite : Téléphone, Langue & Réseaux -->
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ config('site.href_phone1') }}" class="d-flex align-items-center gap-2 fw-semibold">
                        <i class="fa-solid fa-phone-volume text-accent"></i>
                        <span>{{ config('site.phone1') }}</span>
                    </a>

                    <span class="text-white-50">|</span>

                    <!-- Language switcher dropdown -->
                    <div class="position-relative" x-data="{ openLang: false }">
                        <button type="button" @click="openLang = !openLang" @click.outside="openLang = false" class="btn btn-sm text-white d-flex align-items-center gap-2 py-0 px-2 rounded" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); font-size: 0.8rem;">
                            <span>{{ strtoupper(app()->getLocale()) === 'FR' ? '🇫🇷 FR' : '🇬🇧 EN' }}</span>
                            <i class="fa-solid fa-chevron-down" style="font-size: 0.65rem;" :style="openLang ? 'transform: rotate(180deg)' : ''"></i>
                        </button>
                        <div x-show="openLang" x-transition style="position: absolute; top: calc(100% + 6px); right: 0; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); z-index: 9999; min-width: 130px; overflow: hidden; display: none;">
                            <a href="{{ route('lang.switch', ['locale' => 'fr']) }}" class="d-flex align-items-center gap-2 px-3 py-2 text-decoration-none" style="font-size: 0.85rem; color: #16344F; {{ app()->getLocale() === 'fr' ? 'background: #e0f2fe; font-weight: 600;' : '' }}">
                                <span>🇫🇷</span> Français
                            </a>
                            <a href="{{ route('lang.switch', ['locale' => 'en']) }}" class="d-flex align-items-center gap-2 px-3 py-2 text-decoration-none" style="font-size: 0.85rem; color: #16344F; {{ app()->getLocale() === 'en' ? 'background: #e0f2fe; font-weight: 600;' : '' }}">
                                <span>🇬🇧</span> English
                            </a>
                        </div>
                    </div>

                    <!-- Réseaux Sociaux -->
                    <div class="d-flex align-items-center gap-2 ms-2">
                        <a href="https://facebook.com" target="_blank" class="text-white-50 hover-text-white" style="font-size: 0.85rem;"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://twitter.com" target="_blank" class="text-white-50 hover-text-white" style="font-size: 0.85rem;"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://linkedin.com" target="_blank" class="text-white-50 hover-text-white" style="font-size: 0.85rem;"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="carics-navbar-v1" :class="{ 'is-sticky': isScrolled }">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('logo_resize.png') }}" alt="CARICS-TOGO" style="height: 48px; object-fit: contain;">
                </a>

                <!-- Desktop Nav Items -->
                <div class="d-none d-lg-flex align-items-center gap-1">
                    <a href="{{ route('home') }}" class="carics-nav-link-v1 {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fa-regular fa-house" style="font-size: 0.85rem;"></i>
                        <span>{{ __('navigation.menu.home') }}</span>
                    </a>

                    <!-- Dropdown À propos -->
                    <div class="position-relative" x-data="{ dropdownOpen: false }">
                        <button type="button" @click="dropdownOpen = !dropdownOpen" @mouseenter="dropdownOpen = true" @mouseleave="dropdownOpen = false" class="carics-nav-link-v1 border-0 bg-transparent {{ request()->routeIs('about') || request()->routeIs('equipe*') ? 'active' : '' }}">
                            <span>{{ __('navigation.menu.about') }}</span>
                            <i class="fa-solid fa-angle-down" style="font-size: 0.7rem; transition: transform 0.2s;" :style="dropdownOpen ? 'transform: rotate(180deg)' : ''"></i>
                        </button>
                        <div x-show="dropdownOpen" @mouseenter="dropdownOpen = true" @mouseleave="dropdownOpen = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="position-absolute carics-dropdown-menu-v1" style="top: 100%; left: 0; display: none;">
                            <a href="{{ route('about') }}" class="carics-dropdown-item-v1">
                                <div class="item-icon"><i class="fa-regular fa-landmark"></i></div>
                                <div>
                                    <div class="fw-semibold" style="font-size: 0.9rem;">{{ __('navigation.menu.about_us') }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Vision, mission & valeurs</div>
                                </div>
                            </a>
                            <a href="{{ route('equipe') }}" class="carics-dropdown-item-v1">
                                <div class="item-icon"><i class="fa-regular fa-users-gear"></i></div>
                                <div>
                                    <div class="fw-semibold" style="font-size: 0.9rem;">{{ __('navigation.menu.governance') }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Conseil & équipe exécutive</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('recherche-expertize-projet') }}" class="carics-nav-link-v1 {{ request()->routeIs('recherche-expertize-projet') ? 'active' : '' }}">
                        <span>{{ __('navigation.menu.research_projects') }}</span>
                    </a>

                    <a href="{{ route('ressource-publication') }}" class="carics-nav-link-v1 {{ request()->routeIs('ressource-publication') ? 'active' : '' }}">
                        <span>{{ __('navigation.menu.resources_publications') }}</span>
                    </a>

                    <a href="{{ route('actu-opportunites') }}" class="carics-nav-link-v1 {{ request()->routeIs('actu-opportunites') || request()->routeIs('news-detail') ? 'active' : '' }}">
                        <span>{{ __('navigation.menu.news_opportunities') }}</span>
                    </a>
                </div>

                <!-- Right Actions -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Search Trigger -->
                    <button type="button" @click="searchOpen = true" class="btn btn-light rounded-circle d-none d-sm-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border: 1px solid var(--line);" title="Rechercher">
                        <i class="fa-solid fa-magnifying-glass text-muted" style="font-size: 0.9rem;"></i>
                    </button>

                    <!-- Contact CTA -->
                    <a href="{{ route('contact') }}" class="btn-cta d-none d-md-inline-flex align-items-center gap-2">
                        <span>{{ __('navigation.header.contact_us') }}</span>
                        <i class="fa-solid fa-arrow-right" style="font-size: 0.8rem;"></i>
                    </a>

                    <!-- Mobile Hamburger Button -->
                    <button type="button" @click.stop="mobileOpen = true" class="btn btn-light d-lg-none d-flex align-items-center justify-content-center rounded-3 p-2 border" style="width: 42px; height: 42px;" title="Ouvrir le menu">
                        <i class="fa-solid fa-bars-staggered" style="font-size: 1.2rem; color: var(--ink);"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Drawer (Offcanvas) -->
    <div x-show="mobileOpen" 
         x-cloak 
         @keydown.escape.window="mobileOpen = false"
         class="position-fixed top-0 start-0 w-100 h-100" 
         style="z-index: 10000; display: none;">
        <!-- Backdrop with smooth fade -->
        <div class="position-absolute top-0 start-0 w-100 h-100 carics-drawer-backdrop" 
             @click="mobileOpen = false" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <!-- Drawer Body with smooth slide-in -->
        <div class="position-absolute top-0 start-0 h-100 bg-white carics-drawer-panel d-flex flex-column" 
             style="width: 320px; max-width: 85vw;" 
             @click.stop
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full">
            <!-- Drawer Header -->
            <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                <a href="{{ route('home') }}"><img src="{{ asset('logo_resize.png') }}" alt="Logo" style="height: 38px;"></a>
                <button type="button" 
                        @click.stop="mobileOpen = false" 
                        class="btn btn-sm btn-light rounded-circle d-flex align-items-center justify-content-center border" 
                        style="width: 34px; height: 34px;">
                    <i class="fa-solid fa-xmark text-dark"></i>
                </button>
            </div>

            <!-- Drawer Links -->
            <div class="p-3 overflow-auto flex-grow-1" x-data="{ aboutOpen: false }">
                <ul class="list-unstyled mb-0 d-flex flex-column gap-1">
                    <li><a href="{{ route('home') }}" class="carics-mobile-link d-flex align-items-center gap-3 p-2 rounded text-decoration-none text-dark fw-medium {{ request()->routeIs('home') ? 'bg-light text-primary' : '' }}"><i class="fa-regular fa-house text-accent"></i> {{ __('navigation.menu.home') }}</a></li>
                    
                    <!-- Accordion A propos -->
                    <li>
                        <button type="button" @click="aboutOpen = !aboutOpen" class="w-100 border-0 bg-transparent d-flex align-items-center justify-content-between p-2 rounded text-dark fw-medium">
                            <span class="d-flex align-items-center gap-3"><i class="fa-regular fa-circle-info text-accent"></i> {{ __('navigation.menu.about') }}</span>
                            <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem; transition: transform 0.2s;" :style="aboutOpen ? 'transform: rotate(180deg)' : ''"></i>
                        </button>
                        <div x-show="aboutOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="ps-4 py-1 d-flex flex-column gap-1">
                            <a href="{{ route('about') }}" class="carics-mobile-link p-2 rounded text-decoration-none text-muted" style="font-size: 0.9rem;">• {{ __('navigation.menu.about_us') }}</a>
                            <a href="{{ route('equipe') }}" class="carics-mobile-link p-2 rounded text-decoration-none text-muted" style="font-size: 0.9rem;">• {{ __('navigation.menu.governance') }}</a>
                        </div>
                    </li>

                    <li><a href="{{ route('recherche-expertize-projet') }}" class="carics-mobile-link d-flex align-items-center gap-3 p-2 rounded text-decoration-none text-dark fw-medium"><i class="fa-regular fa-microscope text-accent"></i> {{ __('navigation.menu.research_projects') }}</a></li>
                    <li><a href="{{ route('ressource-publication') }}" class="carics-mobile-link d-flex align-items-center gap-3 p-2 rounded text-decoration-none text-dark fw-medium"><i class="fa-regular fa-books text-accent"></i> {{ __('navigation.menu.resources_publications') }}</a></li>
                    <li><a href="{{ route('actu-opportunites') }}" class="carics-mobile-link d-flex align-items-center gap-3 p-2 rounded text-decoration-none text-dark fw-medium"><i class="fa-regular fa-newspaper text-accent"></i> {{ __('navigation.menu.news_opportunities') }}</a></li>
                </ul>

                <hr class="my-3 text-muted">

                <!-- Coordonnées directes mobile -->
                <div class="d-flex flex-column gap-2" style="font-size: 0.85rem;">
                    <div class="text-uppercase text-muted fw-bold" style="font-size: 0.72rem; letter-spacing: 0.1em;">Contact Rapide</div>
                    <a href="{{ config('site.href_phone1') }}" class="text-decoration-none text-dark d-flex align-items-center gap-2"><i class="fa-solid fa-phone text-accent"></i> {{ config('site.phone1') }}</a>
                    <a href="{{ config('site.href_email') }}" class="text-decoration-none text-dark d-flex align-items-center gap-2"><i class="fa-regular fa-envelope text-accent"></i> {{ config('site.email') }}</a>
                </div>

                <!-- Language Switch Mobile -->
                <div class="mt-3 pt-3 border-top d-flex gap-2">
                    <a href="{{ route('lang.switch', ['locale' => 'fr']) }}" class="btn btn-sm flex-fill {{ app()->getLocale() === 'fr' ? 'btn-primary' : 'btn-outline-secondary' }}">🇫🇷 Français</a>
                    <a href="{{ route('lang.switch', ['locale' => 'en']) }}" class="btn btn-sm flex-fill {{ app()->getLocale() === 'en' ? 'btn-primary' : 'btn-outline-secondary' }}">🇬🇧 English</a>
                </div>
            </div>

            <!-- Drawer Footer CTA -->
            <div class="p-3 border-top bg-light">
                <a href="{{ route('contact') }}" class="btn-cta w-100 text-center text-decoration-none justify-content-center d-flex">{{ __('navigation.header.contact_us') }}</a>
            </div>
        </div>
    </div>

    <!-- Search Modal Modal Overlay -->
    <div x-show="searchOpen" 
         x-cloak 
         @keydown.escape.window="searchOpen = false"
         class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-start justify-content-center pt-5" 
         style="z-index: 10001; display: none;">
        <!-- Backdrop clickable -->
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-75" 
             @click="searchOpen = false" 
             x-transition.opacity></div>

        <!-- Modal Box -->
        <div class="position-relative bg-white rounded-4 p-4 shadow-2xl w-100 mx-3" 
             style="max-width: 600px; margin-top: 10vh; z-index: 10002;" 
             @click.stop
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0 fw-bold" style="color: var(--ink);">Rechercher sur CARICS-TOGO</h5>
                <button type="button" 
                        @click.stop="searchOpen = false" 
                        class="btn btn-sm btn-light rounded-circle d-flex align-items-center justify-content-center border" 
                        style="width: 36px; height: 36px; cursor: pointer;">
                    <i class="fa-solid fa-xmark text-dark" style="font-size: 1rem;"></i>
                </button>
            </div>
            <form action="{{ route('recherche-expertize-projet') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="search" name="search" class="form-control border-start-0 py-2 ps-0" placeholder="{{ __('navigation.header.search_placeholder') }}" autofocus>
                    <button class="btn btn-primary px-4" type="submit">Chercher</button>
                </div>
            </form>
            <div class="mt-3 text-muted" style="font-size: 0.8rem;">
                Suggestions : <a href="{{ route('recherche-expertize-projet') }}" class="text-accent text-decoration-none">Santé publique</a>, <a href="{{ route('ressource-publication') }}" class="text-accent text-decoration-none">Rapports</a>, <a href="{{ route('actu-opportunites') }}" class="text-accent text-decoration-none">Opportunités</a>
            </div>
        </div>
    </div>
</header>

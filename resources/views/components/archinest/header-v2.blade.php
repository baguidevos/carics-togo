<header class="carics-header-v2" x-data="{ mobileOpen: false, searchOpen: false }">
    <div class="carics-island-v2">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none py-1">
            <img src="{{ asset('logo_resize.png') }}" alt="CARICS-TOGO" style="height: 44px; object-fit: contain;">
        </a>

        <!-- Desktop Navigation Items (Pill Style) -->
        <nav class="d-none d-lg-flex align-items-center gap-1">
            <a href="{{ route('home') }}" class="carics-nav-chip-v2 {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fa-regular fa-house" style="font-size: 0.85rem;"></i>
                <span>{{ __('navigation.menu.home') }}</span>
            </a>

            <!-- Dropdown À propos -->
            <div class="position-relative" x-data="{ dropdownOpen: false }">
                <button type="button" @click="dropdownOpen = !dropdownOpen" @mouseenter="dropdownOpen = true" @mouseleave="dropdownOpen = false" class="carics-nav-chip-v2 border-0 bg-transparent {{ request()->routeIs('about') || request()->routeIs('equipe*') ? 'active' : '' }}">
                    <span>{{ __('navigation.menu.about') }}</span>
                    <i class="fa-solid fa-angle-down" style="font-size: 0.7rem; transition: transform 0.2s;" :style="dropdownOpen ? 'transform: rotate(180deg)' : ''"></i>
                </button>
                <div x-show="dropdownOpen" @mouseenter="dropdownOpen = true" @mouseleave="dropdownOpen = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="position-absolute carics-dropdown-menu-v1 shadow-lg" style="top: calc(100% + 8px); left: 0; display: none;">
                    <a href="{{ route('about') }}" class="carics-dropdown-item-v1">
                        <div class="item-icon"><i class="fa-regular fa-landmark"></i></div>
                        <div>
                            <div class="fw-semibold" style="font-size: 0.88rem;">{{ __('navigation.menu.about_us') }}</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Pôles & Missions</div>
                        </div>
                    </a>
                    <a href="{{ route('equipe') }}" class="carics-dropdown-item-v1">
                        <div class="item-icon"><i class="fa-regular fa-users"></i></div>
                        <div>
                            <div class="fw-semibold" style="font-size: 0.88rem;">{{ __('navigation.menu.governance') }}</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Direction & Chercheurs</div>
                        </div>
                    </a>
                </div>
            </div>

            <a href="{{ route('recherche-expertize-projet') }}" class="carics-nav-chip-v2 {{ request()->routeIs('recherche-expertize-projet') ? 'active' : '' }}">
                <span>{{ __('navigation.menu.research_projects') }}</span>
            </a>

            <a href="{{ route('ressource-publication') }}" class="carics-nav-chip-v2 {{ request()->routeIs('ressource-publication') ? 'active' : '' }}">
                <span>{{ __('navigation.menu.resources_publications') }}</span>
            </a>

            <a href="{{ route('actu-opportunites') }}" class="carics-nav-chip-v2 {{ request()->routeIs('actu-opportunites') || request()->routeIs('news-detail') ? 'active' : '' }}">
                <span>{{ __('navigation.menu.news_opportunities') }}</span>
            </a>
        </nav>

        <!-- Right Side : Langue, Recherche & CTA Glowing -->
        <div class="d-flex align-items-center gap-2">
            <!-- Language Pill -->
            <div class="d-none d-sm-flex align-items-center bg-light p-1 rounded-pill border" style="font-size: 0.78rem;">
                <a href="{{ route('lang.switch', ['locale' => 'fr']) }}" class="px-2 py-1 rounded-pill text-decoration-none transition-all {{ app()->getLocale() === 'fr' ? 'bg-white shadow-sm fw-bold text-primary' : 'text-muted' }}">FR</a>
                <a href="{{ route('lang.switch', ['locale' => 'en']) }}" class="px-2 py-1 rounded-pill text-decoration-none transition-all {{ app()->getLocale() === 'en' ? 'bg-white shadow-sm fw-bold text-primary' : 'text-muted' }}">EN</a>
            </div>

            <!-- Search Icon Button -->
            <button type="button" @click="searchOpen = true" class="btn btn-light rounded-circle d-flex align-items-center justify-content-center border" style="width: 38px; height: 38px;" title="Rechercher">
                <i class="fa-solid fa-magnifying-glass text-muted" style="font-size: 0.85rem;"></i>
            </button>

            <!-- Glow CTA Button -->
            <a href="{{ route('contact') }}" class="carics-btn-glow d-none d-md-inline-flex">
                <span>{{ __('navigation.header.contact_us') }}</span>
                <i class="fa-solid fa-arrow-right-long"></i>
            </a>

            <!-- Mobile Hamburger -->
            <button type="button" @click.stop="mobileOpen = true" class="btn btn-light d-lg-none d-flex align-items-center justify-content-center rounded-circle border" style="width: 40px; height: 40px;" title="Ouvrir le menu">
                <i class="fa-solid fa-bars-staggered text-dark"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer Glassmorphism -->
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

        <!-- Drawer Body with smooth right-slide -->
        <div class="position-absolute top-0 end-0 h-100 bg-white carics-drawer-panel shadow-2xl d-flex flex-column p-4" 
             style="width: 330px; max-width: 88vw; border-top-left-radius: 24px; border-bottom-left-radius: 24px;" 
             @click.stop
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full">
            
            <div class="d-flex align-items-center justify-content-between pb-3 border-bottom">
                <img src="{{ asset('logo_resize.png') }}" alt="Logo" style="height: 38px;">
                <button type="button" 
                        @click.stop="mobileOpen = false" 
                        class="btn btn-light rounded-circle d-flex align-items-center justify-content-center border p-2" 
                        style="width: 36px; height: 36px;">
                    <i class="fa-solid fa-xmark text-dark"></i>
                </button>
            </div>

            <div class="py-3 flex-grow-1 overflow-auto" x-data="{ aboutOpen: false }">
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('home') }}" class="carics-mobile-link carics-nav-chip-v2 w-100 justify-content-start py-2 px-3 {{ request()->routeIs('home') ? 'active' : '' }}"><i class="fa-regular fa-house me-2"></i> {{ __('navigation.menu.home') }}</a>
                    
                    <div>
                        <button type="button" @click="aboutOpen = !aboutOpen" class="carics-nav-chip-v2 w-100 justify-content-between py-2 px-3 border-0 bg-transparent">
                            <span><i class="fa-regular fa-circle-info me-2"></i> {{ __('navigation.menu.about') }}</span>
                            <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem; transition: transform 0.2s;" :style="aboutOpen ? 'transform: rotate(180deg)' : ''"></i>
                        </button>
                        <div x-show="aboutOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="ps-4 pt-1 d-flex flex-column gap-1">
                            <a href="{{ route('about') }}" class="carics-mobile-link carics-nav-chip-v2 py-1 px-3 text-muted" style="font-size: 0.85rem;">• {{ __('navigation.menu.about_us') }}</a>
                            <a href="{{ route('equipe') }}" class="carics-mobile-link carics-nav-chip-v2 py-1 px-3 text-muted" style="font-size: 0.85rem;">• {{ __('navigation.menu.governance') }}</a>
                        </div>
                    </div>

                    <a href="{{ route('recherche-expertize-projet') }}" class="carics-mobile-link carics-nav-chip-v2 w-100 justify-content-start py-2 px-3 {{ request()->routeIs('recherche-expertize-projet') ? 'active' : '' }}"><i class="fa-regular fa-microscope me-2"></i> {{ __('navigation.menu.research_projects') }}</a>
                    <a href="{{ route('ressource-publication') }}" class="carics-mobile-link carics-nav-chip-v2 w-100 justify-content-start py-2 px-3 {{ request()->routeIs('ressource-publication') ? 'active' : '' }}"><i class="fa-regular fa-books me-2"></i> {{ __('navigation.menu.resources_publications') }}</a>
                    <a href="{{ route('actu-opportunites') }}" class="carics-mobile-link carics-nav-chip-v2 w-100 justify-content-start py-2 px-3 {{ request()->routeIs('actu-opportunites') || request()->routeIs('news-detail') ? 'active' : '' }}"><i class="fa-regular fa-newspaper me-2"></i> {{ __('navigation.menu.news_opportunities') }}</a>
                </div>

                <!-- Language selection in Drawer -->
                <div class="mt-4 p-3 bg-light rounded-4">
                    <div class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.7rem;">Langue / Language</div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('lang.switch', ['locale' => 'fr']) }}" class="btn btn-sm flex-fill rounded-pill {{ app()->getLocale() === 'fr' ? 'btn-primary' : 'btn-outline-secondary' }}">🇫🇷 FR</a>
                        <a href="{{ route('lang.switch', ['locale' => 'en']) }}" class="btn btn-sm flex-fill rounded-pill {{ app()->getLocale() === 'en' ? 'btn-primary' : 'btn-outline-secondary' }}">🇬🇧 EN</a>
                    </div>
                </div>
            </div>

            <div class="pt-3 border-top">
                <a href="{{ route('contact') }}" class="carics-btn-glow w-100 justify-content-center text-center py-2">{{ __('navigation.header.contact_us') }}</a>
            </div>
        </div>
    </div>

    <!-- Search Popup Modal -->
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
        <div class="position-relative bg-white rounded-4 p-4 shadow-lg w-100 mx-3" 
             style="max-width: 560px; margin-top: 10vh; z-index: 10002;" 
             @click.stop
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="fa-solid fa-magnifying-glass text-accent"></i> 
                    <span>Exploration Rapide</span>
                </h5>
                <button type="button" 
                        @click.stop="searchOpen = false" 
                        class="btn btn-sm btn-light rounded-circle d-flex align-items-center justify-content-center border" 
                        style="width: 36px; height: 36px; cursor: pointer;">
                    <i class="fa-solid fa-xmark text-dark" style="font-size: 1rem;"></i>
                </button>
            </div>
            <form action="{{ route('recherche-expertize-projet') }}" method="GET">
                <div class="input-group">
                    <input type="search" name="search" class="form-control py-2 ps-3 rounded-start-pill" placeholder="Mots-clés (ex: nutrition, épidémiologie, publications...)" autofocus>
                    <button class="btn btn-primary px-4 rounded-end-pill" type="submit">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
</header>

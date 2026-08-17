@php
    $slides = [
        [
            'image' => asset('images/banners/ban2.webp'),
            'badge' => 'Centre de Recherche & d\'Action en Santé Publique',
            'title' => __('home.hero.title'),
            'description' => __('home.hero.description'),
            'primary_cta' => [
                'label' => __('home.hero.our_projects'),
                'route' => route('recherche-expertize-projet'),
                'icon' => 'fa-solid fa-flask-vial',
            ],
            'secondary_cta' => [
                'label' => __('navigation.menu.about'),
                'route' => route('about'),
                'icon' => 'fa-solid fa-circle-info',
            ],
        ],
        [
            'image' => asset('images/banners/ban3.webp'),
            'badge' => 'Innovation & Sciences de la Mise en Œuvre',
            'title' => 'Des Données Probantes pour l\'Action.',
            'description' => 'Documenter les interventions sous conditions réelles pour renforcer la qualité et la durabilité des soins.',
            'primary_cta' => [
                'label' => 'Nos Domaines d\'Expertise',
                'route' => route('recherche-expertize-projet'),
                'icon' => 'fa-solid fa-microscope',
            ],
            'secondary_cta' => [
                'label' => 'Rejoindre notre réseau',
                'route' => route('contact'),
                'icon' => 'fa-solid fa-handshake',
            ],
        ],
        [
            'image' => asset('images/banners/ban1.webp'),
            'badge' => 'Ancrage Communautaire & Vocation Africaine',
            'title' => 'Rapprocher la Recherche des Communautés.',
            'description' => 'Concevoir des approches innovantes avec les acteurs locaux pour relever les défis prioritaires de santé.',
            'primary_cta' => [
                'label' => 'Découvrir nos publications',
                'route' => route('ressource-publication'),
                'icon' => 'fa-solid fa-book-open',
            ],
            'secondary_cta' => [
                'label' => 'Contactez-nous',
                'route' => route('contact'),
                'icon' => 'fa-solid fa-paper-plane',
            ],
        ],
    ];
@endphp

<section class="banner-section-three position-relative overflow-hidden">
    <div class="banner-active swiper">
        <div class="swiper-wrapper">
            @foreach ($slides as $slide)
                <div class="swiper-slide position-relative">
                    <div class="bg bg-image position-absolute top-0 start-0 w-100 h-100" style="background-image: url('{{ $slide['image'] }}'); background-size: cover; background-position: center;"></div>
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.315) 0%, rgba(15, 23, 42, 0.70) 100%);"></div>
                    
                    <div class="auto-container position-relative py-5" style="z-index: 2; min-height: 540px; display: flex; align-items: center;">
                        <div class="banner-slider w-100">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-xl-8">
                                    <div class="content-box text-white">
                                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-opacity-15 text-white fw-semibold small mb-3 border border-white border-opacity-20 backdrop-blur">
                                            <i class="fa fa-solid fa-microscope text-warning"></i> {{ $slide['badge'] }}
                                        </div>
                                        <h1 class="display-4 fw-bold text-white mb-3" style="line-height: 1.2; letter-spacing: -0.02em;">
                                            {{ $slide['title'] }}
                                        </h1>
                                        <p class="lead text-white-50 mb-4" style="font-size: 1.15rem; line-height: 1.7; max-width: 680px;">
                                            {{ $slide['description'] }}
                                        </p>
                                        <div class="d-flex flex-wrap gap-3 align-items-center">
                                            <a href="{{ $slide['primary_cta']['route'] }}" class="btn btn-primary rounded-pill px-4 py-3 fw-semibold shadow">
                                                <i class="{{ $slide['primary_cta']['icon'] }} me-2"></i> {{ $slide['primary_cta']['label'] }}
                                            </a>
                                            <a href="{{ $slide['secondary_cta']['route'] }}" class="btn btn-outline-light rounded-pill px-4 py-3 fw-semibold">
                                                <i class="{{ $slide['secondary_cta']['icon'] }} me-2"></i> {{ $slide['secondary_cta']['label'] }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xl-4 d-none d-lg-block text-end">
                                    <div class="p-4 rounded-3 border-success border-opacity-20 d-inline-block text-start text-white shadow-lg" style="backdrop-filter: blur(8px); max-width: 260px; background-color: #19875447;">
                                        <div class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-2">2026</div>
                                        <div class="small text-white-50 mb-1">Fondé à Dapaong</div>
                                        <div class="fw-bold text-white fs-6">Centre Scientifique & Communautaire</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Flèches de navigation du slider -->
        <div class="d-none d-md-flex align-items-center gap-2 position-absolute bottom-0 end-0 me-5 mb-4" style="z-index: 10;">
            <button class="array-prev btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;" title="Précédent">
                <i class="fa fa-solid fa-arrow-left"></i>
            </button>
            <button class="array-next btn btn-primary rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;" title="Suivant">
                <i class="fa fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
</section>
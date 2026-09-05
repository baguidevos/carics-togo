@php
    $dbSlides = \App\Models\HeroSlide::active()->ordered()->with('media')->get();

    if ($dbSlides->isNotEmpty()) {
        $slides = $dbSlides->map(function ($slide) {
            $imageUrl = $slide->image_url ?: asset('images/banners/ban2.webp');
            return [
                'image' => $imageUrl,
                'badge' => $slide->badge ?: __('hero.slides.slide_1.badge'),
                'title' => $slide->title,
                'description' => $slide->description,
                'primary_cta' => [
                    'label' => $slide->primary_cta_label ?: __('hero.slides.slide_1.primary_cta'),
                    'route' => $slide->primary_cta_url ? (str_starts_with($slide->primary_cta_url, 'http') || str_starts_with($slide->primary_cta_url, '/') ? $slide->primary_cta_url : route($slide->primary_cta_url)) : route('recherche-expertize-projet'),
                    'icon' => $slide->primary_cta_icon ?: 'fa-solid fa-flask-vial',
                ],
                'secondary_cta' => [
                    'label' => $slide->secondary_cta_label ?: __('hero.slides.slide_1.secondary_cta'),
                    'route' => $slide->secondary_cta_url ? (str_starts_with($slide->secondary_cta_url, 'http') || str_starts_with($slide->secondary_cta_url, '/') ? $slide->secondary_cta_url : route($slide->secondary_cta_url)) : route('about'),
                    'icon' => $slide->secondary_cta_icon ?: 'fa-solid fa-circle-info',
                ],
            ];
        })->all();
    } else {
        $slides = [
            [
                'image' => asset('images/banners/ban2.webp'),
                'badge' => __('hero.slides.slide_1.badge'),
                'title' => __('hero.slides.slide_1.title'),
                'description' => __('hero.slides.slide_1.description'),
                'primary_cta' => [
                    'label' => __('hero.slides.slide_1.primary_cta'),
                    'route' => route('recherche-expertize-projet'),
                    'icon' => 'fa-solid fa-flask-vial',
                ],
                'secondary_cta' => [
                    'label' => __('hero.slides.slide_1.secondary_cta'),
                    'route' => route('about'),
                    'icon' => 'fa-solid fa-circle-info',
                ],
            ],
            [
                'image' => asset('images/banners/ban3.webp'),
                'badge' => __('hero.slides.slide_2.badge'),
                'title' => __('hero.slides.slide_2.title'),
                'description' => __('hero.slides.slide_2.description'),
                'primary_cta' => [
                    'label' => __('hero.slides.slide_2.primary_cta'),
                    'route' => route('recherche-expertize-projet'),
                    'icon' => 'fa-solid fa-microscope',
                ],
                'secondary_cta' => [
                    'label' => __('hero.slides.slide_2.secondary_cta'),
                    'route' => route('contact'),
                    'icon' => 'fa-solid fa-handshake',
                ],
            ],
            [
                'image' => asset('images/banners/ban1.webp'),
                'badge' => __('hero.slides.slide_3.badge'),
                'title' => __('hero.slides.slide_3.title'),
                'description' => __('hero.slides.slide_3.description'),
                'primary_cta' => [
                    'label' => __('hero.slides.slide_3.primary_cta'),
                    'route' => route('ressource-publication'),
                    'icon' => 'fa-solid fa-book-open',
                ],
                'secondary_cta' => [
                    'label' => __('hero.slides.slide_3.secondary_cta'),
                    'route' => route('contact'),
                    'icon' => 'fa-solid fa-paper-plane',
                ],
            ],
        ];
    }
@endphp

<style>
    .hero-slide-elem {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .swiper-slide-active .hero-slide-elem {
        opacity: 1;
        transform: translateY(0);
    }
    .swiper-slide-active .delay-1 { transition-delay: 0.2s; }
    .swiper-slide-active .delay-2 { transition-delay: 0.35s; }
    .swiper-slide-active .delay-3 { transition-delay: 0.5s; }
    .swiper-slide-active .delay-4 { transition-delay: 0.65s; }

    .hero-slide-elem-right {
        opacity: 0;
        transform: translateX(40px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .swiper-slide-active .hero-slide-elem-right {
        opacity: 1;
        transform: translateX(0);
        transition-delay: 0.65s;
    }
</style>

<section class="banner-section-three position-relative overflow-hidden">
    <div class="banner-active swiper">
        <div class="swiper-wrapper">
            @foreach ($slides as $slide)
                <div class="swiper-slide position-relative">
                    <div class="bg bg-image position-absolute top-0 start-0 w-100 h-100" style="background-image: url('{{ $slide['image'] }}'); background-size: cover; background-position: center 25%;"></div>
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.315) 0%, rgba(15, 23, 42, 0.70) 100%);"></div>
                    
                    <div class="auto-container position-relative py-5" style="z-index: 2; min-height: 540px; display: flex; align-items: center;">
                        <div class="banner-slider w-100">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-xl-8">
                                    <div class="content-box text-white">
                                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-opacity-15 text-white fw-semibold small mb-3 border border-white border-opacity-20 backdrop-blur hero-slide-elem delay-1">
                                            <i class="fa fa-solid fa-microscope text-warning"></i> {{ $slide['badge'] }}
                                        </div>
                                        <h1 class="display-4 fw-bold text-white mb-3 hero-slide-elem delay-2" style="line-height: 1.2; letter-spacing: -0.02em;">
                                            {{ $slide['title'] }}
                                        </h1>
                                        <p class="lead text-white-50 mb-4 hero-slide-elem delay-3" style="font-size: 1.15rem; line-height: 1.7; max-width: 680px;">
                                            {{ $slide['description'] }}
                                        </p>
                                        <div class="d-flex flex-wrap gap-3 align-items-center hero-slide-elem delay-4">
                                            <a href="{{ $slide['primary_cta']['route'] }}" class="btn btn-primary rounded-pill px-4 py-1 fw-semibold shadow">
                                                <i class="{{ $slide['primary_cta']['icon'] }} me-2"></i> {{ $slide['primary_cta']['label'] }}
                                            </a>
                                            {{-- <a href="{{ $slide['secondary_cta']['route'] }}" class="btn btn-outline-light rounded-pill px-4 py-1 fw-semibold">
                                                <i class="{{ $slide['secondary_cta']['icon'] }} me-2"></i> {{ $slide['secondary_cta']['label'] }}
                                            </a> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xl-4 d-none d-lg-block text-end">
                                    <div class="p-4 rounded-3 border-success border-opacity-20 d-inline-block text-start text-white shadow-lg hero-slide-elem-right" style="backdrop-filter: blur(8px); max-width: 260px; background-color: #19875447;">
                                        <div class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-2">{{ __('hero.badge_year') }}</div>
                                        <div class="small text-white-50 mb-1">{{ __('hero.founded_in') }}</div>
                                        <div class="fw-bold text-white fs-6">{{ __('hero.badge_count') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Flèches de navigation du slider -->
        <div class="d-none d-md-flex align-items-center gap-2 position-absolute bottom-0 end-0 me-5" style="z-index: 10; margin-bottom: 5rem;">
            <button class="array-prev btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;" title="{{ __('hero.prev') }}">
                <i class="fa fa-solid fa-arrow-left"></i>
            </button>
            <button class="array-next btn btn-primary rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;" title="{{ __('hero.next') }}">
                <i class="fa fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>

    <!-- Definition Banner -->
    <div class="position-absolute bottom-0 start-0 w-100" style="z-index: 11; background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(10px); border-top: 1px solid rgba(255,255,255,0.1);">
        <div class="auto-container py-3">
            <div class="d-flex align-items-center justify-content-center">
                <span class="text-warning fw-bold text-uppercase text-center text-lg-start" style="letter-spacing: 2px; font-size: 1.1rem;">
                    Centre Africain d'Action pour la Recherche et l'Innovation Communautaire en Santé
                </span>
            </div>
        </div>
    </div>
</section>
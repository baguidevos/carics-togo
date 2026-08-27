@props([
    'page' => null,
    'title' => '',
    'subtitle' => null,
    'breadcrumb' => null,
    'defaultImage' => 'images/banners/ban2.webp',
    'parentRoute' => 'home',
    'parentLabel' => null,
])

@php
    $banner = $page ? \App\Models\PageBanner::forPage($page) : null;
    $displayTitle = ($banner && !empty($banner->title)) ? $banner->title : $title;
    $displaySubtitle = ($banner && !empty($banner->subtitle)) ? $banner->subtitle : $subtitle;
    $displayBreadcrumb = ($banner && !empty($banner->breadcrumb_title)) ? $banner->breadcrumb_title : ($breadcrumb ?: $displayTitle);
    $parentText = $parentLabel ? __($parentLabel) : __('navigation.menu.home');
    
    $layoutType = $banner?->layout_type ?? 'full';
    $imagePosition = $banner?->image_position ?? 'center';

    $isSlider = $banner && $banner->hero_media_type === 'slider';
    $sliderImages = $isSlider ? $banner->getSliderImages() : [];
    if (empty($sliderImages) && $isSlider) {
        $sliderImages = [$banner->image_url ?: (str_starts_with($defaultImage, 'http') ? $defaultImage : asset($defaultImage))];
    }
    $singleImageUrl = $banner?->image_url ?: (str_starts_with($defaultImage, 'http') ? $defaultImage : asset($defaultImage));
@endphp

@if ($layoutType === 'split')
    {{-- ========================================================================= --}}
    {{-- Mode "Split" : Mise en page 2 colonnes (Format contenu & image encadrée)   --}}
    {{-- ========================================================================= --}}
    <section class="page-title page-title--split position-relative overflow-hidden" 
             style="background: linear-gradient(135deg, #1B3A6B 0%, #008A5E 100%); padding: 120px 0 80px; min-height: 380px;">
        
        <div class="auto-container position-relative" style="z-index: 2;">
            <div class="row align-items-center g-4 g-lg-5">
                {{-- Colonne Gauche : Titre, sous-titre & fil d'Ariane --}}
                <div class="col-lg-7 text-start">
                    <ul class="page-breadcrumb d-flex flex-wrap align-items-center gap-2 mb-3 list-unstyled" style="padding-left: 0;">
                        <li><a href="{{ route($parentRoute) }}" class="text-white opacity-75">{{ $parentText }}</a></li>
                        <li class="text-white opacity-50">/</li>
                        <li class="text-white fw-medium">{{ $displayBreadcrumb }}</li>
                    </ul>
                    <h1 class="title text-white mb-3" style="font-size: clamp(2rem, 3.5vw, 3rem); line-height: 1.15; font-weight: 700;">
                        {{ $displayTitle }}
                    </h1>
                    @if ($displaySubtitle)
                        <p class="text-white lead mb-0 opacity-75" style="font-size: 1.05rem; line-height: 1.6; max-width: 620px;">
                            {{ $displaySubtitle }}
                        </p>
                    @endif
                </div>

                {{-- Colonne Droite : Carte visuelle encadrée (fixe ou slider) --}}
                <div class="col-lg-5">
                    <div class="banner-split-card position-relative rounded-4 overflow-hidden" 
                         style="height: 290px; border: 1px solid rgba(255, 255, 255, 0.15); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6); background: #1e293b;">
                        
                        @if ($isSlider && count($sliderImages) > 1)
                            <div x-data="{
                                current: 0,
                                total: {{ count($sliderImages) }},
                                images: {{ Js::from($sliderImages) }},
                                autoplay: true,
                                timer: null,
                                start() {
                                    this.timer = setInterval(() => {
                                        if (this.autoplay) this.current = (this.current + 1) % this.total;
                                    }, 4500);
                                }
                            }"
                            x-init="start()"
                            @mouseenter="autoplay = false"
                            @mouseleave="autoplay = true"
                            class="w-100 h-100 position-relative">
                                <template x-for="(img, idx) in images" :key="'split-img-' + idx">
                                    <img :src="img" 
                                         x-show="current === idx"
                                         x-transition:enter="transition ease-out duration-700"
                                         x-transition:enter-start="opacity-0 scale-105"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-500"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         alt="{{ $displayTitle }}"
                                         class="position-absolute top-0 start-0 w-100 h-100"
                                         :style="'object-fit: cover; object-position: ' + '{{ $imagePosition }}' + ';'">
                                </template>

                                {{-- Indicateurs du Slider --}}
                                <div class="position-absolute bottom-0 start-50 translate-middle-x mb-3 d-flex gap-2" style="z-index: 3;">
                                    <template x-for="(img, idx) in images" :key="'split-dot-' + idx">
                                        <button type="button" 
                                                @click="current = idx" 
                                                class="border-0 p-0 transition-all" 
                                                :style="current === idx ? 'width: 22px; height: 5px; border-radius: 3px; background: #ffffff;' : 'width: 7px; height: 5px; border-radius: 3px; background: rgba(255,255,255,0.4);'"
                                                :title="'Photo ' + (idx + 1)">
                                        </button>
                                    </template>
                                </div>
                            </div>
                        @else
                            <img src="{{ $singleImageUrl }}" 
                                 alt="{{ $displayTitle }}" 
                                 class="w-100 h-100" 
                                 style="object-fit: cover; object-position: {{ $imagePosition }};">
                        @endif

                        {{-- Vignette intérieure --}}
                        <div class="position-absolute top-0 start-0 w-100 h-100 pointer-events-none" 
                             style="box-shadow: inset 0 0 25px rgba(0,0,0,0.3); pointer-events: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@elseif ($isSlider && count($sliderImages) > 1)
    {{-- ========================================================================= --}}
    {{-- Mode "Plein écran" avec Slider Défilant                                   --}}
    {{-- ========================================================================= --}}
    <section class="page-title position-relative overflow-hidden" 
             x-data="{
                 current: 0,
                 total: {{ count($sliderImages) }},
                 images: {{ Js::from($sliderImages) }},
                 autoplay: true,
                 timer: null,
                 start() {
                     this.timer = setInterval(() => {
                         if (this.autoplay) this.next();
                     }, 5000);
                 },
                 next() {
                     this.current = (this.current + 1) % this.total;
                 },
                 prev() {
                     this.current = (this.current - 1 + this.total) % this.total;
                 },
                 goTo(i) {
                     this.current = i;
                 }
             }"
             x-init="start()"
             @mouseenter="autoplay = true"
             @mouseleave="autoplay = true">

        {{-- Diapositives d'arrière-plan avec transition fluide et position personnalisée --}}
        <template x-for="(img, idx) in images" :key="idx">
            <div x-show="current === idx"
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 scale-105"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-700"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="position-absolute top-0 start-0 w-100 h-100 bg-cover"
                 :style="'background-image: url(' + img + '); background-size: cover; background-position: {{ $imagePosition }};'">
            </div>
        </template>

        {{-- Calque sombre & gradient d'origine --}}
        <div class="position-absolute top-0 start-0 w-100 h-100" 
             style="background: linear-gradient(180deg, rgba(15, 23, 42, 0.65) 0%, rgba(15, 23, 42, 0.45) 50%, rgba(15, 23, 42, 0.75) 100%); z-index: 1;">
        </div>

        {{-- Contenu textuel --}}
        <div class="auto-container position-relative" style="z-index: 2;">
            <div class="title-outer text-center">
                <h1 class="title text-white">{{ $displayTitle }}</h1>
                @if ($displaySubtitle)
                    <p class="text-white-50 lead mb-3" style="max-width: 750px; margin: 0 auto; font-size: 1.1rem;">
                        {{ $displaySubtitle }}
                    </p>
                @endif
                <ul class="page-breadcrumb">
                    <li><a href="{{ route($parentRoute) }}">{{ $parentText }}</a></li>
                    <li>{{ $displayBreadcrumb }}</li>
                </ul>
            </div>
        </div>

        {{-- Contrôles du Slider --}}
        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-3 d-flex gap-2" style="z-index: 3;">
            <template x-for="(img, idx) in images" :key="'dot-' + idx">
                <button type="button" 
                        @click="goTo(idx)" 
                        class="border-0 transition-all p-0" 
                        :style="current === idx ? 'width: 28px; height: 6px; border-radius: 3px; background: #ffffff;' : 'width: 8px; height: 6px; border-radius: 3px; background: rgba(255,255,255,0.4);'"
                        :title="'Bannière ' + (idx + 1)">
                </button>
            </template>
        </div>
    </section>
@else
    {{-- ========================================================================= --}}
    {{-- Mode "Plein écran" avec Image Fixe                                        --}}
    {{-- ========================================================================= --}}
    <section class="page-title position-relative" 
             style="background-image: url('{{ $singleImageUrl }}'); background-size: cover; background-position: {{ $imagePosition }};">
        <div class="auto-container position-relative" style="z-index: 2;">
            <div class="title-outer text-center">
                <h1 class="title">{{ $displayTitle }}</h1>
                @if ($displaySubtitle)
                    <p class="text-white-50 lead mb-3" style="max-width: 750px; margin: 0 auto; font-size: 1.1rem;">
                        {{ $displaySubtitle }}
                    </p>
                @endif
                <ul class="page-breadcrumb">
                    <li><a href="{{ route($parentRoute) }}">{{ $parentText }}</a></li>
                    <li>{{ $displayBreadcrumb }}</li>
                </ul>
            </div>
        </div>
    </section>
@endif

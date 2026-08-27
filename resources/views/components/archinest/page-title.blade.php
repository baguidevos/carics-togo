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
    
    $isSlider = $banner && $banner->hero_media_type === 'slider';
    $sliderImages = $isSlider ? $banner->getSliderImages() : [];
    if (empty($sliderImages) && $isSlider) {
        $sliderImages = [$banner->image_url ?: (str_starts_with($defaultImage, 'http') ? $defaultImage : asset($defaultImage))];
    }
    $singleImageUrl = $banner?->image_url ?: (str_starts_with($defaultImage, 'http') ? $defaultImage : asset($defaultImage));
@endphp

@if ($isSlider && count($sliderImages) > 1)
    {{-- Version En-tête avec Slider Défilant --}}
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
             @mouseenter="autoplay = false"
             @mouseleave="autoplay = true">

        {{-- Diapositives d'arrière-plan avec transition fluide --}}
        <template x-for="(img, idx) in images" :key="idx">
            <div x-show="current === idx"
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 scale-105"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-700"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="position-absolute top-0 start-0 w-100 h-100 bg-cover bg-top"
                 :style="'background-image: url(' + img + '); background-size: cover; background-position: top;'">
            </div>
        </template>

        {{-- Calque sombre & gradient --}}
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
    {{-- Version En-tête avec Image Fixe --}}
    <section class="page-title position-relative" style="background-image: url('{{ $singleImageUrl }}'); background-size: cover; background-position: top;">
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

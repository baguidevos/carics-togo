<?php

use App\Models\News;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    public string $slug;
    public News $news;
    public $recentNews;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        $this->news = News::published()
            ->with(['category', 'relatedBlogPost', 'media'])
            ->where('slug', $slug)
            ->firstOrFail();

        $this->recentNews = News::published()
            ->with('media')
            ->where('id', '!=', $this->news->id)
            ->recent()
            ->take(3)
            ->get();
    }

    public function getReadingTimeProperty(): int
    {
        $wordCount = str_word_count(strip_tags($this->news->content . ' ' . $this->news->excerpt));
        return max(1, (int) ceil($wordCount / 200));
    }

    /** Photos de la galerie (collection 'gallery' et images) */
    public function getGalleryMediaProperty()
    {
        $gallery = $this->news->getMedia('gallery');
        if ($gallery->isNotEmpty()) {
            return $gallery;
        }

        return $this->news->getMedia('news_attachments')->filter(function ($media) {
            return str_starts_with($media->mime_type ?? '', 'image/');
        });
    }

    /** Documents et fichiers téléchargeables (PDF, Word, etc.) */
    public function getDocumentMediaProperty()
    {
        return $this->news->getMedia('news_attachments')->filter(function ($media) {
            return !str_starts_with($media->mime_type ?? '', 'image/');
        });
    }
};
?>

<div>
    <!-- En-tête Page Banner -->
    <section class="page-title" style="background-image: url({{ asset('images/banner.jpg') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">{{ __('navigation.menu.home') }}</a></li>
                    <li><a href="{{ route('actu-opportunites') }}">{{ __('news_opp.title') }}</a></li>
                    <li>{{ Str::limit($news->title, 45) }}</li>
                </ul>
                <h1 class="title" style="font-size: clamp(1.8rem, 3.5vw, 2.6rem); max-width: 900px; margin: 0 auto; line-height: 1.3;">
                    {{ $news->title }}
                </h1>
            </div>
        </div>
    </section>

    <!-- Corps de l'actualité -->
    <section class="section py-5 bg-white">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <!-- Colonne Principale -->
                <div class="col-lg-8">
                    <article class="news-article">
                        <!-- Métadonnées & Catégorie -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pb-3 mb-4 border-bottom">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-1 rounded-pill">
                                    <i class="fa fa-solid fa-tag me-1 small"></i> {{ $news->category?->name ?? __('news_opp.tabs.news') }}
                                </span>
                                @if ($news->event_date)
                                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small">
                                        <i class="fa fa-regular fa-calendar-days text-primary me-1"></i> {{ $news->event_date }}
                                    </span>
                                @elseif ($news->published_date)
                                    <span class="text-muted small">
                                        <i class="fa fa-regular fa-calendar me-1"></i> {{ $news->published_date->translatedFormat('d F Y') }}
                                    </span>
                                @endif
                                @if ($news->location)
                                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small">
                                        <i class="fa fa-solid fa-location-dot text-danger me-1"></i> {{ $news->location }}
                                    </span>
                                @endif
                                <span class="text-muted small">
                                    • <i class="fa fa-regular fa-clock me-1"></i> {{ $this->readingTime }} {{ __('news_opp.detail.reading_time') }}
                                </span>
                            </div>

                            <!-- Partage rapide Alpine.js -->
                            <div x-data="{ 
                                copied: false,
                                shareUrl: window.location.href,
                                copyLink() {
                                    navigator.clipboard.writeText(this.shareUrl);
                                    this.copied = true;
                                    setTimeout(() => this.copied = false, 2500);
                                }
                            }" class="d-flex align-items-center gap-2">
                                <button type="button" @click="copyLink()" class="btn btn-sm btn-light border rounded-pill px-3" title="{{ __('news_opp.detail.share') }}">
                                    <i class="fa fa-regular fa-copy me-1"></i>
                                    <span x-text="copied ? '{{ __('news_opp.detail.link_copied') }}' : '{{ __('news_opp.detail.share') }}'"></span>
                                </button>
                                <a :href="'https://wa.me/?text=' + encodeURIComponent('{{ $news->title }} - ' + shareUrl)" target="_blank" class="btn btn-sm btn-outline-success rounded-circle p-2" title="WhatsApp">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                                <a :href="'https://twitter.com/intent/tweet?text=' + encodeURIComponent('{{ $news->title }}') + '&url=' + encodeURIComponent(shareUrl)" target="_blank" class="btn btn-sm btn-outline-dark rounded-circle p-2" title="X">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                                <a :href="'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(shareUrl)" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle p-2" title="LinkedIn">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Image de couverture principale (Gérée par Spatie Media Library) -->
                        @if ($news->cover_image_url)
                            <figure class="mb-4 rounded-4 overflow-hidden shadow-sm border" style="max-height: 480px; background: #f8fafc;">
                                <img src="{{ $news->getCoverImageUrl('large') }}" 
                                     alt="{{ $news->getFirstMedia('cover')?->getCustomProperty('alt') ?: $news->title }}" 
                                     decoding="async"
                                     class="w-100 h-100 object-fit-cover" 
                                     style="object-fit: cover; max-height: 480px;">
                                @if ($news->getFirstMedia('cover')?->getCustomProperty('caption'))
                                    <figcaption class="p-2 text-center text-muted small bg-light">
                                        {{ $news->getFirstMedia('cover')->getCustomProperty('caption') }}
                                    </figcaption>
                                @endif
                            </figure>
                        @endif

                        <!-- Chapô / Résumé -->
                        @if ($news->excerpt)
                            <div class="p-3 p-md-4 rounded-3 mb-4 border-start border-4 border-primary" style="background: linear-gradient(135deg, #f8faff 0%, #f0f6ff 100%);">
                                <p class="lead text-dark fw-medium mb-0" style="line-height: 1.6; font-size: 1.15rem;">
                                    {{ $news->excerpt }}
                                </p>
                            </div>
                        @endif

                        <!-- Contenu Riche avec images et médias Spatie -->
                        <div class="article-content text-secondary" style="font-size: 1.05rem; line-height: 1.8;">
                            @if ($news->content)
                                {!! $news->content !!}
                            @else
                                <p>{{ $news->excerpt }}</p>
                            @endif
                        </div>

                        <!-- Galerie Photos Spatie Media Library -->
                        @if ($this->galleryMedia->isNotEmpty())
                            <div x-data="{
                                activeImage: null,
                                images: {{ Js::from($this->galleryMedia->map(fn($m) => ['url' => $m->getUrl(), 'name' => $m->name])->values()) }},
                                open(url) {
                                    this.activeImage = url;
                                },
                                close() {
                                    this.activeImage = null;
                                }
                            }" 
                            @keydown.escape.window="close()"
                            class="mt-5 p-4 rounded-4 bg-light border">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3 class="h6 fw-bold text-dark mb-0">
                                        <i class="fa fa-solid fa-images text-primary me-2"></i> {{ __('news_opp.detail.gallery_title') }}
                                    </h3>
                                    <span class="badge bg-primary-subtle text-primary rounded-pill small">
                                        {{ $this->galleryMedia->count() }} {{ $this->galleryMedia->count() > 1 ? __('news_opp.detail.photos_plural') : __('news_opp.detail.photos') }}
                                    </span>
                                </div>
                                <div class="row g-3">
                                    @foreach ($this->galleryMedia as $photo)
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div @click="open('{{ $photo->getUrl() }}')" 
                                                 class="rounded-3 overflow-hidden shadow-sm border position-relative cursor-pointer transition-all hover-scale" 
                                                 style="height: 120px; cursor: pointer; background: #e2e8f0;">
                                                <img src="{{ $photo->hasGeneratedConversion('thumb') ? $photo->getUrl('thumb') : $photo->getUrl() }}" 
                                                     alt="{{ $photo->name }}" 
                                                     loading="lazy" 
                                                     decoding="async" 
                                                     class="w-100 h-100 object-fit-cover" 
                                                     style="object-fit: cover;">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center opacity-0 hover-opacity transition-all">
                                                    <i class="fa fa-solid fa-magnifying-glass-plus text-white fs-5"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Visionneuse Lightbox Plein Écran -->
                                <template x-if="activeImage">
                                    <div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center p-3" 
                                         style="z-index: 10000; background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(5px);"
                                         @click.self="close()">
                                        <button type="button" @click="close()" class="btn btn-light rounded-circle position-absolute top-0 end-0 m-4 shadow" style="width: 44px; height: 44px;">
                                            <i class="fa fa-solid fa-xmark fs-5"></i>
                                        </button>
                                        <img :src="activeImage" alt="Aperçu grand format" class="img-fluid rounded-4 shadow-2xl" style="max-height: 88vh; max-width: 92vw; object-fit: contain;">
                                    </div>
                                </template>
                            </div>
                        @endif

                        <!-- Documents & Pièces Jointes Spatie Media Library -->
                        @if ($this->documentMedia->isNotEmpty())
                            <div class="mt-4 p-4 rounded-4 bg-white border">
                                <h3 class="h6 fw-bold text-dark mb-3">
                                    <i class="fa fa-solid fa-paperclip text-primary me-2"></i> {{ __('news_opp.detail.docs_title') }}
                                </h3>
                                <div class="d-flex flex-column gap-2">
                                    @foreach ($this->documentMedia as $doc)
                                        <div class="p-3 rounded-3 bg-light d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fa fa-regular fa-file-pdf text-danger fs-4"></i>
                                                <div>
                                                    <div class="fw-semibold text-dark small">{{ $doc->file_name }}</div>
                                                    <div class="text-muted" style="font-size: .75rem;">{{ $doc->human_readable_size }}</div>
                                                </div>
                                            </div>
                                            <a href="{{ $doc->getUrl() }}" download class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                <i class="fa fa-solid fa-download me-1"></i> {{ __('news_opp.detail.download') }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Liens & Références associés -->
                        @if ($news->relatedBlogPost)
                            <div class="mt-5 p-4 rounded-4 bg-light border d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                <div>
                                    <span class="badge bg-primary text-white rounded-pill mb-1">{{ __('news_opp.detail.related_article') }}</span>
                                    <h4 class="h6 fw-bold text-dark mb-0">{{ $news->relatedBlogPost->title }}</h4>
                                </div>
                                <a href="{{ route('about') }}" class="btn btn-primary btn-sm rounded-pill px-4 align-self-start align-self-md-center text-nowrap">
                                    {{ __('news_opp.detail.read_full_article') }} <i class="fa fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @endif

                        <!-- Bouton Retour -->
                        <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('actu-opportunites') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fa fa-solid fa-arrow-left me-1"></i> {{ __('news_opp.detail.back_to_news') }}
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4">
                                {{ __('news_opp.detail.collaborate_btn') }} <i class="fa fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Barre Latérale -->
                <div class="col-lg-4">
                    <aside class="sidebar d-flex flex-column gap-4">
                        <!-- Bloc Organisation -->
                        <div class="card p-4 border-0 rounded-4 shadow-sm text-white" style="background: linear-gradient(135deg, #1B3A6B 0%, #008A5E 100%);">
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-20 text-white fw-semibold small mb-3">
                                <i class="fa fa-solid fa-shield-halved"></i> CARICS-Togo
                            </div>
                            <h3 class="h5 fw-bold text-white mb-2">{{ __('news_opp.detail.org_side_title') }}</h3>
                            <p class="text-white-50 small mb-3">
                                {{ __('news_opp.detail.org_side_desc') }}
                            </p>
                            <a href="{{ route('about') }}" class="btn btn-light rounded-pill btn-sm fw-semibold text-primary align-self-start">
                                {{ __('news_opp.detail.discover_center') }} <i class="fa fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                        <!-- Bloc Autres Actualités -->
                        @if ($recentNews->isNotEmpty())
                            <div class="card p-4 border rounded-4 shadow-sm bg-white">
                                <h3 class="h6 fw-bold text-dark mb-3 pb-2 border-bottom">
                                    <i class="fa fa-solid fa-newspaper text-primary me-2"></i> {{ __('news_opp.detail.recent_news') }}
                                </h3>
                                <div class="d-flex flex-column gap-3">
                                    @foreach ($recentNews as $recent)
                                        <a href="{{ route('news-detail', ['slug' => $recent->slug]) }}" class="text-decoration-none group">
                                            <div class="d-flex gap-3 align-items-start">
                                                @if ($recent->cover_image_url)
                                                    <img src="{{ $recent->cover_image_url }}" alt="" class="rounded-3" style="width: 70px; height: 60px; object-fit: cover; flex-shrink: 0;">
                                                @else
                                                    <div class="rounded-3 bg-light d-flex align-items-center justify-content-center text-primary" style="width: 70px; height: 60px; flex-shrink: 0;">
                                                        <i class="fa fa-regular fa-image"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <span class="badge bg-light text-muted border small mb-1" style="font-size: .75rem;">
                                                        {{ $recent->published_date?->format('d/m/Y') }}
                                                    </span>
                                                    <h4 class="h6 text-dark fw-semibold mb-0" style="font-size: .9rem; line-height: 1.3;">
                                                        {{ Str::limit($recent->title, 55) }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Bloc Newsletter -->
                        <div class="card p-4 border rounded-4 shadow-sm bg-white">
                            <h3 class="h6 fw-bold text-dark mb-2">
                                <i class="fa fa-regular fa-paper-plane text-primary me-2"></i> {{ __('news_opp.detail.newsletter_title') }}
                            </h3>
                            <p class="text-muted small mb-3">
                                {{ __('news_opp.detail.newsletter_desc') }}
                            </p>
                            <livewire:archinest.⚡newsletter-form />
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
</div>

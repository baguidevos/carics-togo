<?php

use App\Models\BlogPost;
use App\Models\News;
use App\Models\Opportunity;
use App\Models\Partner;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    #[Url(as: 'tab')]
    public string $activeTab = 'actu';

    #[Url(as: 'opp_type')]
    public string $opportunityType = 'all';

    public function with(): array
    {
        $featuredNews = News::published()->featured()->with('category')->first() ?? News::published()->recent()->with('category')->first();
        $otherNews = News::published()->recent()
            ->when($featuredNews, fn($q) => $q->where('id', '!=', $featuredNews->id))
            ->take(6)
            ->get();

        $blogPosts = BlogPost::published()->featured()->take(3)->get();

        $opportunitiesQuery = Opportunity::open()->with('category')
            ->when($this->opportunityType !== 'all', function ($query) {
                if ($this->opportunityType === 'jobs') {
                    $query->whereIn('contract_type', ['cdd', 'cdi', 'consultation', 'consultance']);
                } elseif ($this->opportunityType === 'internships') {
                    $query->where('contract_type', 'stage');
                } elseif ($this->opportunityType === 'scholarships') {
                    $query->whereIn('contract_type', ['benevolat', 'bourse']);
                }
            })
            ->orderBy('deadline', 'asc');

        return [
            'featuredNews'   => $featuredNews,
            'otherNews'      => $otherNews,
            'blogPosts'      => $blogPosts,
            'opportunities'  => $opportunitiesQuery->get(),
            'jobsCount'      => Opportunity::open()->whereIn('contract_type', ['cdd', 'cdi', 'consultation', 'consultance'])->count(),
            'internshipsCount' => Opportunity::open()->where('contract_type', 'stage')->count(),
            'scholarshipsCount' => Opportunity::open()->whereIn('contract_type', ['benevolat', 'bourse'])->count(),
            'partners'       => Partner::active()->ordered()->get(),
        ];
    }
};
?>

<div>

    <!-- Start main-content -->
    <section class="page-title" style="background-image: url({{ asset('images/banner.jpg') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">{{ __('news_opp.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">{{ __('navigation.menu.home') }}</a></li>
                    <li>{{ __('news_opp.title') }}</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ============ TABS & FILTRES LIVEWIRE ============ -->
    <section class="section-sm pb-0" style="background:var(--white); border-bottom:1px solid var(--line);">
        <div class="container">
            <ul class="nav nav-carics" role="tablist">
                <li class="nav-item">
                    <button 
                        type="button" 
                        wire:click="$set('activeTab', 'actu')" 
                        class="nav-link {{ $activeTab === 'actu' ? 'active' : '' }}"
                    >
                        <i class="fa fa-solid fa-newspaper me-1"></i> {{ __('news_opp.tabs.news') }}
                    </button>
                </li>
                <li class="nav-item">
                    <button 
                        type="button" 
                        wire:click="$set('activeTab', 'opportunites')" 
                        class="nav-link {{ $activeTab === 'opportunites' ? 'active' : '' }}"
                    >
                        <i class="fa fa-solid fa-briefcase me-1"></i> Opportunités & Carrières
                        @if ($jobsCount + $internshipsCount > 0)
                            <span class="badge bg-primary text-white rounded-pill ms-1">{{ $jobsCount + $internshipsCount }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item">
                    <button 
                        type="button" 
                        wire:click="$set('activeTab', 'partenariats')" 
                        class="nav-link {{ $activeTab === 'partenariats' ? 'active' : '' }}"
                    >
                        <i class="fa fa-solid fa-handshake me-1"></i> {{ __('news_opp.tabs.partnerships') }}
                    </button>
                </li>
            </ul>
        </div>
    </section>

    <!-- ============ CONTENU PRINCIPAL ============ -->
    <section class="section py-5">
        <div class="container">

            <!-- ── TAB 1 : ACTUALITÉS & BLOG (Bento Grid) ── -->
            @if ($activeTab === 'actu')
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-1 rounded-pill small mb-1">
                                Publications & Événements
                            </span>
                            <h2 class="h3 fw-bold text-dark mb-0">Fil d'actualité scientifique & communautaire</h2>
                        </div>
                    </div>

                    <!-- Bento Grid -->
                    <div class="row g-4">
                        <!-- Actualité à la une (Grand format) -->
                        @if ($featuredNews)
                            <div class="col-lg-8">
                                <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-sm position-relative text-white p-4 p-md-5 d-flex flex-column justify-content-end" 
                                     style="min-height: 380px; background: linear-gradient(180deg, rgba(27,58,107,0.3) 0%, rgba(27,58,107,0.95) 100%), url('{{ $featuredNews->cover_image_url ?? asset('archinest/images/resource/faq-h2-1.jpg') }}') center/cover no-repeat;">
                                    <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                                        <span class="badge bg-primary px-3 py-1 rounded-pill fw-medium">
                                            {{ $featuredNews->category?->name ?? 'À la une' }}
                                        </span>
                                        @if ($featuredNews->published_date)
                                            <span class="badge bg-dark bg-opacity-50 text-white rounded-pill px-3 py-1 small">
                                                <i class="fa fa-regular fa-calendar me-1"></i> {{ $featuredNews->published_date->format('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="h3 fw-bold text-white mb-2" style="line-height: 1.3;">
                                        {{ $featuredNews->title }}
                                    </h3>
                                    <p class="text-white-50 mb-4 small" style="max-width: 38rem;">
                                        {{ Str::limit($featuredNews->excerpt, 180) }}
                                    </p>
                                    <div>
                                        <a href="{{ route('news-detail', ['slug' => $featuredNews->slug]) }}" class="btn btn-light rounded-pill px-4 fw-semibold text-primary">
                                            Lire le communiqué <i class="fa fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Carte latérale : Focus & Newsletter rapide -->
                        <div class="col-lg-4">
                            <div class="card h-100 p-4 border-0 rounded-4 shadow-sm text-white d-flex flex-column justify-content-between" style="background: linear-gradient(135deg, #1B3A6B 0%, #008A5E 100%);">
                                <div>
                                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-20 text-white fw-semibold small mb-3">
                                        <i class="fa fa-solid fa-bullhorn"></i> Veille & Savoirs
                                    </div>
                                    <h4 class="h4 fw-bold text-white mb-2">Restez informé de nos avancées</h4>
                                    <p class="text-white-50 small mb-4">
                                        Recevez directement nos rapports de recherche, opportunités de bourses et notes de politique sanitaire.
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('contact') }}#newsletter" class="btn btn-outline-light rounded-pill w-100 py-2 fw-semibold">
                                        <i class="fa fa-solid fa-envelope me-1"></i> S'abonner aux alertes
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Liste des autres actualités -->
                        @foreach ($otherNews as $item)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 p-4 border rounded-4 bg-white shadow-sm d-flex flex-column justify-content-between transition-all hover-shadow">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge bg-light text-primary border px-2 py-1 rounded-pill small">
                                                {{ $item->category?->name ?? 'Actualité' }}
                                            </span>
                                            @if ($item->published_date)
                                                <span class="text-muted small">
                                                    <i class="fa fa-regular fa-calendar me-1"></i>{{ $item->published_date->format('d/m/Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        <h4 class="h6 fw-bold text-dark mb-2" style="line-height: 1.4;">
                                            <a href="{{ route('news-detail', ['slug' => $item->slug]) }}" class="text-dark text-decoration-none hover-primary">
                                                {{ $item->title }}
                                            </a>
                                        </h4>
                                        @if ($item->location || $item->event_date)
                                            <div class="d-flex flex-wrap gap-2 align-items-center mb-2" style="font-size: .8rem;">
                                                @if ($item->event_date)
                                                    <span class="text-muted"><i class="fa fa-regular fa-calendar-days text-primary me-1"></i>{{ $item->event_date }}</span>
                                                @endif
                                                @if ($item->location)
                                                    <span class="text-muted"><i class="fa fa-solid fa-location-dot text-danger me-1"></i>{{ $item->location }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        <p class="text-secondary small mb-3" style="line-height: 1.5;">
                                            {{ Str::limit($item->excerpt, 130) }}
                                        </p>
                                    </div>
                                    <div class="pt-2 border-top">
                                        <a href="{{ route('news-detail', ['slug' => $item->slug]) }}" class="text-primary fw-medium small text-decoration-none">
                                            Lire la suite <i class="fa fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- ── TAB 2 : OPPORTUNITÉS & CARRIÈRES ── -->
            @if ($activeTab === 'opportunites')
                <div>
                    <div class="row align-items-center mb-4">
                        <div class="col-lg-7">
                            <span class="badge bg-success-subtle text-success fw-semibold px-3 py-1 rounded-pill small mb-1">
                                Recrutements & Stages
                            </span>
                            <h2 class="h3 fw-bold text-dark mb-0">Rejoignez l'équipe du CARICS</h2>
                        </div>
                        <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                            <!-- Filtre rapide -->
                            <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                                <button 
                                    type="button" 
                                    wire:click="$set('opportunityType', 'all')" 
                                    class="btn btn-sm rounded-pill px-3 {{ $opportunityType === 'all' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                                >
                                    Toutes
                                </button>
                                <button 
                                    type="button" 
                                    wire:click="$set('opportunityType', 'jobs')" 
                                    class="btn btn-sm rounded-pill px-3 {{ $opportunityType === 'jobs' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                                >
                                    Emplois ({{ $jobsCount }})
                                </button>
                                <button 
                                    type="button" 
                                    wire:click="$set('opportunityType', 'internships')" 
                                    class="btn btn-sm rounded-pill px-3 {{ $opportunityType === 'internships' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                                >
                                    Stages ({{ $internshipsCount }})
                                </button>
                            </div>
                        </div>
                    </div>

                    @if ($opportunities->isNotEmpty())
                        <div class="row g-4">
                            @foreach ($opportunities as $opp)
                                @php
                                    $isNearDeadline = $opp->deadline && $opp->deadline->isFuture() && $opp->deadline->diffInDays(now()) <= 7;
                                    $contractBadge = match($opp->contract_type) {
                                        'cdi', 'cdd' => ['class' => 'bg-primary-subtle text-primary', 'label' => strtoupper($opp->contract_type)],
                                        'stage'      => ['class' => 'bg-info-subtle text-info-emphasis', 'label' => 'STAGE & MENTORAT'],
                                        'benevolat'  => ['class' => 'bg-warning-subtle text-warning-emphasis', 'label' => 'BÉNÉVOLAT / BOURSE'],
                                        default      => ['class' => 'bg-secondary-subtle text-secondary', 'label' => strtoupper($opp->contract_type ?? 'OPPORTUNITÉ')],
                                    };
                                @endphp
                                <div class="col-lg-6">
                                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white d-flex flex-column justify-content-between transition-all hover-shadow">
                                        <div>
                                            <!-- En-tête -->
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge {{ $contractBadge['class'] }} fw-semibold px-3 py-1 rounded-pill small">
                                                    {{ $contractBadge['label'] }}
                                                </span>
                                                @if ($opp->deadline)
                                                    <span class="badge {{ $isNearDeadline ? 'bg-danger text-white' : 'bg-light text-muted border' }} px-2 py-1 small">
                                                        <i class="fa fa-regular fa-clock me-1"></i> Date limite : {{ $opp->deadline->format('d/m/Y') }}
                                                        @if ($isNearDeadline)
                                                            (Urgent)
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Titre & Lieu -->
                                            <h3 class="h5 fw-bold text-dark mb-1">{{ $opp->title }}</h3>
                                            @if ($opp->location)
                                                <p class="text-muted small mb-3">
                                                    <i class="fa fa-solid fa-location-dot text-danger me-1"></i> {{ $opp->location }}
                                                </p>
                                            @endif

                                            <!-- Description -->
                                            <div class="text-secondary small mb-3" style="line-height: 1.6;">
                                                {!! Str::limit(strip_tags($opp->description), 200) !!}
                                            </div>

                                            <!-- Prérequis -->
                                            @if (!empty($opp->requirements))
                                                <div class="d-flex flex-wrap gap-1 mb-3">
                                                    @foreach ((array) $opp->requirements as $req)
                                                        <span class="badge bg-light text-secondary border small fw-normal">
                                                            ✓ {{ $req }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Actions -->
                                        <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                                            @if ($opp->application_email)
                                                <a href="mailto:{{ $opp->application_email }}?subject=Candidature : {{ rawurlencode($opp->title) }}" class="btn btn-sm btn-primary rounded-pill px-4">
                                                    Postuler par email <i class="fa fa-solid fa-paper-plane ms-1"></i>
                                                </a>
                                            @elseif ($opp->application_url)
                                                <a href="{{ $opp->application_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary rounded-pill px-4">
                                                    Postuler en ligne <i class="fa fa-solid fa-arrow-up-right-from-square ms-1"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('contact') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                                                    Nous contacter <i class="fa fa-solid fa-envelope ms-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5 bg-white rounded-4 border p-4">
                            <div class="mb-3 text-muted" style="font-size: 3rem;">
                                <i class="fa fa-solid fa-briefcase"></i>
                            </div>
                            <h4 class="h5 fw-bold text-dark mb-2">Aucune offre ouverte actuellement</h4>
                            <p class="text-muted small mb-3">Nous n'avons pas d'appel à candidatures pour cette catégorie en ce moment.</p>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill px-4 btn-sm">
                                Déposer une candidature spontanée
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- ── TAB 3 : PARTENARIATS & ALLIANCES ── -->
            @if ($activeTab === 'partenariats')
                <div>
                    <div class="text-center max-w-700 mx-auto mb-5">
                        <span class="badge bg-info-subtle text-info-emphasis fw-semibold px-3 py-1 rounded-pill small mb-1">
                            Réseau Institutionnel
                        </span>
                        <h2 class="h3 fw-bold text-dark mb-2">Nos Partenaires Techniques & Scientifiques</h2>
                        <p class="text-muted">
                            Le CARICS collabore avec les ministères, universités, agences onusiennes et ONG internationales pour maximiser l'impact de la recherche.
                        </p>
                    </div>

                    @if ($partners->isNotEmpty())
                        <div class="row g-4 justify-content-center">
                            @foreach ($partners as $partner)
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="card h-100 p-4 border rounded-4 bg-white shadow-sm text-center d-flex flex-column justify-content-center align-items-center transition-all hover-shadow">
                                        @if ($partner->logo_url)
                                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="img-fluid mb-3" style="max-height: 60px; object-fit: contain;">
                                        @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                                <i class="fa fa-solid fa-building text-primary fs-4"></i>
                                            </div>
                                        @endif
                                        <h4 class="h6 fw-bold text-dark mb-1">{{ $partner->name }}</h4>
                                        <span class="badge bg-light text-muted border small mb-2">{{ ucfirst(str_replace('_', ' ', $partner->type ?? 'Partenaire')) }}</span>
                                        @if ($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="text-primary small text-decoration-none mt-2">
                                                Visiter le site <i class="fa fa-solid fa-arrow-up-right-from-square ms-1 small"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5 bg-white rounded-4 border p-4">
                            <p class="text-muted mb-0">Partenaires en cours d'actualisation.</p>
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </section>

</div>
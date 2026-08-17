<?php

use App\Models\News;
use App\Models\Partner;
use App\Models\Publication;
use App\Models\ResearchProject;
use App\Models\TeamMember;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    public function with(): array
    {
        return [
            'members'           => TeamMember::published()->with('media')->ordered()->take(4)->get(),
            'partners'          => Partner::active()->ordered()->get(),
            'latestNews'        => News::published()->with(['category', 'media'])->recent()->take(3)->get(),
            'featuredProject'   => ResearchProject::published()->with(['partners', 'media', 'lead'])->featured()->first() ?? ResearchProject::published()->first(),
            'statsProjects'     => ResearchProject::published()->count(),
            'statsMembers'      => TeamMember::published()->count(),
            'statsPublications' => Publication::published()->count(),
            'statsPartners'     => Partner::active()->count(),
        ];
    }
};
?>

<div>
    <!-- ============ SECTION 1 : HERO BANNER & SLIDER ============ -->
    <x-archinest.hero />

    <!-- ============ SECTION 2 : MISSION & VISION (DUO BENTO) ============ -->
    <section class="section py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <!-- Carte Mission -->
                <div class="col-lg-6">
                    <div class="card h-100 p-4 p-lg-5 border-0 rounded-4 shadow-sm text-white hover-shadow transition-all d-flex flex-column justify-content-between" style="background: linear-gradient(135deg, #1B3A6B 0%, #204b8a 100%);">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white bg-opacity-20 text-white mb-4" style="width: 54px; height: 54px; font-size: 1.5rem;">
                                <i class="fa fa-solid fa-bullseye text-warning"></i>
                            </div>
                            <div class="badge bg-success text-white p-2 rounded-pill small mb-2">
                                Engagement & Action
                            </div>
                            <h2 class="h3 fw-bold text-white mb-3">{{ __('home.mission.title') }}</h2>
                            <p class="text-white-50 lead mb-0" style="font-size: 1.05rem; line-height: 1.7;">
                                {{ __('home.mission.description') }}
                            </p>
                        </div>
                        <div class="pt-4 mt-4 border-top border-white border-opacity-10 d-flex justify-content-between align-items-center">
                            <span class="small text-white-50">Impact durable & équitable</span>
                            <a href="{{ route('about') }}" class="text-white text-decoration-none fw-semibold small">
                                En savoir plus <i class="fa fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Carte Vision -->
                <div class="col-lg-6">
                    <div class="card h-100 p-4 p-lg-5 border-0 rounded-4 shadow-sm text-white hover-shadow transition-all d-flex flex-column justify-content-between" style="background: linear-gradient(135deg, #008A5E 0%, #00a872 100%);">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white bg-opacity-20 text-white mb-4" style="width: 54px; height: 54px; font-size: 1.5rem;">
                                <i class="fa fa-solid fa-eye text-warning"></i>
                            </div>
                            <div class="badge bg-primary text-white p-2 rounded-pill small mb-2">
                                Perspective Régionale
                            </div>
                            <h2 class="h3 fw-bold text-white mb-3">{{ __('home.vision.title') }}</h2>
                            <p class="text-white-50 lead mb-0" style="font-size: 1.05rem; line-height: 1.7;">
                                {{ __('home.vision.description') }}
                            </p>
                        </div>
                        <div class="pt-4 mt-4 border-top border-white border-opacity-10 d-flex justify-content-between align-items-center">
                            <span class="small text-white-50">Systèmes de santé résilients</span>
                            <a href="{{ route('about') }}" class="text-white text-decoration-none fw-semibold small">
                                Découvrir notre approche <i class="fa fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SECTION 3 : DOMAINES D'INTERVENTION (AVEC VISUEL DE TERRAIN) ============ -->
    <section class="section py-5 bg-light" id="domaines-intervention">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                        <i class="fa fa-solid fa-flask-vial"></i> Expertise Scientifique
                    </div>
                    <h2 class="h2 fw-bold text-dark mb-2">{{ __('home.interventions.title') }}</h2>
                    <p class="text-secondary lead mb-0" style="font-size: 1.1rem;">
                        {{ __('home.interventions.subtitle') }}
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('recherche-expertize-projet') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
                        <span>Explorer les projets</span>
                        <i class="fa fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <div class="row g-4 align-items-stretch">
                <!-- Colonne Gauche : Image & Appel Visuel de Terrain -->
                <div class="col-lg-4">
                    <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden position-relative" style="min-height: 380px;">
                        <img src="{{ asset('images/hero.jpg') }}" alt="Intervention de terrain CARICS" class="w-100 h-100 object-fit-cover position-absolute top-0 start-0" style="object-fit: cover;">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to top, rgba(15, 23, 42, 0.92) 0%, rgba(15, 23, 42, 0.3) 100%);"></div>
                        <div class="position-relative p-4 text-white d-flex flex-column justify-content-end h-100" style="z-index: 2;">
                            <div class="badge bg-primary text-white rounded-pill px-3 py-1 small mb-2 d-inline-block align-self-start">
                                <i class="fa fa-solid fa-map-location-dot me-1"></i> Ancrage Terrain
                            </div>
                            <h3 class="h5 fw-bold text-white mb-2">Sciences de la Mise en Œuvre & Action Communautaire</h3>
                            <p class="text-white-50 small mb-0" style="line-height: 1.6;">
                                Des recherches contextualisées au plus près des besoins des populations vulnérables et des formations sanitaires.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Colonne Droite : 6 Bento Cards des Domaines -->
                <div class="col-lg-8">
                    <div class="row g-3 h-100">
                        <!-- Domaine 1 -->
                        <div class="col-md-6">
                            <div class="card h-100 p-3 p-md-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary-subtle text-primary flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.2rem;">
                                        <i class="fa fa-solid fa-microscope"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted small fw-bold">#01</span>
                                        <h3 class="h6 fw-bold text-dark mb-1">{{ __('home.interventions.item_1') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Domaine 2 -->
                        <div class="col-md-6">
                            <div class="card h-100 p-3 p-md-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success-subtle text-success flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.2rem;">
                                        <i class="fa fa-solid fa-gears"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted small fw-bold">#02</span>
                                        <h3 class="h6 fw-bold text-dark mb-1">{{ __('home.interventions.item_2') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Domaine 3 -->
                        <div class="col-md-6">
                            <div class="card h-100 p-3 p-md-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-info-subtle text-info flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.2rem;">
                                        <i class="fa fa-solid fa-people-roof"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted small fw-bold">#03</span>
                                        <h3 class="h6 fw-bold text-dark mb-1">{{ __('home.interventions.item_3') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Domaine 4 -->
                        <div class="col-md-6">
                            <div class="card h-100 p-3 p-md-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-warning-subtle text-warning-emphasis flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.2rem;">
                                        <i class="fa fa-solid fa-landmark"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted small fw-bold">#04</span>
                                        <h3 class="h6 fw-bold text-dark mb-1">{{ __('home.interventions.item_4') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Domaine 5 -->
                        <div class="col-md-6">
                            <div class="card h-100 p-3 p-md-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-danger-subtle text-danger flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.2rem;">
                                        <i class="fa fa-solid fa-chart-pie"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted small fw-bold">#05</span>
                                        <h3 class="h6 fw-bold text-dark mb-1">{{ __('home.interventions.item_5') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Domaine 6 -->
                        <div class="col-md-6">
                            <div class="card h-100 p-3 p-md-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.2rem; background: #ede9fe; color: #6d28d9;">
                                        <i class="fa fa-solid fa-laptop-medical"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted small fw-bold">#06</span>
                                        <h3 class="h6 fw-bold text-dark mb-1">{{ __('home.interventions.item_6') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SECTION 4 : PROJET PHARE (AVEC VISUEL & DÉTAILS) ============ -->
    <section class="section py-5 bg-white" id="projet-phare">
        <div class="container">
            <div class="card border-0 rounded-4 shadow-sm p-4 p-lg-5" style="background: linear-gradient(135deg, #f8faff 0%, #f0f7ff 100%);">
                <div class="row align-items-center g-4">
                    <!-- Colonne Contenu -->
                    <div class="col-lg-7">
                        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                            <span class="badge bg-primary text-white fw-semibold px-3 py-1 rounded-pill">
                                <i class="fa fa-solid fa-star me-1 text-warning"></i> {{ __('home.featured_project.section_title') }}
                            </span>
                            <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-semibold">
                                <i class="fa fa-solid fa-circle-dot me-1"></i> {{ __('home.featured_project.status_ongoing') }}
                            </span>
                            <span class="badge bg-light text-muted border px-3 py-1 rounded-pill small">
                                <i class="fa fa-solid fa-location-dot text-danger me-1"></i> {{ __('home.featured_project.zone_value') }}
                            </span>
                        </div>

                        <h2 class="h3 fw-bold text-dark mb-3" style="line-height: 1.35;">
                            {{ $featuredProject?->title ?? __('home.featured_project.title') }}
                        </h2>

                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <div class="p-2 bg-white rounded-3 border small">
                                    <span class="text-muted"><i class="fa fa-regular fa-calendar text-primary me-1"></i> {{ __('home.featured_project.period_label') }} :</span>
                                    <strong class="text-dark ms-1">{{ $featuredProject?->start_date ? $featuredProject->start_date->format('Y') . ' – ' . ($featuredProject->end_date?->format('Y') ?? 'En cours') : __('home.featured_project.period_value') }}</strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-2 bg-white rounded-3 border small">
                                    <span class="text-muted"><i class="fa fa-solid fa-hand-holding-dollar text-success me-1"></i> Financement :</span>
                                    <strong class="text-dark ms-1">{{ $featuredProject?->funder ?? 'RSTMH' }}</strong>
                                </div>
                            </div>
                        </div>

                        <p class="text-secondary mb-4" style="line-height: 1.7;">
                            {!! Str::limit(strip_tags($featuredProject?->context ?? __('home.featured_project.description')), 220) !!}
                        </p>

                        <div class="d-flex flex-wrap gap-3 align-items-center">
                            <a href="{{ route('recherche-expertize-projet') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
                                <span>{{ __('navigation.actions.learn_more') }}</span>
                                <i class="fa fa-solid fa-arrow-right ms-2"></i>
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
                                <i class="fa fa-solid fa-handshake me-1"></i> Collaborer
                            </a>
                        </div>
                    </div>

                    <!-- Colonne Visuel Dédié -->
                    <div class="col-lg-5">
                        <div class="card border-0 rounded-4 shadow overflow-hidden position-relative" style="min-height: 340px;">
                            <img src="{{ asset('archinest/images/resource/about-4.jpg') }}" alt="Projet de recherche CARICS" class="w-100 h-100 object-fit-cover position-absolute top-0 start-0" style="object-fit: cover;">
                            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to top, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0.1) 100%);"></div>
                            <div class="position-relative p-4 text-white d-flex flex-column justify-content-end h-100" style="z-index: 2;">
                                <div class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold small align-self-start mb-2">
                                    Impact Région des Savanes
                                </div>
                                <div class="small text-white-50">
                                    ChimioPrévention Saisonnière du Paludisme (CPS) en contexte transfrontalier.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SECTION 5 : CHIFFRES CLES & IMPACT ============ -->
    <section class="section py-5 bg-light" id="chiffres-cles" style="background: linear-gradient(135deg, #1B3A6B 0%, #008A5E 100%);">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <div class="d-inline-flex align-items-center gap-2 bg-success text-white px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                    <i class="fa fa-solid fa-chart-line"></i> Résultats & Métriques
                </div>
                <h2 class="h3 fw-bold text-white mb-2">{{ __('home.stats.section_title') }}</h2>
            </div>

            <div class="row g-4">
                <!-- Stat 1 : Projets Financés -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all text-center">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary mb-3 mx-auto" style="width: 56px; height: 56px; font-size: 1.5rem;">
                            <i class="fa fa-solid fa-flask"></i>
                        </div>
                        <div class="display-5 fw-bold text-primary mb-1">
                            {{ max(1, $statsProjects) }}
                        </div>
                        <h3 class="h6 fw-semibold text-secondary mb-0">{{ __('home.stats.funded_projects') }}</h3>
                    </div>
                </div>

                <!-- Stat 2 : Publications & Rapports -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all text-center">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success mb-3 mx-auto" style="width: 56px; height: 56px; font-size: 1.5rem;">
                            <i class="fa fa-solid fa-book-open"></i>
                        </div>
                        <div class="display-5 fw-bold text-success mb-1">
                            {{ max(5, $statsPublications) }}+
                        </div>
                        <h3 class="h6 fw-semibold text-secondary mb-0">Publications & Rapports</h3>
                    </div>
                </div>

                <!-- Stat 3 : Régions du Togo -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all text-center">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info-subtle text-info mb-3 mx-auto" style="width: 56px; height: 56px; font-size: 1.5rem;">
                            <i class="fa fa-solid fa-map-location-dot"></i>
                        </div>
                        <div class="display-5 fw-bold text-info-emphasis mb-1">
                            5
                        </div>
                        <h3 class="h6 fw-semibold text-secondary mb-0">{{ __('home.stats.intervention_regions') }} (Togo)</h3>
                    </div>
                </div>

                <!-- Stat 4 : Experts & Chercheurs -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all text-center">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning-subtle text-warning-emphasis mb-3 mx-auto" style="width: 56px; height: 56px; font-size: 1.5rem;">
                            <i class="fa fa-solid fa-user-doctor"></i>
                        </div>
                        <div class="display-5 fw-bold text-warning-emphasis mb-1">
                            {{ max(4, $statsMembers) }}
                        </div>
                        <h3 class="h6 fw-semibold text-secondary mb-0">Experts & Chercheurs</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SECTION 6 : LEADERSHIP & GOUVERNANCE ============ -->
    @if ($members->isNotEmpty())
        <section class="section py-5 bg-white" id="leadership">
            <div class="container">
                <div class="row align-items-end mb-4">
                    <div class="col-lg-8">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                            <i class="fa fa-solid fa-users-gear"></i> Direction & Conseil
                        </div>
                        <h2 class="h3 fw-bold text-dark mb-2">{{ __('home.leadership.title') }}</h2>
                        <p class="text-muted mb-0">Des chercheurs et praticiens engagés pour l'excellence et la rigueur scientifique.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                        <a href="{{ route('equipe') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
                            <span>Découvrir toute l'équipe</span>
                            <i class="fa fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach ($members as $member)
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 border rounded-4 shadow-sm bg-white p-3 d-flex flex-column justify-content-between hover-shadow transition-all text-center">
                                <div>
                                    <div class="mb-3 position-relative mx-auto" style="width: 100px; height: 100px;">
                                        @if ($member->avatar_url)
                                            <img src="{{ $member->avatar_url }}" alt="{{ $member->full_name }}" class="rounded-circle w-100 h-100 object-fit-cover shadow-sm border">
                                        @else
                                            <div class="rounded-circle w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold fs-4 shadow-sm" style="background: {{ $member->avatar_color ?? '#1B3A6B' }};">
                                                {{ substr($member->full_name, 0, 2) }}
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="h6 fw-bold text-dark mb-1">
                                        <a href="{{ route('team-detail', ['slug' => $member->slug]) }}" class="text-decoration-none text-dark hover-primary">
                                            {{ $member->full_name }}
                                        </a>
                                    </h3>
                                    <div class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 small mb-2">
                                        {{ $member->role_title }}
                                    </div>
                                    @if ($member->bio_short)
                                        <p class="text-secondary small mb-3" style="line-height: 1.5;">
                                            {{ Str::limit($member->bio_short, 80) }}
                                        </p>
                                    @endif
                                </div>

                                <div class="pt-2 border-top">
                                    <a href="{{ route('team-detail', ['slug' => $member->slug]) }}" class="btn btn-sm btn-light border rounded-pill w-100 text-primary fw-medium">
                                        {{ __('navigation.actions.view_profile') }} <i class="fa fa-solid fa-arrow-right ms-1 small"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ============ SECTION 7 : DERNIÈRES ACTUALITÉS & PUBLICATIONS ============ -->
    @if ($latestNews->isNotEmpty())
        <section class="section py-5 bg-light" id="actualites-recentes">
            <div class="container">
                <div class="row align-items-end mb-4">
                    <div class="col-lg-8">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success-subtle text-success fw-semibold small mb-2">
                            <i class="fa fa-solid fa-newspaper"></i> Actualités Récentes
                        </div>
                        <h2 class="h3 fw-bold text-dark mb-2">Dernières nouvelles du terrain & de la recherche</h2>
                        <p class="text-muted mb-0">Suivez les avancées scientifiques, les ateliers de formation et les interventions communautaires du CARICS.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                        <a href="{{ route('actu-opportunites') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
                            <span>Toutes les actualités</span>
                            <i class="fa fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach ($latestNews as $newsItem)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="card h-100 p-4 border rounded-4 bg-white shadow-sm d-flex flex-column justify-content-between transition-all hover-shadow">
                                <div>
                                    @if ($newsItem->cover_image_url)
                                        <div class="mb-3 rounded-3 overflow-hidden" style="height: 180px; background: #f1f5f9;">
                                            <img src="{{ $newsItem->getCoverImageUrl('thumb') }}" 
                                                 alt="{{ $newsItem->title }}" 
                                                 loading="lazy" 
                                                 decoding="async" 
                                                 class="w-100 h-100 object-fit-cover" 
                                                 style="object-fit: cover;">
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-light text-primary border px-2 py-1 rounded-pill small">
                                            {{ $newsItem->category?->name ?? 'Actualité' }}
                                        </span>
                                        @if ($newsItem->published_date)
                                            <span class="text-muted small">
                                                <i class="fa fa-regular fa-calendar me-1"></i>{{ $newsItem->published_date->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="h5 fw-bold text-dark mb-2" style="line-height: 1.4;">
                                        <a href="{{ route('news-detail', ['slug' => $newsItem->slug]) }}" class="text-dark text-decoration-none hover-primary">
                                            {{ $newsItem->title }}
                                        </a>
                                    </h3>
                                    <p class="text-secondary small mb-3" style="line-height: 1.5;">
                                        {{ Str::limit($newsItem->excerpt, 120) }}
                                    </p>
                                </div>
                                <div class="pt-3 border-top">
                                    <a href="{{ route('news-detail', ['slug' => $newsItem->slug]) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Lire l'article <i class="fa fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ============ SECTION 8 : PARTENAIRES & APPEL A COLLABORATION ============ -->
    <section class="section py-5 bg-white" id="partenariats-accueil">
        <div class="container">
            <div class="card border-0 rounded-4 shadow-sm p-4 p-lg-5 text-white text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #1B3A6B 0%, #008A5E 100%);">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success bg-opacity-20 text-white fw-semibold small mb-3 mx-auto">
                    <i class="fa fa-solid fa-handshake"></i> {{ __('home.work_together.title') }}
                </div>
                <h2 class="h2 fw-bold text-white mb-3">{{ __('home.work_together.title') }}</h2>
                <div class="max-w-700 mx-auto text-white-50 mb-4" style="line-height: 1.8; font-size: 1.05rem;">
                    {{ __('home.work_together.description') }}
                </div>

                @if ($partners->isNotEmpty())
                    <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                        @foreach ($partners as $partner)
                            <span class="badge bg-white text-dark px-3 py-2 rounded-pill shadow-sm fw-medium">
                                <i class="fa fa-solid fa-building-columns text-primary me-1"></i> {{ $partner->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('recherche-expertize-projet') }}" class="btn btn-light text-primary rounded-pill px-4 py-2 fw-semibold shadow">
                        <i class="fa fa-solid fa-microscope me-1"></i> {{ __('navigation.actions.discover_works') }}
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold">
                        <i class="fa fa-solid fa-paper-plane me-1"></i> {{ __('navigation.actions.become_partner') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
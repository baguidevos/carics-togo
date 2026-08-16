<?php

use App\Models\ResearchProject;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $selectedStatus = 'all';

    public function resetFilters(): void
    {
        $this->search = '';
        $this->selectedStatus = 'all';
    }

    public function with(): array
    {
        $projectsQuery = ResearchProject::published()
            ->with(['lead', 'partners'])
            ->when($this->search !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', "%{$this->search}%")
                        ->orWhere('context', 'like', "%{$this->search}%")
                        ->orWhere('objective', 'like', "%{$this->search}%")
                        ->orWhere('funder', 'like', "%{$this->search}%")
                        ->orWhere('region', 'like', "%{$this->search}%");
                });
            })
            ->when($this->selectedStatus !== 'all', function ($query) {
                $query->where('status', $this->selectedStatus);
            })
            ->ordered();

        return [
            'featuredProject' => ResearchProject::published()->featured()->with('lead', 'partners')->first() ?? ResearchProject::published()->first(),
            'projects'        => $projectsQuery->get(),
            'allProjects'     => ResearchProject::published()->get(),
            'totalCount'      => ResearchProject::published()->count(),
        ];
    }
};
?>

<div>
    <!-- Start main-content -->
    <section class="page-title" style="background-image: url({{ asset('images/banner.jpg') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">{{ __('research.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">{{ __('navigation.menu.home') }}</a></li>
                    <li>{{ __('research.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->

    <!-- Expertise Six -->
    <section class="faq-section-home-two">
        <div class="auto-container">
            <div class="sec-title-box gap-4 gap-xl-0">
                <div class="sec-title-style-three">
                    {{-- <h6 class="sub-title">// // Expertise //</h6> --}}
                    <h2 class="title text-reveal-anim">{{ __('research.header.title') }}</h2>
                </div>
                <div class="sec-right-box">
                    <div class="text">
                        {{ __('research.header.intro') }}
                    </div>
                    <a href="{{ route('contact') }}" class="theme-btn btn-style-one">
                        <span class="btn-title">{{ __('navigation.actions.learn_more') }}</span>
                        <span class="icon"><i class="fa-light fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
            <div class="row clearfix">
                <!-- Column -->
                <div class="image-column col-xl-4 col-lg-4">
                    <figure class="image reveal">
                        <img src="{{ asset('archinest/images/resource/faq-h2-1.jpg') }}" alt="">
                    </figure>
                </div>

                <!-- Column -->
                <div class="column col-xl-7 col-lg-8 offset-xl-1">
                    <!-- Accordion Box / Style Three -->
                    <ul class="accordion-box">

                        <!-- Block -->
                        <li class="accordion block active-block">
                            <div class="acc-btn active">
                                {{ __('research.domains.item_1_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content current">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_1_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.item_2_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_2_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.item_3_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_3_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.item_4_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_4_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.item_5_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_5_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.item_6_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_6_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.priorities_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.priorities_intro') }}
                                        <ul>
                                            <li>• {{ __('research.domains.priority_1') }}</li>
                                            <li>• {{ __('research.domains.priority_2') }}</li>
                                            <li>• {{ __('research.domains.priority_3') }}</li>
                                            <li>• {{ __('research.domains.priority_4') }}</li>
                                            <li>• {{ __('research.domains.priority_5') }}</li>
                                            <li>• {{ __('research.domains.priority_6') }}</li>
                                            <li>• {{ __('research.domains.priority_7') }}</li>
                                            <li>• {{ __('research.domains.priority_8') }}</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Expertise Six -->

    <!-- Projet phare Section -->
    <section class="project-details pt-120 pb-70">
        <div class="auto-container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 mb-5 mb-lg-0">
                    <div class="sec-title-style-three">
                        {{-- <h6 class="sub-title">// Projets //</h6> --}}
                        <h2 class="title text-reveal-anim wow fadeInUp" data-wow-delay=".3s">
                            {{ __('research.featured_project.section_title') }}
                        </h2>
                        <p class="text wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                            {{ $featuredProject?->title ?? __('research.featured_project.project_title') }}
                        </p>
                    </div>
                    <a href="{{ route('contact') }}" class="theme-btn btn-style-one">
                        <span class="btn-title">{{ __('navigation.actions.collaborate') ?? 'Collaborer' }}</span> <i class="icon fa-light fa-arrow-right"></i>
                    </a>

                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-7">
                    <div class="project-details__content-right mt-0">
                        <div class="project-details__details-box rounded-0">
                            <ul class="list-unstyled project-details__details-list">
                                <li>
                                    <h4 class="project-details__name mb-2">{{ __('research.featured_project.period_label') }}</h4>
                                    <p class="project-details__client">
                                        @if ($featuredProject?->start_date)
                                            {{ $featuredProject->start_date->format('Y') }} – {{ $featuredProject->end_date?->format('Y') ?? 'En cours' }}
                                        @else
                                            {{ __('research.featured_project.period_value') }}
                                        @endif
                                    </p>
                                </li>
                                <li>
                                    <h4 class="project-details__name mb-2">{{ __('research.featured_project.zone_label') }}</h4>
                                    <p class="project-details__client">
                                        @if (!empty($featuredProject?->intervention_zones))
                                            {{ implode(', ', $featuredProject->intervention_zones) }} ({{ $featuredProject->region ?? 'Togo' }})
                                        @else
                                            {{ __('research.featured_project.zone_value') }}
                                        @endif
                                    </p>
                                </li>
                                <li>
                                    <h4 class="project-details__name mb-2">{{ __('research.featured_project.funding_label') }}</h4>
                                    <p class="project-details__client">{{ $featuredProject?->funder ?? __('research.featured_project.funding_value') }}</p>
                                </li>
                                <li>
                                    <h4 class="project-details__name mb-2">{{ __('research.featured_project.status_label') }}</h4>
                                    <p class="project-details__client">
                                        @if ($featuredProject?->status === 'en_cours')
                                            <span class="badge bg-success-subtle text-success px-2 py-1">{{ __('research.featured_project.status_value') }}</span>
                                        @else
                                            {{ ucfirst(str_replace('_', ' ', $featuredProject?->status ?? '')) }}
                                        @endif
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5 mb-lg-0">
                <div class="">
                    <div class="project-details__top mt-5">
                        <div class="project-details__img"> <img class="rounded-0"
                                src="{{ asset('archinest/images/resource/project-details-2.jpg') }}" alt=""> </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-lg-center">
                <div class="col-lg-6">
                    <div class="sec-title mb-40">
                        <h2 class="title mb-30 wow splt-txt" data-splitting="">
                            {{ __('research.featured_project.context_title') }}
                        </h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="project-details__top mt-lg-5">
                        <div class="text mb-40">
                            {{ $featuredProject?->context ?? __('research.featured_project.context_text') }}
                        </div>

                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-5 mb-lg-0">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="sec-title mb-40">
                        <h2 class="title mb-30 wow splt-txt" data-splitting="">{{ __('research.featured_project.details_title') }}</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="project-details__top mt-lg-5">
                        <div class="project-list-item mb-5">
                            <h5 class="title">
                                <i class="icon fa-classic fa-solid fa-circle-check fa-fw mr-15"></i>
                                {{ __('research.featured_project.objective_title') }}
                            </h5>
                            <div class="text">
                                {{ $featuredProject?->objective ?? __('research.featured_project.objective_text') }}
                            </div>
                        </div>
                        <div class="project-list-item mb-5">
                            <h5 class="title"><i class="icon fa-classic fa-solid fa-circle-check fa-fw mr-15"></i>
                                {{ __('research.featured_project.results_title') }}</h5>
                            <div class="text">
                                <ul>
                                    @if (!empty($featuredProject?->expected_results))
                                        @foreach ($featuredProject->expected_results as $res)
                                            <li class="d-flex align-items-center"><i
                                                    class="icon fa-classic fa-solid fa-check fa-fw"></i>{{ $res }}</li>
                                        @endforeach
                                    @else
                                        <li class="d-flex align-items-center"><i
                                                class="icon fa-classic fa-solid fa-check fa-fw"></i>{{ __('research.featured_project.result_1') }}</li>
                                        <li class="d-flex align-items-center"><i
                                                class="icon fa-classic fa-solid fa-check fa-fw"></i>{{ __('research.featured_project.result_2') }}</li>
                                        <li class="d-flex align-items-center"><i
                                                class="icon fa-classic fa-solid fa-check fa-fw"></i>{{ __('research.featured_project.result_3') }}</li>
                                        <li class="d-flex align-items-center"><i
                                                class="icon fa-classic fa-solid fa-check fa-fw"></i>{{ __('research.featured_project.result_4') }}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="project-list-item">
                            <h5 class="title"><i
                                    class="icon fa-classic fa-solid fa-circle-check fa-fw mr-15"></i>{{ __('research.featured_project.perspectives_title') }}</h5>
                            <div class="text">
                                {{ __('research.featured_project.perspectives_text') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Projet phare Section -->

    <!-- ============ CARTE INTERACTIVE DES INTERVENTIONS AU TOGO ============ -->
    <section class="section-sm bg-light py-5">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                    <i class="fa fa-solid fa-map-location-dot"></i> Couverture Nationale
                </div>
                <h2 class="h3 fw-bold text-dark mb-2">Implantation Territoriale & Sites d'Intervention</h2>
                <p class="text-muted">
                    Découvrez la répartition des projets de recherche et d'action sociale menés par le CARICS à travers les 5 régions du Togo.
                </p>
            </div>

            <x-togo-map :projects="$allProjects" />
        </div>
    </section>

    <!-- ============ EXPLORATEUR DE TOUS LES PROJETS DE RECHERCHE ============ -->
    <section class="section-sm py-5">
        <div class="container">
            <!-- En-tête & Barre de recherche -->
            <div class="row align-items-center mb-4">
                <div class="col-lg-7">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success-subtle text-success fw-semibold small mb-2">
                        <i class="fa fa-solid fa-folder-tree"></i> Répertoire Scientifique
                    </div>
                    <h2 class="h3 fw-bold text-dark mb-1">Tous nos Projets de Recherche</h2>
                    <p class="text-muted mb-0">Consultez l'ensemble des études menées par nos équipes et partenaires.</p>
                </div>
                <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                    <span class="badge bg-light text-dark border px-3 py-2 fs-6">
                        <strong class="text-primary">{{ $totalCount }}</strong> projets au total
                    </span>
                </div>
            </div>

            <!-- Filtres interactifs -->
            <div class="card p-3 p-md-4 border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #f8faff 0%, #f0f6ff 100%);">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-7">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                                <i class="fa fa-solid fa-search text-muted"></i>
                            </span>
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="search" 
                                class="form-control border-start-0 rounded-end-pill py-2 shadow-none" 
                                placeholder="Rechercher par mot-clé, thématique, bailleur, région..."
                            >
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex gap-2">
                            <select wire:model.live="selectedStatus" class="form-select rounded-pill py-2 shadow-none">
                                <option value="all">🔍 Tous les statuts</option>
                                <option value="en_cours">🟢 En cours</option>
                                <option value="termine">🔵 Achevés</option>
                                <option value="en_attente">🟡 En préparation</option>
                            </select>
                            @if ($search !== '' || $selectedStatus !== 'all')
                                <button wire:click="resetFilters" class="btn btn-outline-secondary rounded-pill px-3" title="Réinitialiser">
                                    <i class="fa fa-solid fa-rotate-left"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Onglets statut rapides -->
                <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">
                    <button 
                        type="button" 
                        wire:click="$set('selectedStatus', 'all')" 
                        class="btn btn-sm rounded-pill px-3 {{ $selectedStatus === 'all' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                    >
                        Tous les projets
                    </button>
                    <button 
                        type="button" 
                        wire:click="$set('selectedStatus', 'en_cours')" 
                        class="btn btn-sm rounded-pill px-3 {{ $selectedStatus === 'en_cours' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                    >
                        🟢 En cours
                    </button>
                    <button 
                        type="button" 
                        wire:click="$set('selectedStatus', 'termine')" 
                        class="btn btn-sm rounded-pill px-3 {{ $selectedStatus === 'termine' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                    >
                        🔵 Achevés
                    </button>
                    <button 
                        type="button" 
                        wire:click="$set('selectedStatus', 'en_attente')" 
                        class="btn btn-sm rounded-pill px-3 {{ $selectedStatus === 'en_attente' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                    >
                        🟡 En préparation
                    </button>
                </div>
            </div>

            <!-- Grille de cartes de projets -->
            <div wire:loading.flex class="justify-content-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Chargement des projets...</span>
                </div>
            </div>

            <div wire:loading.remove>
                @if ($projects->isNotEmpty())
                    <div class="row g-4">
                        @foreach ($projects as $proj)
                            @php
                                $statusBadge = match($proj->status) {
                                    'en_cours'   => ['class' => 'bg-success-subtle text-success', 'label' => 'En cours'],
                                    'termine'    => ['class' => 'bg-info-subtle text-info-emphasis', 'label' => 'Achevé'],
                                    'en_attente' => ['class' => 'bg-warning-subtle text-warning-emphasis', 'label' => 'En préparation'],
                                    default      => ['class' => 'bg-secondary-subtle text-secondary', 'label' => ucfirst($proj->status)],
                                };
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border rounded-4 shadow-sm bg-white p-4 d-flex flex-column justify-content-between transition-all hover-shadow">
                                    <div>
                                        <!-- En-tête -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="badge {{ $statusBadge['class'] }} fw-semibold px-3 py-1 rounded-pill small">
                                                {{ $statusBadge['label'] }}
                                            </span>
                                            @if ($proj->region)
                                                <span class="badge bg-light text-muted border small">
                                                    <i class="fa fa-solid fa-location-dot me-1 text-danger"></i>{{ $proj->region }}
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Titre -->
                                        <h3 class="h5 fw-bold text-dark mb-2" style="line-height: 1.4;">
                                            {{ $proj->title }}
                                        </h3>

                                        <!-- Bailleur & Date -->
                                        <div class="d-flex flex-wrap gap-2 text-muted small mb-3">
                                            @if ($proj->funder)
                                                <span><i class="fa fa-solid fa-hand-holding-dollar text-success me-1"></i>{{ $proj->funder }}</span>
                                            @endif
                                            @if ($proj->start_date)
                                                <span>• <i class="fa fa-regular fa-calendar me-1"></i>{{ $proj->start_date->format('Y') }}{{ $proj->end_date ? '–' . $proj->end_date->format('Y') : '' }}</span>
                                            @endif
                                        </div>

                                        <!-- Extrait Contexte -->
                                        @if ($proj->context)
                                            <p class="text-secondary small mb-3" style="line-height: 1.6;">
                                                {{ Str::limit(strip_tags($proj->context), 130) }}
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Pied de carte -->
                                    <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            @if ($proj->lead)
                                                <i class="fa fa-solid fa-user-tie me-1"></i> {{ $proj->lead->full_name }}
                                            @else
                                                <i class="fa fa-solid fa-users me-1"></i> Équipe CARICS
                                            @endif
                                        </small>

                                        <a href="{{ route('contact') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            Partenariat <i class="fa fa-solid fa-arrow-right ms-1 small"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 bg-white rounded-4 border p-4">
                        <div class="mb-3 text-muted" style="font-size: 3rem;">
                            <i class="fa fa-solid fa-magnifying-glass"></i>
                        </div>
                        <h4 class="h5 fw-bold text-dark mb-2">Aucun projet trouvé</h4>
                        <p class="text-muted small mb-3">Aucun projet de recherche ne correspond à ces critères.</p>
                        <button type="button" wire:click="resetFilters" class="btn btn-outline-primary rounded-pill px-4 btn-sm">
                            <i class="fa fa-solid fa-rotate-left me-1"></i> Réinitialiser les filtres
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
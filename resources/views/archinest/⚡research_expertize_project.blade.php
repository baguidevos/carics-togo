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
            'projects' => $projectsQuery->get(),
            'allProjects' => ResearchProject::published()->get(),
            'totalCount' => ResearchProject::published()->count(),
        ];
    }
};
?>

<div x-data="{ 
    selectedProject: null,
    openProjectModal(project) {
        this.selectedProject = project;
    },
    closeProjectModal() {
        this.selectedProject = null;
    }
}">
    <!-- Start main-content -->
    <x-archinest.page-title page="research" :title="__('research.title')" defaultImage="images/pub.webp" />
    <!-- end main-content -->

    <!-- ============ SECTION 1 : DOMAINES D'EXPERTISE & PRIORITÉS SCIENTIFIQUES ============ -->
    <section class="section py-5" style="background: #ffffff;">
        <div class="container">
            <!-- En-tête de section -->
            <div class="row align-items-end mb-5">
                <div class="col-lg-8">
                    <div
                        class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                        <i class="fa fa-solid fa-flask-vial"></i> {{ __('research.axes.badge') }}
                    </div>
                    <h2 class="h2 fw-bold text-dark mb-2">{{ __('research.header.title') }}</h2>
                    <p class="text-secondary lead mb-0" style="font-size: 1.08rem; line-height: 1.7;">
                        {{ __('research.header.intro') }}
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('contact') }}"
                        class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
                        <span>{{ __('navigation.actions.learn_more') }}</span>
                        <i class="fa fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <!-- Grille Bento des 6 Domaines d'Expertise -->
            <div class="row g-4 mb-5">
                <!-- Domaine 1 -->
                <div class="col-md-6 col-lg-4">
                    <div
                        class="card h-100 p-4 border rounded-4 shadow-sm hover-shadow transition-all d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary-subtle text-primary mb-3"
                                style="width: 48px; height: 48px; font-size: 1.4rem;">
                                <i class="fa fa-solid fa-microscope"></i>
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('research.domains.item_1_title') }}</h3>
                            <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                {{ __('research.domains.item_1_text') }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top text-primary small fw-semibold">
                            <i class="fa fa-solid fa-check-circle me-1"></i> {{ __('research.axes.item_1_badge') }}
                        </div>
                    </div>
                </div>

                <!-- Domaine 2 -->
                <div class="col-md-6 col-lg-4">
                    <div
                        class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success-subtle text-success mb-3"
                                style="width: 48px; height: 48px; font-size: 1.4rem;">
                                <i class="fa fa-solid fa-gears"></i>
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('research.domains.item_2_title') }}</h3>
                            <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                {{ __('research.domains.item_2_text') }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top text-success small fw-semibold">
                            <i class="fa fa-solid fa-check-circle me-1"></i> {{ __('research.axes.item_2_badge') }}
                        </div>
                    </div>
                </div>

                <!-- Domaine 3 -->
                <div class="col-md-6 col-lg-4">
                    <div
                        class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-info-subtle text-info mb-3"
                                style="width: 48px; height: 48px; font-size: 1.4rem;">
                                <i class="fa fa-solid fa-people-roof"></i>
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('research.domains.item_3_title') }}</h3>
                            <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                {{ __('research.domains.item_3_text') }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top text-info small fw-semibold">
                            <i class="fa fa-solid fa-check-circle me-1"></i> {{ __('research.axes.item_3_badge') }}
                        </div>
                    </div>
                </div>

                <!-- Domaine 4 -->
                <div class="col-md-6 col-lg-4">
                    <div
                        class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-warning-subtle text-warning-emphasis mb-3"
                                style="width: 48px; height: 48px; font-size: 1.4rem;">
                                <i class="fa fa-solid fa-landmark"></i>
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('research.domains.item_4_title') }}</h3>
                            <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                {{ __('research.domains.item_4_text') }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top text-warning-emphasis small fw-semibold">
                            <i class="fa fa-solid fa-check-circle me-1"></i> {{ __('research.axes.item_4_badge') }}
                        </div>
                    </div>
                </div>

                <!-- Domaine 5 -->
                <div class="col-md-6 col-lg-4">
                    <div
                        class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-danger-subtle text-danger mb-3"
                                style="width: 48px; height: 48px; font-size: 1.4rem;">
                                <i class="fa fa-solid fa-chart-pie"></i>
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('research.domains.item_5_title') }}</h3>
                            <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                {{ __('research.domains.item_5_text') }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top text-danger small fw-semibold">
                            <i class="fa fa-solid fa-check-circle me-1"></i> {{ __('research.axes.item_5_badge') }}
                        </div>
                    </div>
                </div>

                <!-- Domaine 6 -->
                <div class="col-md-6 col-lg-4">
                    <div
                        class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-purple-subtle text-primary mb-3"
                                style="width: 48px; height: 48px; font-size: 1.4rem; background: #ede9fe; color: #6d28d9;">
                                <i class="fa fa-solid fa-laptop-medical"></i>
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('research.domains.item_6_title') }}</h3>
                            <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                {{ __('research.domains.item_6_text') }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top text-primary small fw-semibold">
                            <i class="fa fa-solid fa-check-circle me-1"></i> {{ __('research.axes.item_6_badge') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panneau des 8 Priorités de Recherche Nationales -->
            <div class="card border-0 rounded-4 shadow-sm p-4 p-lg-5 text-white"
                style="background: linear-gradient(135deg, #1B3A6B 0%, #008A5E 100%);">
                <div class="row align-items-center g-4">
                    <div class="col-lg-4">
                        <div
                            class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success bg-opacity-0 text-white fw-semibold small mb-2">
                            <i class="fa fa-solid fa-bullseye"></i> {{ __('research.axes.orientations_badge') }}
                        </div>
                        <h3 class="h3 fw-bold text-white mb-2">{{ __('research.domains.priorities_title') }}</h3>
                        <p class="text-white-50 small mb-0">
                            {{ __('research.domains.priorities_intro') }}
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div
                                    class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                    <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                        style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">1</span>
                                    <span class="small text-white">{{ __('research.axes.priority_1') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                    <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                        style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">2</span>
                                    <span class="small text-white">{{ __('research.axes.priority_2') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                    <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                        style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">3</span>
                                    <span class="small text-white">{{ __('research.axes.priority_3') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                    <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                        style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">4</span>
                                    <span class="small text-white">{{ __('research.axes.priority_4') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                    <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                        style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">5</span>
                                    <span class="small text-white">{{ __('research.axes.priority_5') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                    <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                        style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">6</span>
                                    <span class="small text-white">{{ __('research.axes.priority_6') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                    <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                        style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">7</span>
                                    <span class="small text-white">{{ __('research.axes.priority_7') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100 d-flex align-items-start gap-2">
                                    <span class="badge bg-white text-dark rounded-circle p-2 fw-bold"
                                        style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; font-size: .75rem;">8</span>
                                    <span class="small text-white">{{ __('research.axes.priority_8') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SECTION 2 : PROJET PHARE EN VEDETTE (SHOWCASE HERO) ============ -->
    <section class="section py-5 bg-light" id="projet-phare">
        <div class="container">
            <div class="card border-0 rounded-4 shadow-sm overflow-hidden bg-white p-4 p-lg-5">
                <!-- En-tête du Projet Phare -->
                <div class="row align-items-center mb-4 pb-4 border-bottom g-3">
                    <div class="col-lg-8">
                        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                            <span class="badge bg-primary text-white fw-semibold px-3 py-1 rounded-pill">
                                <i class="fa fa-solid fa-star me-1 text-warning"></i>
                                {{ __('research.featured_project.section_title') }}
                            </span>
                            @if ($featuredProject?->status === 'en_cours')
                                <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-semibold">
                                    <i class="fa fa-solid fa-circle-dot me-1"></i>
                                    {{ __('research.featured_project.status_value') }}
                                </span>
                            @elseif ($featuredProject?->status)
                                <span class="badge bg-secondary-subtle text-secondary px-3 py-1 rounded-pill fw-semibold">
                                    {{ ucfirst(str_replace('_', ' ', $featuredProject->status)) }}
                                </span>
                            @endif
                            @if ($featuredProject?->region)
                                <span class="badge bg-light text-muted border px-3 py-1 rounded-pill small">
                                    <i class="fa fa-solid fa-location-dot text-danger me-1"></i>
                                    {{ $featuredProject->region }}
                                </span>
                            @endif
                        </div>
                        <h2 class="h3 fw-bold text-dark mb-0" style="line-height: 1.4;">
                            {{ $featuredProject?->title ?? __('research.featured_project.project_title') }}
                        </h2>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                            <i class="fa fa-solid fa-handshake me-1"></i>
                            {{ __('navigation.actions.collaborate') ?? 'Collaborer' }}
                        </a>
                    </div>
                </div>

                <!-- Métadonnées en cartes badges -->
                <div class="row g-3 mb-4">
                    <!-- Période -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="p-3 bg-light rounded-3 h-100 border">
                            <div class="text-muted small mb-1"><i
                                    class="fa fa-regular fa-calendar text-primary me-1"></i>
                                {{ __('research.featured_project.period_label') }}
                            </div>
                            <strong class="text-dark">
                                @if ($featuredProject?->start_date)
                                    {{ $featuredProject->start_date->format('Y') }} –
                                    {{ $featuredProject->end_date?->format('Y') ?? 'En cours' }}
                                @else
                                    {{ __('research.featured_project.period_value') }}
                                @endif
                            </strong>
                        </div>
                    </div>

                    <!-- Financement / Bailleur -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="p-3 bg-light rounded-3 h-100 border">
                            <div class="text-muted small mb-1"><i
                                    class="fa fa-solid fa-hand-holding-dollar text-success me-1"></i>
                                {{ __('research.featured_project.funding_label') }}
                            </div>
                            <strong
                                class="text-dark">{{ $featuredProject?->funder ?? __('research.featured_project.funding_value') }}</strong>
                        </div>
                    </div>

                    <!-- Zone d'intervention -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="p-3 bg-light rounded-3 h-100 border">
                            <div class="text-muted small mb-1"><i class="fa fa-solid fa-map-pin text-danger me-1"></i>
                                {{ __('research.featured_project.zone_label') }}
                            </div>
                            <strong class="text-dark">
                                @php
                                    $zones = $featuredProject?->intervention_zones;
                                    if (is_string($zones)) {
                                        $decodedZones = json_decode($zones, true);
                                        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedZones)) {
                                            $zones = $decodedZones;
                                        }
                                    }
                                @endphp
                                @if (!empty($zones))
                                    @if (is_array($zones))
                                        {{ implode(', ', array_map('strip_tags', array_filter($zones))) }}
                                    @else
                                        {{ strip_tags((string) $zones) }}
                                    @endif
                                @else
                                    {{ __('research.featured_project.zone_value') }}
                                @endif
                            </strong>
                        </div>
                    </div>

                    <!-- Chef de projet / Investigateur -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="p-3 bg-light rounded-3 h-100 border">
                            <div class="text-muted small mb-1"><i class="fa fa-solid fa-user-tie text-primary me-1"></i>
                                {{ __('research.featured_project.lead_investigator') }}</div>
                            <strong class="text-dark">
                                @if ($featuredProject?->lead)
                                    <a href="{{ route('team-detail', ['slug' => $featuredProject->lead->slug]) }}"
                                        class="text-decoration-none text-primary">
                                        {{ $featuredProject->lead->full_name }}
                                    </a>
                                @else
                                    {{ __('research.featured_project.scientific_team') }}
                                @endif
                            </strong>
                        </div>
                    </div>
                </div>

                <!-- Corps du Projet Phare (2 Colonnes) -->
                <div class="row g-4">
                    <!-- Colonne Gauche : Contexte & Objectifs -->
                    <div class="col-lg-6">
                        <!-- Contexte -->
                        <div class="mb-4">
                            <h3 class="h5 fw-bold text-dark mb-3">
                                <i class="fa fa-solid fa-book-open text-primary me-2"></i>
                                {{ __('research.featured_project.context_title') }}
                            </h3>
                            <div class="text-secondary" style="line-height: 1.8;">
                                {!! $featuredProject?->context ?? __('research.featured_project.context_text') !!}
                            </div>
                        </div>

                        <!-- Objectifs -->
                        <div class="mb-4">
                            <h3 class="h5 fw-bold text-dark mb-3">
                                <i class="fa fa-solid fa-bullseye text-success me-2"></i>
                                {{ __('research.featured_project.objective_title') }}
                            </h3>
                            <div class="text-secondary" style="line-height: 1.8;">
                                {!! $featuredProject?->objective ?? __('research.featured_project.objective_text') !!}
                            </div>
                        </div>
                    </div>

                    <!-- Colonne Droite : Résultats attendus & Perspectives -->
                    <div class="col-lg-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <!-- Résultats attendus -->
                            <div class="mb-4">
                                <h3 class="h5 fw-bold text-dark mb-3">
                                    <i class="fa fa-solid fa-clipboard-check text-primary me-2"></i>
                                    {{ __('research.featured_project.results_title') }}
                                </h3>
                                <div>
                                    @php
                                        $expResults = $featuredProject?->expected_results;
                                        if (is_string($expResults)) {
                                            $decodedResults = json_decode($expResults, true);
                                            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedResults)) {
                                                $expResults = $decodedResults;
                                            }
                                        }
                                    @endphp
                                    @if (!empty($expResults))
                                        @if (is_array($expResults))
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($expResults as $res)
                                                    <li class="d-flex align-items-start gap-2 mb-3">
                                                        <i class="fa fa-solid fa-circle-check text-success mt-1"></i>
                                                        <div class="small text-secondary" style="line-height: 1.6;">
                                                            {!! is_string($res) ? $res : e($res) !!}
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            @if (str_contains($expResults, '<ul') || str_contains($expResults, '<ol') || str_contains($expResults, '<li') || str_contains($expResults, '<p'))
                                                <div class="rich-text-content small text-secondary">
                                                    {!! $expResults !!}
                                                </div>
                                            @else
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-flex align-items-start gap-2 mb-2">
                                                        <i class="fa fa-solid fa-circle-check text-success mt-1"></i>
                                                        <div class="small text-secondary">{!! $expResults !!}</div>
                                                    </li>
                                                </ul>
                                            @endif
                                        @endif
                                    @else
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex align-items-start gap-2 mb-2">
                                                <i class="fa fa-solid fa-circle-check text-success mt-1"></i>
                                                <span
                                                    class="small text-secondary">{{ __('research.featured_project.result_1') }}</span>
                                            </li>
                                            <li class="d-flex align-items-start gap-2 mb-2">
                                                <i class="fa fa-solid fa-circle-check text-success mt-1"></i>
                                                <span
                                                    class="small text-secondary">{{ __('research.featured_project.result_2') }}</span>
                                            </li>
                                            <li class="d-flex align-items-start gap-2 mb-2">
                                                <i class="fa fa-solid fa-circle-check text-success mt-1"></i>
                                                <span
                                                    class="small text-secondary">{{ __('research.featured_project.result_3') }}</span>
                                            </li>
                                            <li class="d-flex align-items-start gap-2 mb-2">
                                                <i class="fa fa-solid fa-circle-check text-success mt-1"></i>
                                                <span
                                                    class="small text-secondary">{{ __('research.featured_project.result_4') }}</span>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            <!-- Perspectives -->
                            <div class="pt-3 border-top">
                                <h4 class="h6 fw-bold text-dark mb-2">
                                    <i class="fa fa-solid fa-compass text-info me-2"></i>
                                    {{ __('research.featured_project.perspectives_title') }}
                                </h4>
                                <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                    {!! __('research.featured_project.perspectives_text') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SECTION 3 : CARTE INTERACTIVE DES INTERVENTIONS AU TOGO ============ -->
    <section class="section py-5 bg-white">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <div
                    class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                    <i class="fa fa-solid fa-map-location-dot"></i> {{ __('research.map.badge') }}
                </div>
                <h2 class="h3 fw-bold text-dark mb-2">{{ __('research.map.title') }}</h2>
                <p class="text-muted">
                    {{ __('research.map.subtitle') }}
                </p>
            </div>

            <x-togo-map :projects="$allProjects" />
        </div>
    </section>

    <!-- ============ SECTION 4 : EXPLORATEUR DE TOUS LES PROJETS DE RECHERCHE ============ -->
    <section class="section py-5 bg-light" id="repertoire-projets">
        <div class="container">
            <!-- En-tête & Barre de recherche -->
            <div class="row align-items-center mb-4">
                <div class="col-lg-7">
                    <div
                        class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success-subtle text-success fw-semibold small mb-2">
                        <i class="fa fa-solid fa-folder-tree"></i> {{ __('research.directory.badge') }}
                    </div>
                    <h2 class="h3 fw-bold text-dark mb-1">{{ __('research.directory.title') }}</h2>
                    <p class="text-muted mb-0">{{ __('research.directory.subtitle') }}</p>
                </div>
                <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                    <span class="badge bg-white text-dark border px-3 py-2 fs-6 shadow-sm rounded-pill">
                        <strong class="text-primary">{{ $totalCount }}</strong> {{ __('research.directory.projects_listed') }}
                    </span>
                </div>
            </div>

            <!-- Filtres interactifs -->
            <div class="card p-3 p-md-4 border-0 shadow-sm rounded-4 mb-4"
                style="background: linear-gradient(135deg, #f8faff 0%, #f0f6ff 100%);">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-7">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 rounded-start-pill ps-3">
                                <i class="fa fa-solid fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 rounded-end-pill py-2 shadow-none"
                                placeholder="{{ __('research.directory.search_placeholder') }}">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex gap-2">
                            <select wire:model.live="selectedStatus" class="form-select rounded-pill py-2 shadow-none">
                                <option value="all">{{ __('research.directory.all_statuses') }}</option>
                                <option value="en_cours">{{ __('research.directory.status_ongoing') }}</option>
                                <option value="termine">{{ __('research.directory.status_completed') }}</option>
                                <option value="en_attente">{{ __('research.directory.status_planned') }}</option>
                            </select>
                            @if ($search !== '' || $selectedStatus !== 'all')
                                <button wire:click="resetFilters" class="btn btn-outline-secondary rounded-pill px-3"
                                    title="{{ __('research.directory.reset_filters') }}">
                                    <i class="fa fa-solid fa-rotate-left"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Onglets statut rapides -->
                <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">
                    <button type="button" wire:click="$set('selectedStatus', 'all')"
                        class="btn btn-sm rounded-pill px-3 {{ $selectedStatus === 'all' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}">
                        {{ __('research.directory.all_projects_btn') }}
                    </button>
                    <button type="button" wire:click="$set('selectedStatus', 'en_cours')"
                        class="btn btn-sm rounded-pill px-3 {{ $selectedStatus === 'en_cours' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}">
                        {{ __('research.directory.status_ongoing') }}
                    </button>
                    <button type="button" wire:click="$set('selectedStatus', 'termine')"
                        class="btn btn-sm rounded-pill px-3 {{ $selectedStatus === 'termine' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}">
                        {{ __('research.directory.status_completed') }}
                    </button>
                    <button type="button" wire:click="$set('selectedStatus', 'en_attente')"
                        class="btn btn-sm rounded-pill px-3 {{ $selectedStatus === 'en_attente' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}">
                        {{ __('research.directory.status_planned') }}
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
                                            $statusBadge = match ($proj->status) {
                                                'en_cours' => ['class' => 'bg-success-subtle text-success', 'label' => __('research.directory.status_ongoing')],
                                                'termine' => ['class' => 'bg-info-subtle text-info-emphasis', 'label' => __('research.directory.status_completed')],
                                                'en_attente' => ['class' => 'bg-warning-subtle text-warning-emphasis', 'label' => __('research.directory.status_planned')],
                                                default => ['class' => 'bg-secondary-subtle text-secondary', 'label' => ucfirst($proj->status)],
                                            };
                                        @endphp
                                        <div class="col-md-6 col-lg-6">
                                            <div
                                                class="card h-100 border rounded-4 shadow-sm bg-white p-4 d-flex flex-column justify-content-between transition-all hover-shadow">
                                                <div>
                                                    <!-- En-tête de carte -->
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span
                                                            class="badge {{ $statusBadge['class'] }} fw-semibold px-3 py-1 rounded-pill small">
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
                                                            <span><i
                                                                    class="fa fa-solid fa-hand-holding-dollar text-success me-1"></i>{{ $proj->funder }}</span>
                                                        @endif
                                                        @if ($proj->start_date)
                                                            <span>• <i
                                                                    class="fa fa-regular fa-calendar me-1"></i>{{ $proj->start_date->format('Y') }}{{ $proj->end_date ? '–' . $proj->end_date->format('Y') : '' }}</span>
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
                                                <div class="pt-3 border-top d-flex justify-content-between align-items-center gap-2">
                                                    <small class="text-muted text-truncate" style="max-width: 140px;">
                                                        @if ($proj->lead)
                                                            <i class="fa fa-solid fa-user-tie me-1"></i> {{ $proj->lead->full_name }}
                                                        @else
                                                            <i class="fa fa-solid fa-users me-1"></i> CARICS
                                                        @endif
                                                    </small>

                                                    <div class="d-flex gap-1">
                                                        <button type="button" @click="openProjectModal({{ Js::from([
                                                            'title' => $proj->title,
                                                            'status' => $proj->status,
                                                            'statusLabel' => $statusBadge['label'],
                                                            'statusClass' => $statusBadge['class'],
                                                            'region' => $proj->region,
                                                            'funder' => $proj->funder,
                                                            'period' => $proj->start_date ? $proj->start_date->format('Y') . ($proj->end_date ? ' – ' . $proj->end_date->format('Y') : ' – En cours') : null,
                                                            'lead' => $proj->lead?->full_name ?? 'Équipe CARICS',
                                                            'context' => $proj->context,
                                                            'objective' => $proj->objective,
                                                            'methodology' => $proj->methodology,
                                                            'expectedResults' => $proj->expected_results,
                                                            'zones' => is_array($proj->intervention_zones) ? implode(', ', array_map('strip_tags', $proj->intervention_zones)) : strip_tags((string) $proj->intervention_zones),
                                                        ]) }})" class="btn btn-sm btn-light border rounded-pill px-3">
                                                            <i class="fa fa-solid fa-circle-info me-1"></i> {{ __('research.directory.view_project_details') }}
                                                        </button>

                                                        <a href="{{ route('contact') }}"
                                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                            {{ __('navigation.footer.partnerships') }} <i class="fa fa-solid fa-arrow-right ms-1 small"></i>
                                                        </a>
                                                    </div>
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
                        <h4 class="h5 fw-bold text-dark mb-2">{{ __('research.directory.no_project_found') }}</h4>
                        <p class="text-muted small mb-3">{{ __('research.directory.no_project_found_desc') }}</p>
                        <button type="button" wire:click="resetFilters"
                            class="btn btn-outline-primary rounded-pill px-4 btn-sm">
                            <i class="fa fa-solid fa-rotate-left me-1"></i> {{ __('research.directory.reset_filters') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ============ MODAL ALPINE.JS : DÉTAILS COMPLETS DU PROJET ============ -->
    <div x-show="selectedProject !== null" x-cloak x-transition @click.self="selectedProject = null"
        @keydown.escape.window="selectedProject = null"
        class="position-fixed top-0 start-0 w-100 h-100 align-items-center justify-content-center p-3"
        :class="{ 'd-flex': selectedProject !== null }"
        style="background: rgba(15, 23, 42, 0.7); z-index: 99999; backdrop-filter: blur(5px);">
        <div @click.stop class="card border-0 rounded-4 shadow-lg w-100 overflow-hidden "
            style="max-width: 800px; max-height: 90vh;">
            <!-- En-tête Modal -->
            <div class="p-4 border-bottom d-flex justify-content-between align-items-start bg-light">
                <div class="pe-3">
                    <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                        <span class="badge" :class="selectedProject?.statusClass"
                            x-text="selectedProject?.statusLabel"></span>
                        <template x-if="selectedProject?.region">
                            <span class="badge text-muted border">
                                <i class="fa fa-solid fa-location-dot text-danger me-1"></i>
                                <span x-text="selectedProject?.region"></span>
                            </span>
                        </template>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-0" x-text="selectedProject?.title"></h3>
                </div>
                <button type="button" @click="selectedProject = null"
                    class="btn btn-sm btn-light rounded-circle p-2 shadow-none" style="width: 36px; height: 36px;"
                    title="{{ __('research.modal.close') }}">
                    <i class="fa fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Corps Modal (Déroulant) -->
            <div class="p-4 overflow-auto" style="max-height: calc(90vh - 140px);">
                <!-- Métadonnées rapides -->
                <div class="row g-2 mb-4">
                    <template x-if="selectedProject?.funder">
                        <div class="col-sm-6">
                            <div class="p-2 bg-light rounded-3 border small">
                                <span class="text-muted">{{ __('home.featured_project.funding_label') }}</span>
                                <strong class="text-dark ms-1" x-text="selectedProject?.funder"></strong>
                            </div>
                        </div>
                    </template>
                    <template x-if="selectedProject?.period">
                        <div class="col-sm-6">
                            <div class="p-2 bg-light rounded-3 border small">
                                <span class="text-muted">{{ __('home.featured_project.period_label') }} :</span>
                                <strong class="text-dark ms-1" x-text="selectedProject?.period"></strong>
                            </div>
                        </div>
                    </template>
                    <template x-if="selectedProject?.lead">
                        <div class="col-sm-6">
                            <div class="p-2 bg-light rounded-3 border small">
                                <span class="text-muted">{{ __('research.featured_project.lead_investigator') }} :</span>
                                <strong class="text-dark ms-1" x-text="selectedProject?.lead"></strong>
                            </div>
                        </div>
                    </template>
                    <template x-if="selectedProject?.zones">
                        <div class="col-sm-6">
                            <div class="p-2 bg-light rounded-3 border small">
                                <span class="text-muted">{{ __('home.featured_project.zone_label') }} :</span>
                                <strong class="text-dark ms-1" x-text="selectedProject?.zones"></strong>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Contexte -->
                <template x-if="selectedProject?.context">
                    <div class="mb-4">
                        <h4 class="h6 fw-bold text-dark mb-2">
                            <i class="fa fa-solid fa-book-open text-primary me-2"></i> {{ __('research.modal.context') }}
                        </h4>
                        <div class="text-secondary small" style="line-height: 1.7;" x-html="selectedProject?.context">
                        </div>
                    </div>
                </template>

                <!-- Objectifs -->
                <template x-if="selectedProject?.objective">
                    <div class="mb-4">
                        <h4 class="h6 fw-bold text-dark mb-2">
                            <i class="fa fa-solid fa-bullseye text-success me-2"></i> {{ __('research.modal.objectives') }}
                        </h4>
                        <div class="text-secondary small" style="line-height: 1.7;" x-html="selectedProject?.objective">
                        </div>
                    </div>
                </template>

                <!-- Méthodologie -->
                <template x-if="selectedProject?.methodology">
                    <div class="mb-4">
                        <h4 class="h6 fw-bold text-dark mb-2">
                            <i class="fa fa-solid fa-microscope text-info me-2"></i> Méthodologie
                        </h4>
                        <div class="text-secondary small" style="line-height: 1.7;"
                            x-html="selectedProject?.methodology"></div>
                    </div>
                </template>
            </div>

            <!-- Pied de Modal -->
            <div class="p-3 border-top d-flex justify-content-between align-items-center bg-light">
                <button type="button" @click="selectedProject = null"
                    class="btn btn-sm btn-outline-secondary rounded-pill px-4">
                    {{ __('research.modal.close') }}
                </button>
                <a href="{{ route('contact') }}" class="btn btn-sm btn-primary rounded-pill px-4 fw-semibold">
                    {{ __('navigation.actions.propose_collaboration') }} <i class="fa fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
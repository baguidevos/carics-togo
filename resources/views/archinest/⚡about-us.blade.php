<?php

use App\Models\TeamMember;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    public function with(): array
    {
        return [
            'members' => TeamMember::published()->ordered()->take(4)->get(),
        ];
    }
};
?>

<div>
    <!-- Start main-content / Hero Banner -->
    <section class="page-title" style="background-image: url({{ asset('images/banner.jpg') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">{{ __('about.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">{{ __('navigation.menu.home') }}</a></li>
                    <li>{{ __('about.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->

    <!-- ============ SECTION 1 : QUI SOMMES-NOUS ? ============ -->
    <section class="section py-5" style="background: #ffffff;">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                        <i class="fa fa-solid fa-building-columns"></i> {{ __('about.who_we_are.badge') }}
                    </div>
                    <h2 class="h2 fw-bold text-dark mb-2">{{ __('about.who_we_are.title') }}</h2>
                    <p class="text-secondary lead mb-0" style="font-size: 1.1rem; line-height: 1.7;">
                        {{ __('about.who_we_are.intro') }}
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
                        <span>{{ __('navigation.actions.contact_us') }}</span>
                        <i class="fa fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <!-- Grille Bento Identité & Vision -->
            <div class="row g-4 mb-5">
                <!-- Bloc Historique & Ancrage -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary-subtle text-primary mb-3" style="width: 48px; height: 48px; font-size: 1.3rem;">
                                <i class="fa fa-solid fa-landmark"></i>
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.who_we_are.history_title') }}</h3>
                            <p class="text-secondary small mb-0" style="line-height: 1.7;">
                                {{ __('about.who_we_are.history_text') }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top text-primary small fw-semibold">
                            <i class="fa fa-solid fa-location-dot me-1 text-danger"></i> {{ __('about.who_we_are.history_badge') }}
                        </div>
                    </div>
                </div>

                <!-- Bloc Statut Juridique & Gouvernance -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success-subtle text-success mb-3" style="width: 48px; height: 48px; font-size: 1.3rem;">
                                <i class="fa fa-solid fa-scale-balanced"></i>
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.who_we_are.status_title') }}</h3>
                            <p class="text-secondary small mb-0" style="line-height: 1.7;">
                                {{ __('about.who_we_are.status_text') }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top text-success small fw-semibold">
                            <i class="fa fa-solid fa-shield-check me-1"></i> {{ __('about.who_we_are.status_badge') }}
                        </div>
                    </div>
                </div>

                <!-- Bloc Ambition & Rayonnement Régional -->
                <div class="col-lg-4 col-md-12">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm text-white hover-shadow transition-all d-flex flex-column justify-content-between" style="background: linear-gradient(135deg, #1B3A6B 0%, #008A5E 100%);">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success bg-opacity-10 text-white mb-3" style="width: 48px; height: 48px; font-size: 1.3rem;">
                                <i class="fa fa-solid fa-earth-africa"></i>
                            </div>
                            <h3 class="h5 fw-bold text-white mb-2">{{ __('about.who_we_are.ambitions_title') }}</h3>
                            <p class="text-white-50 small mb-0" style="line-height: 1.7;">
                                {{ __('about.who_we_are.ambitions_text') }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top border-white border-opacity-10 text-white small fw-semibold">
                            <i class="fa fa-solid fa-arrows-to-dot me-1 text-warning"></i> {{ __('about.who_we_are.ambitions_badge') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SECTION 2 : NOTRE APPROCHE (3 PILIERS D'ACTION) ============ -->
    <section class="section py-5 bg-light" id="notre-approche">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                    <i class="fa fa-solid fa-cubes-stacked"></i> {{ __('about.approach.badge') }}
                </div>
                <h2 class="h3 fw-bold text-dark mb-2">{{ __('about.approach.title') }}</h2>
                <p class="text-muted">
                    {{ __('about.approach.subtitle') }}
                </p>
            </div>

            <!-- Les 3 Piliers -->
            <div class="row g-4">
                <!-- Pilier 1 : Recherche -->
                <div class="col-lg-4">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between position-relative overflow-hidden">
                        <div class="position-absolute top-0 end-0 p-3 opacity-10 text-primary fw-bold" style="font-size: 4rem; line-height: 1; font-family: monospace; user-select: none;">
                            01
                        </div>
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white mb-3" style="width: 44px; height: 44px; font-weight: bold;">
                                01
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.approach.pillar_1_title') }}</h3>
                            <p class="text-secondary small mb-4" style="line-height: 1.6;">
                                {{ __('about.approach.pillar_1_text') }}
                            </p>
                        </div>
                        <div class="p-3 rounded-3 bg-primary-subtle border border-primary-subtle">
                            <div class="text-primary fw-semibold small mb-1">
                                <i class="fa fa-solid fa-bullseye me-1"></i> {{ __('about.approach.pillar_1_expected') }}
                            </div>
                            <div class="text-dark small fw-medium">
                                {{ __('about.approach.pillar_1_result') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pilier 2 : Innovation -->
                <div class="col-lg-4">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between position-relative overflow-hidden">
                        <div class="position-absolute top-0 end-0 p-3 opacity-10 text-success fw-bold" style="font-size: 4rem; line-height: 1; font-family: monospace; user-select: none;">
                            02
                        </div>
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success text-white mb-3" style="width: 44px; height: 44px; font-weight: bold;">
                                02
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.approach.pillar_2_title') }}</h3>
                            <p class="text-secondary small mb-4" style="line-height: 1.6;">
                                {{ __('about.approach.pillar_2_text') }}
                            </p>
                        </div>
                        <div class="p-3 rounded-3 bg-success-subtle border border-success-subtle">
                            <div class="text-success fw-semibold small mb-1">
                                <i class="fa fa-solid fa-lightbulb me-1"></i> {{ __('about.approach.pillar_2_expected') }}
                            </div>
                            <div class="text-dark small fw-medium">
                                {{ __('about.approach.pillar_2_result') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pilier 3 : Action -->
                <div class="col-lg-4">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all d-flex flex-column justify-content-between position-relative overflow-hidden">
                        <div class="position-absolute top-0 end-0 p-3 opacity-10 text-info fw-bold" style="font-size: 4rem; line-height: 1; font-family: monospace; user-select: none;">
                            03
                        </div>
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info text-white mb-3" style="width: 44px; height: 44px; font-weight: bold;">
                                03
                            </div>
                            <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.approach.pillar_3_title') }}</h3>
                            <p class="text-secondary small mb-4" style="line-height: 1.6;">
                                {{ __('about.approach.pillar_3_text') }}
                            </p>
                        </div>
                        <div class="p-3 rounded-3 bg-info-subtle border border-info-subtle">
                            <div class="text-info-emphasis fw-semibold small mb-1">
                                <i class="fa fa-solid fa-hand-holding-heart me-1"></i> {{ __('about.approach.pillar_3_expected') }}
                            </div>
                            <div class="text-dark small fw-medium">
                                {{ __('about.approach.pillar_3_result') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SECTION 3 : NOS VALEURS FONDAMENTALES ============ -->
    <section class="section py-5 bg-white" id="nos-valeurs">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success-subtle text-success fw-semibold small mb-2">
                    <i class="fa fa-solid fa-heart-pulse"></i> {{ __('about.values.badge') }}
                </div>
                <h2 class="h3 fw-bold text-dark mb-2">{{ __('about.values.title') }}</h2>
                <p class="text-muted">
                    {{ __('about.values.intro') }}
                </p>
            </div>

            <!-- Grille 3x2 des 6 Valeurs -->
            <div class="row g-4">
                <!-- Valeur 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3" style="width: 44px; background: #ede9fe; color: #6d28d9; height: 44px; font-size: 1.2rem;">
                            <i class="fa fa-solid fa-microscope"></i>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.values.val_1_title') }}</h3>
                        <p class="text-secondary small mb-0" style="line-height: 1.6;">
                            {{ __('about.values.val_1_text') }}
                        </p>
                    </div>
                </div>

                <!-- Valeur 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success-subtle text-success mb-3" style="width: 44px; height: 44px; font-size: 1.2rem;">
                            <i class="fa fa-solid fa-shield"></i>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.values.val_2_title') }}</h3>
                        <p class="text-secondary small mb-0" style="line-height: 1.6;">
                            {{ __('about.values.val_2_text') }}
                        </p>
                    </div>
                </div>

                <!-- Valeur 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-warning-subtle text-warning-emphasis mb-3" style="width: 44px; height: 44px; font-size: 1.2rem;">
                            <i class="fa fa-solid fa-wand-magic-sparkles"></i>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.values.val_3_title') }}</h3>
                        <p class="text-secondary small mb-0" style="line-height: 1.6;">
                            {{ __('about.values.val_3_text') }}
                        </p>
                    </div>
                </div>

                <!-- Valeur 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-info-subtle text-info mb-3" style="width: 44px; height: 44px; font-size: 1.2rem;">
                            <i class="fa fa-solid fa-handshake"></i>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.values.val_4_title') }}</h3>
                        <p class="text-secondary small mb-0" style="line-height: 1.6;">
                            {{ __('about.values.val_4_text') }}
                        </p>
                    </div>
                </div>

                <!-- Valeur 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-danger-subtle text-danger mb-3" style="width: 44px; height: 44px; font-size: 1.2rem;">
                            <i class="fa fa-solid fa-eye"></i>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.values.val_5_title') }}</h3>
                        <p class="text-secondary small mb-0" style="line-height: 1.6;">
                            {{ __('about.values.val_5_text') }}
                        </p>
                    </div>
                </div>

                <!-- Valeur 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white hover-shadow transition-all">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3" style="width: 44px; height: 44px; font-size: 1.2rem; background: #ede9fe; color: #6d28d9;">
                            <i class="fa fa-solid fa-users"></i>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">{{ __('about.values.val_6_title') }}</h3>
                        <p class="text-secondary small mb-0" style="line-height: 1.6;">
                            {{ __('about.values.val_6_text') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SECTION 4 : CARICS EN BREF & REPERES CLES ============ -->
    <section class="section py-5 bg-light" id="carics-en-bref">
        <div class="container">
            <div class="card border-0 rounded-4 shadow-sm p-4 p-lg-5 text-white" style="background: linear-gradient(135deg, #1B3A6B 0%, #008A5E 100%);">
                <div class="row align-items-center g-4 mb-4">
                    <div class="col-lg-6">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success bg-opacity-20 text-white fw-semibold small mb-2">
                            <i class="fa fa-solid fa-chart-line"></i> {{ __('about.in_brief.badge') }}
                        </div>
                        <h3 class="h2 fw-bold text-white mb-2">{{ __('about.in_brief.title') }}</h3>
                        <p class="text-white-50 mb-0">
                            {{ __('about.in_brief.subtitle') }}
                        </p>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <a href="{{ route('recherche-expertize-projet') }}" class="btn btn-light rounded-pill px-4 py-2 fw-semibold text-primary">
                            {{ __('about.in_brief.consult_projects') }} <i class="fa fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="row g-3">
                    <!-- Item 1 : Création -->
                    <div class="col-md-4 col-sm-6">
                        <div class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100" style="background-color: #1b3a6b36;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fa fa-solid fa-calendar-check text-warning"></i>
                                <strong class="text-white small">{{ __('about.in_brief.item_1_title') }}</strong>
                            </div>
                            <p class="small text-white-50 mb-0">{{ __('about.in_brief.item_1_text') }}</p>
                        </div>
                    </div>

                    <!-- Item 2 : Statut -->
                    <div class="col-md-4 col-sm-6">
                        <div class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100" style="background-color: #1b3a6b36;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fa fa-solid fa-scale-balanced text-warning"></i>
                                <strong class="text-white small">{{ __('about.in_brief.item_2_title') }}</strong>
                            </div>
                            <p class="small text-white-50 mb-0">{{ __('about.in_brief.item_2_text') }}</p>
                        </div>
                    </div>

                    <!-- Item 3 : Fondateurs -->
                    <div class="col-md-4 col-sm-6">
                        <div class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100" style="background-color: #1b3a6b36;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fa fa-solid fa-users text-warning"></i>
                                <strong class="text-white small">{{ __('about.in_brief.item_3_title') }}</strong>
                            </div>
                            <p class="small text-white-50 mb-0">{{ __('about.in_brief.item_3_text') }}</p>
                        </div>
                    </div>

                    <!-- Item 4 : Projets -->
                    <div class="col-md-6 col-sm-6">
                        <div class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100" style="background-color: #1b3a6b36;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fa fa-solid fa-flask-vial text-warning"></i>
                                <strong class="text-white small">{{ __('about.in_brief.item_4_title') }}</strong>
                            </div>
                            <p class="small text-white-50 mb-0">{{ __('about.in_brief.item_4_text') }}</p>
                        </div>
                    </div>

                    <!-- Item 5 : Ambition -->
                    <div class="col-md-6 col-sm-12">
                        <div class="p-3 rounded-3 bg-opacity-10 border border-white border-opacity-10 h-100" style="background-color: #1b3a6b36;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fa fa-solid fa-earth-africa text-warning"></i>
                                <strong class="text-white small">{{ __('about.in_brief.item_5_title') }}</strong>
                            </div>
                            <p class="small text-white-50 mb-0">{{ __('about.in_brief.item_5_text') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SECTION 5 : GOUVERNANCE & LEADERSHIP ============ -->
    @if ($members->isNotEmpty())
        <section class="section py-5 bg-white" id="gouvernance">
            <div class="container">
                <div class="row align-items-end mb-4">
                    <div class="col-lg-8">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                            <i class="fa fa-solid fa-users-gear"></i> {{ __('about.governance.badge') }}
                        </div>
                        <h2 class="h3 fw-bold text-dark mb-2">{!! __('about.governance.title') !!}</h2>
                        <p class="text-muted mb-0">
                            {{ __('about.governance.description') }}
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                        <a href="{{ route('equipe') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
                            <span>{{ __('home.leadership.discover_team') }}</span>
                            <i class="fa fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach ($members as $member)
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 border rounded-4 shadow-sm bg-white p-3 d-flex flex-column justify-content-between hover-shadow transition-all text-center">
                                <div>
                                    <div class="mb-3 position-relative mx-auto" style="width: 110px; height: 110px;">
                                        @if ($member->avatar_url)
                                            <img src="{{ $member->avatar_url }}" alt="{{ $member->full_name }}" class="rounded-circle w-100 h-100 object-fit-cover shadow-sm border">
                                        @else
                                            <div class="rounded-circle w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold fs-3 shadow-sm" style="background: {{ $member->avatar_color ?? '#1B3A6B' }};">
                                                {{ substr($member->full_name, 0, 2) }}
                                            </div>
                                        @endif
                                    </div>
                                    <h4 class="h6 fw-bold text-dark mb-1">
                                        <a href="{{ route('team-detail', ['slug' => $member->slug]) }}" class="text-decoration-none text-dark">
                                            {{ $member->full_name }}
                                        </a>
                                    </h4>
                                    <div class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 small mb-2">
                                        {{ $member->role_title }}
                                    </div>
                                    @if ($member->bio_short)
                                        <p class="text-secondary small mb-3" style="line-height: 1.5;">
                                            {{ Str::limit($member->bio_short, 90) }}
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

    <!-- ============ SECTION 6 : COLLABORATIONS & RESEAUX PARTENAIRES ============ -->
    <section class="section py-5 bg-light" id="partenariats">
        <div class="container">
            <div class="card border-0 rounded-4 shadow-sm p-4 p-lg-5 bg-white text-center">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success-subtle text-success fw-semibold small mb-3 mx-auto">
                    <i class="fa fa-solid fa-handshake"></i> {{ __('about.collaboration.badge') }}
                </div>
                <h2 class="h3 fw-bold text-dark mb-3">{{ __('about.collaboration.title') }}</h2>
                <div class="max-w-700 mx-auto text-secondary mb-4" style="line-height: 1.8;">
                    <p class="mb-3">{{ __('about.collaboration.paragraph_1') }}</p>
                    <p class="mb-0">{{ __('about.collaboration.paragraph_2') }}</p>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('recherche-expertize-projet') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
                        <i class="fa fa-solid fa-microscope me-2"></i> {{ __('navigation.actions.discover_works') }}
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
                        <i class="fa fa-solid fa-handshake me-2"></i> {{ __('navigation.actions.become_partner') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
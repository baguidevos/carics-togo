<?php

use App\Models\ResearchProject;
use App\Models\TeamMember;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    public string $slug;
    public TeamMember $member;
    public $otherMembers;
    public ?ResearchProject $relatedProject = null;

    public function mount(string $slug)
    {
        $this->slug = $slug;
        $this->member = TeamMember::published()->where('slug', $slug)->firstOrFail();
        $this->otherMembers = TeamMember::published()->where('slug', '!=', $slug)->ordered()->take(3)->get();

        if ($this->member->related_project_slug) {
            $this->relatedProject = ResearchProject::where('slug', $this->member->related_project_slug)->first();
        }
    }
};
?>

<div>
    <!-- ============ EN-TÊTE PROFIL ============ -->
    <header class="hero-sm py-5" style="background: linear-gradient(135deg, #1B3A6B 0%, #008A5E 100%); color: #fff;">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-auto">
                    @if ($member->avatar_url)
                        <img src="{{ str_starts_with($member->avatar_url, 'http') ? $member->avatar_url : asset($member->avatar_url) }}" 
                             alt="{{ $member->full_name }}" 
                             class="rounded-circle border border-3 border-white shadow-lg object-fit-cover" 
                             style="width: 110px; height: 110px; object-fit: cover;">
                    @elseif (!empty($member->photo))
                        <img src="{{ asset('images/equipes/' . $member->photo) }}" 
                             alt="{{ $member->full_name }}" 
                             class="rounded-circle border border-3 border-white shadow-lg object-fit-cover" 
                             style="width: 110px; height: 110px; object-fit: cover;">
                    @else
                        <div class="rounded-circle border border-3 border-white shadow-lg d-flex align-items-center justify-content-center bg-white text-primary fs-2 fw-bold" 
                             style="width: 110px; height: 110px;">
                            {{ $member->initials }}
                        </div>
                    @endif
                </div>
                <div class="col">
                    <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                        @if ($member->is_founder)
                            <span class="badge bg-white text-primary rounded-pill px-3 py-1 fw-semibold small">
                                <i class="fa fa-solid fa-certificate text-warning me-1"></i> Membre Fondateur
                            </span>
                        @endif
                        <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 small">
                            {{ ucfirst(str_replace('_', ' ', $member->role_category ?? 'Membre')) }}
                        </span>
                    </div>
                    <h1 class="font-display text-white mb-1" style="font-size: clamp(1.7rem, 3.2vw, 2.6rem);">
                        {{ $member->full_name }}
                    </h1>
                    <p class="lead text-white-50 mb-0">
                        {{ $member->role_title }} &mdash; CARICS-Togo
                    </p>
                    @if (!empty($member->current_position))
                        <div class="text-white-50 small mt-1">
                            <i class="fa fa-solid fa-briefcase me-1"></i> {{ $member->current_position }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-auto ms-lg-auto">
                    <!-- Liens réseaux scientifiques -->
                    <div class="d-flex gap-2">
                        @if ($member->orcid_url)
                            <a href="{{ $member->orcid_url }}" target="_blank" rel="noopener noreferrer" 
                               class="btn btn-sm btn-light rounded-circle p-2 shadow-sm" title="Profil ORCID (Identifiant chercheur)">
                                <i class="fa-brands fa-orcid text-success fs-5"></i>
                            </a>
                        @endif
                        @if ($member->google_scholar_url)
                            <a href="{{ $member->google_scholar_url }}" target="_blank" rel="noopener noreferrer" 
                               class="btn btn-sm btn-light rounded-circle p-2 shadow-sm" title="Profil Google Scholar (Citations & Publications)">
                                <i class="fa-solid fa-graduation-cap text-primary fs-5"></i>
                            </a>
                        @endif
                        @if ($member->linkedin_url)
                            <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer" 
                               class="btn btn-sm btn-light rounded-circle p-2 shadow-sm" title="Profil LinkedIn">
                                <i class="fa-brands fa-linkedin-in text-primary fs-5"></i>
                            </a>
                        @endif
                        @if ($member->email)
                            <a href="mailto:{{ $member->email }}" 
                               class="btn btn-sm btn-light rounded-circle p-2 shadow-sm" title="Envoyer un email">
                                <i class="fa-solid fa-envelope text-secondary fs-5"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ============ CORPS DU PROFIL ============ -->
    <section class="section py-5">
        <div class="container">
            <div class="row g-4 g-lg-5">

                <!-- CONTENU PRINCIPAL (2/3) -->
                <div class="col-lg-8">

                    <!-- BIOGRAPHIE -->
                    <div class="mb-5 p-4 p-md-5 rounded-4 bg-white border shadow-sm">
                        <div class="eyebrow text-primary mb-2">{{ __('team.detail.bio_eyebrow') }}</div>
                        <h2 class="h4 fw-bold text-dark mb-4">{{ __('team.detail.bio_title') }}</h2>
                        
                        <div class="article-prose text-secondary" style="font-size: 1.05rem; line-height: 1.8;">
                            @if (!empty($member->bio_paragraphs))
                                @foreach ($member->bio_paragraphs as $paragraph)
                                    <p>{!! $paragraph !!}</p>
                                @endforeach
                            @elseif (!empty($member->bio_full))
                                {!! $member->bio_full !!}
                            @else
                                <p>{{ $member->bio_short }}</p>
                            @endif

                            @if ($member->bio_quote)
                                <blockquote class="p-3 my-4 rounded-3 border-start border-4 border-primary bg-light fst-italic text-dark">
                                    <i class="fa fa-quote-left text-primary opacity-50 me-2"></i>
                                    {{ $member->bio_quote }}
                                </blockquote>
                            @endif
                        </div>
                    </div>

                    <!-- MISSION & RÔLE DANS CARICS -->
                    @if ($member->mission_text)
                        <div class="mb-5 p-4 p-md-5 rounded-4 bg-white border shadow-sm">
                            <div class="eyebrow text-primary mb-2">{{ __('team.detail.role_eyebrow') }}</div>
                            <h2 class="h4 fw-bold text-dark mb-3">{{ __('team.detail.role_title', ['role' => $member->role_title]) }}</h2>
                            <p class="text-secondary mb-0" style="line-height: 1.7; font-size: 1.02rem;">
                                {{ $member->mission_text }}
                            </p>
                        </div>
                    @endif

                    <!-- PROJET ASSOCIÉ -->
                    @if ($relatedProject || $member->related_project_slug)
                        <div class="mb-5 p-4 p-md-5 rounded-4 bg-white border shadow-sm">
                            <div class="eyebrow text-primary mb-2">{{ __('team.detail.project_eyebrow') }}</div>
                            <h2 class="h4 fw-bold text-dark mb-3">{{ __('team.detail.project_title') }}</h2>
                            <a href="{{ route('recherche-expertize-projet') }}" class="text-decoration-none text-reset d-block">
                                <div class="p-4 rounded-4 border bg-light hover-shadow transition-all">
                                    <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                                        <span class="badge bg-success rounded-pill px-3 py-1 small">Projet Phare</span>
                                        @if ($relatedProject?->funding_source)
                                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1 small">{{ $relatedProject->funding_source }}</span>
                                        @endif
                                    </div>
                                    <h3 class="h5 fw-bold text-dark mb-2">
                                        {{ $relatedProject?->title ?? __('research.featured_project.project_title') }}
                                    </h3>
                                    @if ($relatedProject?->summary)
                                        <p class="text-secondary small mb-3">
                                            {{ Str::limit($relatedProject->summary, 160) }}
                                        </p>
                                    @endif
                                    <div class="text-primary fw-semibold small">
                                        Découvrir le projet et ses interventions <i class="fa fa-solid fa-arrow-right ms-1"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif

                </div>

                <!-- SIDEBAR (1/3) -->
                <div class="col-lg-4">
                    <div class="sticky-lg-top" style="top: 5.5rem;">

                        <!-- EXPERTISES CLÉS (JSON) -->
                        @if (!empty($member->expertises) && is_array($member->expertises))
                            <div class="p-4 rounded-4 bg-white border shadow-sm mb-4">
                                <div class="eyebrow text-primary mb-3">
                                    <i class="fa fa-solid fa-tags me-1"></i> {{ __('team.detail.expertises_eyebrow') }}
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($member->expertises as $expertise)
                                        <span class="badge bg-light text-primary border px-3 py-2 rounded-pill fw-medium" style="font-size: .84rem;">
                                            {{ $expertise }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- FORMATION / CURSUS ACADÉMIQUE (JSON) -->
                        @if (!empty($member->education) && is_array($member->education))
                            <div class="p-4 rounded-4 bg-white border shadow-sm mb-4">
                                <div class="eyebrow text-primary mb-3">
                                    <i class="fa fa-solid fa-graduation-cap me-1"></i> {{ __('team.detail.education_eyebrow') }}
                                </div>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($member->education as $edu)
                                        <li class="d-flex gap-3 {{ !$loop->last ? 'mb-3 pb-3 border-bottom' : '' }}">
                                            <div class="mt-1">
                                                <i class="fa fa-solid fa-certificate text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark" style="font-size: .95rem;">
                                                    {{ is_array($edu) ? ($edu['degree'] ?? '') : (string) $edu }}
                                                    @if (is_array($edu) && !empty($edu['field']))
                                                        <span class="text-secondary fw-normal"> &mdash; {{ $edu['field'] }}</span>
                                                    @endif
                                                </div>
                                                @if (is_array($edu) && !empty($edu['institution']))
                                                    <div class="text-muted small">
                                                        {{ $edu['institution'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- DISTINCTIONS & BOURSES (JSON) -->
                        @if (!empty($member->distinctions) && is_array($member->distinctions))
                            <div class="p-4 rounded-4 bg-white border shadow-sm mb-4" style="background: #fffcf5;">
                                <div class="eyebrow text-warning mb-3">
                                    <i class="fa fa-solid fa-trophy me-1"></i> Prix & Distinctions
                                </div>
                                @foreach ($member->distinctions as $dist)
                                    <div class="p-3 rounded-3 bg-white border mb-2 shadow-2xs">
                                        <div class="fw-bold text-dark" style="font-size: .92rem;">
                                            {{ is_array($dist) ? ($dist['title'] ?? '') : (string) $dist }}
                                        </div>
                                        <div class="text-muted small mt-1">
                                            @if (is_array($dist) && !empty($dist['organisation']))
                                                <span>{{ $dist['organisation'] }}</span>
                                            @endif
                                            @if (is_array($dist) && !empty($dist['year']))
                                                <span class="badge bg-warning-subtle text-warning border px-2 py-0 ms-1">{{ $dist['year'] }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- AFFILIATIONS INSTITUTIONNELLES (JSON) -->
                        @if (!empty($member->affiliations) && is_array($member->affiliations))
                            <div class="p-4 rounded-4 bg-white border shadow-sm mb-4">
                                <div class="eyebrow text-primary mb-3">
                                    <i class="fa fa-solid fa-building-columns me-1"></i> {{ __('team.detail.affiliations_eyebrow') }}
                                </div>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($member->affiliations as $aff)
                                        <li class="d-flex align-items-center gap-2 {{ !$loop->last ? 'mb-2 pb-2 border-bottom' : '' }}" style="font-size: .9rem;">
                                            <i class="fa fa-solid fa-building text-primary small"></i>
                                            <span class="text-secondary">{{ is_array($aff) ? json_encode($aff) : $aff }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- CONTACT & IDENTIFIANTS SCIENTIFIQUES -->
                        <div class="p-4 rounded-4 bg-white border shadow-sm">
                            <div class="eyebrow text-primary mb-3">
                                <i class="fa fa-solid fa-paper-plane me-1"></i> {{ __('team.detail.links_eyebrow') }}
                            </div>
                            <div class="d-flex flex-column gap-2">
                                @if ($member->orcid_url)
                                    <a href="{{ $member->orcid_url }}" target="_blank" rel="noopener noreferrer" 
                                       class="btn btn-sm btn-outline-success d-flex align-items-center justify-content-between rounded-pill px-3 py-2">
                                        <span><i class="fa-brands fa-orcid me-2"></i> ORCID ID</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square small"></i>
                                    </a>
                                @endif
                                @if ($member->google_scholar_url)
                                    <a href="{{ $member->google_scholar_url }}" target="_blank" rel="noopener noreferrer" 
                                       class="btn btn-sm btn-outline-primary d-flex align-items-center justify-content-between rounded-pill px-3 py-2">
                                        <span><i class="fa-solid fa-graduation-cap me-2"></i> Google Scholar</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square small"></i>
                                    </a>
                                @endif
                                @if ($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer" 
                                       class="btn btn-sm btn-outline-dark d-flex align-items-center justify-content-between rounded-pill px-3 py-2">
                                        <span><i class="fa-brands fa-linkedin-in me-2"></i> LinkedIn</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square small"></i>
                                    </a>
                                @endif
                                @if ($member->email)
                                    <a href="mailto:{{ $member->email }}" 
                                       class="btn btn-sm btn-primary d-flex align-items-center justify-content-between rounded-pill px-3 py-2">
                                        <span><i class="fa-solid fa-envelope me-2"></i> Contacter par email</span>
                                        <i class="fa-solid fa-paper-plane small"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============ AUTRES MEMBRES ============ -->
    @if ($otherMembers->isNotEmpty())
        <section class="section bg-light border-top py-5">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
                    <div>
                        <div class="eyebrow text-primary">{{ __('team.board_eyebrow') }}</div>
                        <h2 class="h3 fw-bold text-dark mb-0">{{ __('team.detail.other_members_title') }}</h2>
                    </div>
                    <a href="{{ route('equipe') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 mt-3 mt-md-0">
                        {{ __('team.detail.view_all_team') }} <i class="fa fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="row g-4">
                    @foreach ($otherMembers as $other)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('team-detail', ['slug' => $other->slug]) }}" class="text-decoration-none text-reset d-block h-100">
                                <div class="card h-100 p-3 border rounded-4 bg-white shadow-sm hover-shadow transition-all d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="mb-3 rounded-3 overflow-hidden" style="height: 180px; background: #f1f5f9;">
                                            @if ($other->avatar_url)
                                                <img src="{{ str_starts_with($other->avatar_url, 'http') ? $other->avatar_url : asset($other->avatar_url) }}" 
                                                     alt="{{ $other->full_name }}" 
                                                     loading="lazy" 
                                                     decoding="async" 
                                                     class="w-100 h-100 object-fit-cover" 
                                                     style="object-fit: cover;">
                                            @elseif (!empty($other->photo))
                                                <img src="{{ asset('images/equipes/' . $other->photo) }}" 
                                                     alt="{{ $other->full_name }}" 
                                                     loading="lazy" 
                                                     decoding="async" 
                                                     class="w-100 h-100 object-fit-cover" 
                                                     style="object-fit: cover;">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-primary text-white fs-2 fw-bold">
                                                    {{ $other->initials }}
                                                </div>
                                            @endif
                                        </div>
                                        <h3 class="h6 fw-bold text-dark mb-1">{{ $other->full_name }}</h3>
                                        <div class="text-primary small fw-semibold mb-2">{{ $other->role_title }}</div>
                                        <p class="text-secondary small mb-3">
                                            {{ Str::limit($other->bio_short, 95) }}
                                        </p>
                                    </div>
                                    <div class="pt-2 border-top d-flex justify-content-between align-items-center">
                                        <span class="text-primary fw-medium small">{{ __('team.view_profile') }}</span>
                                        <i class="fa-solid fa-arrow-right text-primary small"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Data\TeamData;

new #[Layout('layouts::archinest')] class extends Component {
    public string $slug;
    public array $member;
    public array $otherMembers;

    public function mount(string $slug)
    {
        $member = TeamData::find($slug);

        if (!$member) {
            abort(404);
        }

        $this->slug = $slug;
        $this->member = $member;

        // Load other members for recommendation
        $all = TeamData::all();
        unset($all[$slug]);
        $this->otherMembers = array_values($all);
    }
};
?>

<div>
    {{-- <section class="page-title" style="background-image: url({{ asset('images/banner.jpg') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">{{ $member['fullName'] }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('equipe') }}">Notre équipe</a></li>
                    <li>{{ $member['fullName'] }}</li>
                </ul>
            </div>
        </div>
    </section> --}}

    <section>
        <!-- ============ EN-TÊTE PROFIL ============ -->
        <header class="hero-sm">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-auto">
                        <div class="profile-avatar-xl">{{ $member['initials'] }}</div>
                    </div>
                    <div class="col">
                        @if ($member['isFounder'])
                        <span class="badge-status light mb-2 d-inline-block">Membre fondateur</span>
                        @endif
                        <h1 class="font-display mb-1" style="font-size:clamp(1.7rem,3.2vw,2.6rem);">{{ $member['fullName'] }}</h1>
                        <p class="lead mb-0">{{ $member['roleTitle'] }} &mdash; CARICS-Togo</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- ============ CORPS DU PROFIL ============ -->
        <section class="section">
            <div class="container">
                <div class="row g-4 g-lg-5">

                    <!-- CONTENU PRINCIPAL -->
                    <div class="col-lg-8">

                        <div class="mb-5">
                            <div class="eyebrow">Biographie</div>
                            <h2 class="h4 mb-3">Parcours &amp; expertise</h2>
                            <div class="article-prose" style="font-size:1rem;">
                                @foreach ($member['bioFull'] as $paragraph)
                                <p>{!! $paragraph !!}</p>
                                @endforeach

                                @if ($member['bioQuote'])
                                <blockquote>
                                    {{ $member['bioQuote'] }}
                                </blockquote>
                                @endif
                            </div>
                        </div>

                        <div class="mb-5">
                            <div class="eyebrow">Rôle au sein de CARICS-Togo</div>
                            <h2 class="h4 mb-3">Mission en tant que {{ $member['roleTitle'] }}</h2>
                            <p>
                                {{ $member['missionText'] }}
                            </p>
                        </div>

                        <!-- PROJET ASSOCIÉ -->
                        @if ($member['relatedProjectSlug'])
                        <div class="mb-5">
                            <div class="eyebrow">Projet en cours</div>
                            <h2 class="h4 mb-3">Investigateur principal</h2>
                            <a href="#" class="text-decoration-none text-reset">
                                <div class="project-highlight shadow-soft">
                                    <div class="ph-head" style="padding:1.4rem 1.6rem;">
                                        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                                            <span class="badge-status ongoing">Projet en cours</span>
                                            <span class="badge-status light">RSTMH &middot; 2026&ndash;2027</span>
                                        </div>
                                        <h3 class="h6 mb-0">
                                            @if ($member['slug'] === 'gountante-kombate')
                                            Renforcement de la mise en œuvre de la ChimioPrévention Saisonnière du Paludisme dans un contexte transfrontalier confronté à l&rsquo;insécurité au Nord du Togo
                                            @else
                                            Projet de recherche associé
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="ph-body" style="padding:1.2rem 1.6rem;">
                                        <span class="text-accent fw-semibold" style="font-size:.88rem;">Voir la fiche projet complète <i class="bi bi-arrow-right ms-1"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif

                    </div>

                    <!-- SIDEBAR -->
                    <div class="col-lg-4">
                        <div class="sticky-lg-top" style="top:5.5rem;">

                            <!-- PHOTO DU MEMBRE -->
                            <div class="card-soft mb-4 p-0 overflow-hidden">
                                <div class="team-photo">
                                    <img src="{{ asset('images/equipes/' . $member['imageName']) }}" alt="{{ $member['fullName'] }}">
                                </div>
                            </div>

                            <!-- EXPERTISES CLÉS -->
                            <div class="card-soft mb-4" style="background:var(--bg-alt);">
                                <div class="eyebrow mb-3">Expertises clés</div>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($member['expertises'] as $expertise)
                                    <span class="tag-ghost">{{ $expertise }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- FORMATION -->
                            @if (!empty($member['education']))
                            <div class="card-soft mb-4">
                                <div class="eyebrow mb-3">Formation</div>
                                <ul class="list-unstyled mb-0" style="font-size:.88rem;">
                                    @foreach ($member['education'] as $edu)
                                    <li class="d-flex gap-2 @if (!$loop->last) mb-3 pb-3 border-bottom @endif" @if (!$loop->last) style="border-color:var(--line) !important;" @endif>
                                        <i class="fa fa-mortar-board text-accent mt-1 flex-shrink-0"></i>
                                        <span><strong>{{ $edu['degree'] }}</strong>@if($edu['field']), {{ $edu['field'] }}@endif<br><span class="text-muted-2">{{ $edu['institution'] }}</span></span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- DISTINCTIONS -->
                            @if (!empty($member['distinctions']))
                                @foreach ($member['distinctions'] as $dist)
                                <div class="card-soft mb-4" style="background:var(--ochre-soft); border-color:transparent;">
                                    <div class="d-flex gap-2 align-items-start">
                                        <i class="fa fa-trophy text-ochre" style="font-size:1.3rem;"></i>
                                        <div>
                                            <div class="fw-semibold mb-1" style="font-size:.92rem; color:var(--ink);">{{ $dist['title'] }}</div>
                                            <div class="text-muted-2" style="font-size:.85rem;">{{ $dist['organisation'] }} &middot; {{ $dist['year'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif

                            <!-- COLLABORATIONS -->
                            @if (!empty($member['affiliations']))
                            <div class="card-soft mb-4" style="background:var(--bg-alt);">
                                <div class="eyebrow mb-3">Collaborations institutionnelles</div>
                                <ul class="list-unstyled mb-0" style="font-size:.88rem;">
                                    @foreach ($member['affiliations'] as $aff)
                                    <li class="@if (!$loop->last) mb-2 @endif"><i class="fa fa-building text-accent me-2"></i>{{ $aff }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- CONTACT / LIENS -->
                            <div class="card-soft">
                                <div class="eyebrow mb-3">Liens</div>
                                <div class="d-flex gap-2">
                                    @if (!empty($member['links']['orcid']))
                                    <a href="{{ $member['links']['orcid'] }}" class="share-btn" title="ORCID"><i class="fa fa-person-burst"></i></a>
                                    @endif
                                    @if (!empty($member['links']['linkedin']))
                                    <a href="{{ $member['links']['linkedin'] }}" class="share-btn" title="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                                    @endif
                                    @if (!empty($member['links']['googleScholar']))
                                    <a href="{{ $member['links']['googleScholar'] }}" class="share-btn" title="Google Scholar"><i class="fa fa-graduation-cap"></i></a>
                                    @endif
                                    @if (!empty($member['links']['email']))
                                    <a href="mailto:{{ $member['links']['email'] }}" class="share-btn" title="Email"><i class="fa fa-envelope"></i></a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ============ AUTRES MEMBRES ============ -->
        <section class="section bg-bg-alt">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
                    <div>
                        <div class="eyebrow">Bureau Exécutif</div>
                        <h2 class="section-title mb-0">Autres membres de l&rsquo;équipe</h2>
                    </div>
                    <a href="{{ route('equipe') }}" class="btn-cta-outline mt-3 mt-md-0">Voir toute l&rsquo;équipe <i class="fa fa-arrow-right ms-1"></i></a>
                </div>
                <div class="row g-4">

                    @foreach ($otherMembers as $other)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('team-detail', ['slug' => $other['slug']]) }}" class="text-decoration-none text-reset d-block h-100">
                            <div class="team-card h-100">
                                <div class="team-photo">
                                    <img src="{{ asset('images/equipes/' . $other['imageName']) }}" alt="{{ $other['fullName'] }}">
                                </div>
                                <div class="team-body">
                                    <h3 class="h6 mb-1">{{ $other['fullName'] }}</h3>
                                    <div class="team-role">{{ $other['roleTitle'] }}</div>
                                    <p class="team-excerpt">{{ $other['bioShort'] }}</p>
                                    <div class="team-link">Voir le profil <i class="fa fa-arrow-right ms-1"></i></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>

    </section>
</div>
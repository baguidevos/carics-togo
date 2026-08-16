<?php

use App\Models\Publication;
use App\Models\Resource;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    public function with(): array
    {
        return [
            'articles'     => Publication::where('type', 'article_scientifique')->published()->orderBy('published_date', 'desc')->get(),
            'reports'      => Publication::where('type', 'rapport_technique')->published()->orderBy('published_date', 'desc')->get(),
            'policyBriefs' => Publication::where('type', 'note_politique')->published()->orderBy('published_date', 'desc')->get(),
            'tools'        => Resource::available()->ordered()->with('category')->get(),
        ];
    }
};
?>

<div>
    <!-- Start main-content -->
    <section class="page-title" style="background-image: url({{ asset('images/banner.jpg') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">{{ __('resources.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">{{ __('navigation.menu.home') }}</a></li>
                    <li>{{ __('resources.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- ============ INTRO ============ -->
    <section class="section-sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <p class="section-lead mb-0">
                        {{ __('resources.intro') }}
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ============ PUBLICATIONS SCIENTIFIQUES ============ -->
    <section class="section-sm">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-4">
                    <div class="icon-tile"><i class="fa fa-solid fa-journal-whills"></i></div>
                    <div class="eyebrow"></div>
                    <h2 class="section-title mb-2" style="font-size:1.4rem;">{{ __('resources.scientific_publications.title') }}</h2>
                    <p class="text-muted-2" style="font-size:.92rem;">
                        {{ __('resources.scientific_publications.description') }}
                    </p>
                </div>
                <div class="col-lg-8">
                    @if ($articles->isNotEmpty())
                        <div class="d-flex flex-column gap-3">
                            @foreach ($articles as $article)
                                <div class="card p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-primary-subtle text-primary fw-medium px-2 py-1" style="font-size:.8rem;">
                                            {{ $article->journal_or_publisher ?? 'Article Scientifique' }}
                                        </span>
                                        @if ($article->published_date)
                                            <span class="text-muted small">
                                                <i class="bi bi-calendar3 me-1"></i>{{ $article->published_date->format('M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="h6 mb-2 fw-bold text-dark">{{ $article->title }}</h3>
                                    @if ($article->abstract)
                                        <p class="text-muted mb-2 small" style="line-height:1.5;">{{ Str::limit($article->abstract, 180) }}</p>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                                        <small class="text-muted">
                                            @if (!empty($article->authors()))
                                                <strong>{{ implode(', ', array_map(fn($a) => $a['fullName'] ?? $a['name'] ?? '', $article->authors()->toArray())) }}</strong>
                                            @endif
                                            @if ($article->external_co_authors)
                                                , {{ $article->external_co_authors }}
                                            @endif
                                        </small>
                                        @if ($article->external_url)
                                            <a href="{{ $article->external_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary">
                                                {{ __('navigation.actions.read_article') ?? 'Consulter' }} <i class="bi bi-box-arrow-up-right ms-1"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <span class="badge-status upcoming">{{ __('resources.badge_upcoming') }}</span>
                            <p class="mb-2" style="font-size:.95rem;">{{ __('resources.scientific_publications.empty_text') }}</p>
                            <ul class="mb-0" style="font-size:.92rem; color:var(--muted);">
                                <li>{{ __('resources.scientific_publications.item_1') }}</li>
                                <li>{{ __('resources.scientific_publications.item_2') }}</li>
                                <li>{{ __('resources.scientific_publications.item_3') }}</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ============ RAPPORTS TECHNIQUES ============ -->
    <section class="section-sm bg-bg-alt">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-4">
                    <div class="icon-tile"><i class="fa fa-solid fa-bar-chart"></i></div>
                    <div class="eyebrow"></div>
                    <h2 class="section-title mb-2" style="font-size:1.4rem;">{{ __('resources.technical_reports.title') }}</h2>
                    <p class="text-muted-2" style="font-size:.92rem;">
                        {{ __('resources.technical_reports.description') }}
                    </p>
                </div>
                <div class="col-lg-8">
                    @if ($reports->isNotEmpty())
                        <div class="d-flex flex-column gap-3">
                            @foreach ($reports as $report)
                                <div class="card p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-info-subtle text-info-emphasis fw-medium px-2 py-1" style="font-size:.8rem;">
                                            {{ $report->journal_or_publisher ?? 'Rapport Technique' }}
                                        </span>
                                        @if ($report->published_date)
                                            <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ $report->published_date->format('M Y') }}</span>
                                        @endif
                                    </div>
                                    <h3 class="h6 mb-2 fw-bold text-dark">{{ $report->title }}</h3>
                                    @if ($report->abstract)
                                        <p class="text-muted mb-2 small" style="line-height:1.5;">{{ Str::limit($report->abstract, 160) }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state" style="background:var(--white);">
                            <span class="badge-status upcoming">{{ __('resources.badge_upcoming') }}</span>
                            <p class="mb-2" style="font-size:.95rem;">{{ __('resources.technical_reports.empty_text') }}</p>
                            <ul class="mb-0" style="font-size:.92rem; color:var(--muted);">
                                <li>{{ __('resources.technical_reports.item_1') }}</li>
                                <li>{{ __('resources.technical_reports.item_2') }}</li>
                                <li>{{ __('resources.technical_reports.item_3') }}</li>
                                <li>{{ __('resources.technical_reports.item_4') }}</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ============ NOTES DE POLITIQUE SANITAIRE ============ -->
    <section class="section-sm">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-4">
                    <div class="icon-tile ochre"><i class="fa fa-solid fa-megaphone"></i></div>
                    <div class="eyebrow"></div>
                    <h2 class="section-title mb-2" style="font-size:1.4rem;">{{ __('resources.policy_briefs.title') }}</h2>
                    <p class="text-muted-2" style="font-size:.92rem;">
                        {{ __('resources.policy_briefs.description') }}
                    </p>
                </div>
                <div class="col-lg-8">
                    @if ($policyBriefs->isNotEmpty())
                        <div class="d-flex flex-column gap-3">
                            @foreach ($policyBriefs as $brief)
                                <div class="card p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-warning-subtle text-warning-emphasis fw-medium px-2 py-1" style="font-size:.8rem;">
                                            {{ $brief->journal_or_publisher ?? 'Note de Politique' }}
                                        </span>
                                        @if ($brief->published_date)
                                            <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ $brief->published_date->format('M Y') }}</span>
                                        @endif
                                    </div>
                                    <h3 class="h6 mb-2 fw-bold text-dark">{{ $brief->title }}</h3>
                                    @if ($brief->abstract)
                                        <p class="text-muted mb-2 small" style="line-height:1.5;">{{ Str::limit($brief->abstract, 160) }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <span class="badge-status upcoming">{{ __('resources.badge_upcoming') }}</span>
                            <p class="mb-2" style="font-size:.95rem;">{{ __('resources.policy_briefs.empty_text') }}</p>
                            <ul class="mb-0" style="font-size:.92rem; color:var(--muted);">
                                <li>{{ __('resources.policy_briefs.item_1') }}</li>
                                <li>{{ __('resources.policy_briefs.item_2') }}</li>
                                <li>{{ __('resources.policy_briefs.item_3') }}</li>
                                <li>{{ __('resources.policy_briefs.item_4') }}</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ============ OUTILS ET RESSOURCES PRATIQUES ============ -->
    <section class="section-sm bg-bg-alt">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-4">
                    <div class="icon-tile"><i class="fa fa-solid fa-file-medical"></i></div>
                    <div class="eyebrow"></div>
                    <h2 class="section-title mb-2" style="font-size:1.4rem;">{{ __('resources.practical_tools.title') }}</h2>
                    <p class="text-muted-2" style="font-size:.92rem;">
                        {{ __('resources.practical_tools.description') }}
                    </p>
                </div>
                <div class="col-lg-8">
                    @if ($tools->isNotEmpty())
                        <div class="d-flex flex-column gap-3">
                            @foreach ($tools as $tool)
                                <div class="card p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-success-subtle text-success fw-medium px-2 py-1" style="font-size:.8rem;">
                                            {{ $tool->category?->name ?? 'Outil pratique' }}
                                        </span>
                                    </div>
                                    <h3 class="h6 mb-2 fw-bold text-dark">{{ $tool->title }}</h3>
                                    @if ($tool->description)
                                        <p class="text-muted mb-2 small" style="line-height:1.5;">{{ $tool->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state" style="background:var(--white);">
                            <span class="badge-status upcoming">{{ __('resources.badge_upcoming') }}</span>
                            <p class="mb-2" style="font-size:.95rem;">{{ __('resources.practical_tools.empty_text') }}</p>
                            <ul class="mb-0" style="font-size:.92rem; color:var(--muted);">
                                <li>{{ __('resources.practical_tools.item_1') }}</li>
                                <li>{{ __('resources.practical_tools.item_2') }}</li>
                                <li>{{ __('resources.practical_tools.item_3') }}</li>
                                <li>{{ __('resources.practical_tools.item_4') }}</li>
                                <li>{{ __('resources.practical_tools.item_5') }}</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
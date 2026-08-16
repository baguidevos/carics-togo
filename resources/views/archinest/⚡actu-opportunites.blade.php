<?php

use App\Models\News;
use App\Models\Opportunity;
use App\Models\Partner;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    public function with(): array
    {
        $featuredNews = News::published()->featured()->with('category')->first() ?? News::published()->recent()->with('category')->first();
        $otherNews = News::published()->recent()
            ->when($featuredNews, fn($q) => $q->where('id', '!=', $featuredNews->id))
            ->take(4)
            ->get();

        return [
            'featuredNews' => $featuredNews,
            'otherNews'    => $otherNews,
            'jobs'         => Opportunity::open()->whereIn('contract_type', ['cdd', 'cdi', 'consultance'])->with('category')->get(),
            'internships'  => Opportunity::open()->where('contract_type', 'stage')->with('category')->get(),
            'scholarships' => Opportunity::open()->where('contract_type', 'benevolat')->with('category')->get(),
            'partners'     => Partner::active()->ordered()->get(),
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

    <!-- ============ TABS ============ -->
    <section class="section-sm pb-0" style="background:var(--white); border-bottom:1px solid var(--line);">
        <div class="container">
            <ul class="nav nav-carics" id="actuTabs" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-actu"
                        role="tab">{{ __('news_opp.tabs.news') }}</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-emploi"
                        role="tab">{{ __('news_opp.tabs.jobs') }}</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-stage"
                        role="tab">{{ __('news_opp.tabs.internships') }}</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-bourses"
                        role="tab">{{ __('news_opp.tabs.scholarships') }}</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-partenariat"
                        role="tab">{{ __('news_opp.tabs.partnerships') }}</button></li>
            </ul>
        </div>
    </section>

    <!-- ============ CONTENU DES TABS ============ -->
    <section class="section">
        <div class="container">
            <div class="tab-content">

                <!-- TAB 1 : ACTUALITÉS -->
                <div class="tab-pane fade show active" id="tab-actu" role="tabpanel">
                    <div class="row g-4">

                        <!-- Actualité à la une -->
                        @if ($featuredNews)
                            <div class="col-12">
                                <div class="project-highlight shadow-soft">
                                    <div class="ph-head">
                                        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                                            <span class="badge-status light">{{ $featuredNews->category?->name ?? __('news_opp.news.featured_badge') }}</span>
                                            @if ($featuredNews->published_date)
                                                <span style="color:rgba(255,255,255,.65); font-size:.85rem;"><i
                                                        class="bi bi-calendar3 me-1"></i>{{ $featuredNews->published_date->format('d/m/Y') }}</span>
                                            @endif
                                        </div>
                                        <h2 class="h4 mb-1">{{ $featuredNews->title }}</h2>
                                        <p
                                            style="color:rgba(255,255,255,.82); font-size:.95rem; max-width:42rem; margin-bottom:0;">
                                            {{ $featuredNews->excerpt }}
                                        </p>
                                    </div>
                                    <div class="ph-body">
                                        <div class="mb-3 text-muted" style="line-height: 1.6;">
                                            {!! Str::limit(strip_tags($featuredNews->content), 300) !!}
                                        </div>
                                        <a href="{{ route('recherche-expertize-projet') }}" class="btn-cta-outline">{{ __('news_opp.news.featured_btn') }} <i
                                                class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Autres Actualités -->
                        @if ($otherNews->isNotEmpty())
                            @foreach ($otherNews as $item)
                                <div class="col-md-6">
                                    <div class="card-soft h-100 p-4 border rounded-3 bg-white shadow-sm">
                                        <div class="d-flex gap-2 mb-2 align-items-center">
                                            <span class="badge-status ongoing">{{ $item->category?->name ?? 'Actualité' }}</span>
                                            @if ($item->published_date)
                                                <span class="text-muted-2" style="font-size:.82rem;"><i
                                                        class="bi bi-calendar3 me-1"></i>{{ $item->published_date->format('d/m/Y') }}</span>
                                            @endif
                                        </div>
                                        <h3 class="h5 mb-2">{{ $item->title }}</h3>
                                        <p class="text-muted-2 mb-3" style="font-size:.92rem;">
                                            {{ $item->excerpt }}
                                        </p>
                                        <a href="{{ route('about') }}" class="btn-cta-sm btn-cta-outline"
                                            style="display:inline-block;">{{ __('news_opp.news.news2_btn') }} <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Actualité 2 (Fallback) -->
                            <div class="col-md-6">
                                <div class="card-soft h-100">
                                    <div class="d-flex gap-2 mb-2">
                                        <span class="badge-status ongoing">{{ __('news_opp.news.news2_badge') }}</span>
                                        <span class="text-muted-2" style="font-size:.82rem;"><i
                                                class="bi bi-calendar3 me-1"></i>{{ __('news_opp.news.news2_date') }}</span>
                                    </div>
                                    <h3 class="h5 mb-2">{{ __('news_opp.news.news2_title') }}</h3>
                                    <p class="text-muted-2 mb-3" style="font-size:.92rem;">
                                        {{ __('news_opp.news.news2_desc') }}
                                    </p>
                                    <a href="{{ route('about') }}" class="btn-cta-sm btn-cta-outline"
                                        style="display:inline-block;">{{ __('news_opp.news.news2_btn') }} <i class="bi bi-arrow-right ms-1"></i></a>
                                </div>
                            </div>

                            <!-- Actualité 3 (Fallback) -->
                            <div class="col-md-6">
                                <div class="card-soft h-100">
                                    <div class="d-flex gap-2 mb-2">
                                        <span class="badge-status upcoming">{{ __('news_opp.news.news3_badge') }}</span>
                                        <span class="text-muted-2" style="font-size:.82rem;"><i
                                                class="bi bi-calendar3 me-1"></i>{{ __('news_opp.news.news3_date') }}</span>
                                    </div>
                                    <h3 class="h5 mb-2">{{ __('news_opp.news.news3_title') }}</h3>
                                    <p class="text-muted-2 mb-3" style="font-size:.92rem;">
                                        {{ __('news_opp.news.news3_desc') }}
                                    </p>
                                    <span class="text-muted-2" style="font-size:.85rem;"><i
                                            class="bi bi-clock me-1"></i>{{ __('news_opp.news.news3_upcoming') }}</span>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <!-- TAB 2 : EMPLOIS -->
                <div class="tab-pane fade" id="tab-emploi" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="eyebrow mb-2">{{ __('news_opp.jobs.eyebrow') }}</div>
                            <h2 class="section-title mb-3">{{ __('news_opp.jobs.title') }}</h2>

                            @if ($jobs->isNotEmpty())
                                <div class="d-flex flex-column gap-3">
                                    @foreach ($jobs as $job)
                                        <div class="card p-4 border rounded-3 shadow-sm bg-white">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <span class="badge bg-primary-subtle text-primary px-2 py-1">{{ strtoupper($job->contract_type ?? 'Emploi') }}</span>
                                                @if ($job->deadline)
                                                    <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i>Date limite : {{ $job->deadline->format('d/m/Y') }}</span>
                                                @endif
                                            </div>
                                            <h3 class="h5 mb-2 fw-bold text-dark">{{ $job->title }}</h3>
                                            <p class="text-muted mb-3 small">{{ $job->description }}</p>
                                            @if (!empty($job->requirements))
                                                <ul class="small text-muted mb-3">
                                                    @foreach ($job->requirements as $req)
                                                        <li>{{ $req }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @if ($job->application_email)
                                                <a href="mailto:{{ $job->application_email }}?subject=Candidature : {{ rawurlencode($job->title) }}" class="btn btn-sm btn-primary align-self-start">
                                                    Postuler par email <i class="bi bi-envelope ms-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <span class="badge-status upcoming">{{ __('news_opp.jobs.empty_badge') }}</span>
                                    <p class="mb-3" style="font-size:.95rem;">
                                        {{ __('news_opp.jobs.empty_text1') }}
                                    </p>
                                    <p class="text-muted-2 mb-4" style="font-size:.9rem;">
                                        {{ __('news_opp.jobs.empty_text2') }}
                                    </p>
                                    <a href="{{ route('contact') }}" class="btn-cta-outline">{{ __('news_opp.jobs.newsletter_btn') }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- TAB 3 : STAGES -->
                <div class="tab-pane fade" id="tab-stage" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="eyebrow mb-2">{{ __('news_opp.internships.eyebrow') }}</div>
                            <h2 class="section-title mb-3">{{ __('news_opp.internships.title') }}</h2>

                            @if ($internships->isNotEmpty())
                                <div class="d-flex flex-column gap-3">
                                    @foreach ($internships as $stage)
                                        <div class="card p-4 border rounded-3 shadow-sm bg-white">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <span class="badge bg-info-subtle text-info-emphasis px-2 py-1">STAGE / MENTORAT</span>
                                                @if ($stage->deadline)
                                                    <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i>Date limite : {{ $stage->deadline->format('d/m/Y') }}</span>
                                                @endif
                                            </div>
                                            <h3 class="h5 mb-2 fw-bold text-dark">{{ $stage->title }}</h3>
                                            <p class="text-muted mb-3 small">{{ $stage->description }}</p>
                                            @if (!empty($stage->requirements))
                                                <ul class="small text-muted mb-3">
                                                    @foreach ($stage->requirements as $req)
                                                        <li>{{ $req }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <a href="{{ route('contact') }}#stage" class="btn btn-sm btn-outline-primary align-self-start">
                                                {{ __('news_opp.internships.apply_btn') }} <i class="bi bi-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <span class="badge-status upcoming">{{ __('news_opp.internships.empty_badge') }}</span>
                                    <p class="mb-3" style="font-size:.95rem;">
                                        {{ __('news_opp.internships.empty_text1') }}
                                    </p>
                                    <p class="text-muted-2 mb-4" style="font-size:.9rem;">
                                        {{ __('news_opp.internships.empty_text2') }}
                                    </p>
                                    <a href="{{ route('contact') }}#stage" class="btn-cta-outline">{{ __('news_opp.internships.apply_btn') }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- TAB 4 : BOURSES -->
                <div class="tab-pane fade" id="tab-bourses" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="eyebrow mb-2">{{ __('news_opp.scholarships.eyebrow') }}</div>
                            <h2 class="section-title mb-3">{{ __('news_opp.scholarships.title') }}</h2>

                            @if ($scholarships->isNotEmpty())
                                <div class="d-flex flex-column gap-3">
                                    @foreach ($scholarships as $bourse)
                                        <div class="card p-4 border rounded-3 shadow-sm bg-white">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <span class="badge bg-warning-subtle text-warning-emphasis px-2 py-1">BOURSE & FORMATION</span>
                                                @if ($bourse->deadline)
                                                    <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i>Date limite : {{ $bourse->deadline->format('d/m/Y') }}</span>
                                                @endif
                                            </div>
                                            <h3 class="h5 mb-2 fw-bold text-dark">{{ $bourse->title }}</h3>
                                            <p class="text-muted mb-3 small">{{ $bourse->description }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <span class="badge-status upcoming">{{ __('news_opp.scholarships.empty_badge') }}</span>
                                    <p class="mb-3" style="font-size:.95rem;">
                                        {{ __('news_opp.scholarships.empty_text') }}
                                    </p>
                                    <a href="{{ route('contact') }}" class="btn-cta-outline">{{ __('news_opp.scholarships.newsletter_btn') }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- TAB 5 : PARTENARIATS -->
                <div class="tab-pane fade" id="tab-partenariat" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-7">
                            <div class="eyebrow mb-2">{{ __('news_opp.partnerships.eyebrow') }}</div>
                            <h2 class="section-title mb-3">{{ __('news_opp.partnerships.title') }}</h2>
                            <p>
                                {{ __('news_opp.partnerships.intro') }}
                            </p>
                            <ul class="mb-4">
                                <li>{{ __('news_opp.partnerships.target_1') }}</li>
                                <li>{{ __('news_opp.partnerships.target_2') }}</li>
                                <li>{{ __('news_opp.partnerships.target_3') }}</li>
                                <li>{{ __('news_opp.partnerships.target_4') }}</li>
                                <li>{{ __('news_opp.partnerships.target_5') }}</li>
                                <li>{{ __('news_opp.partnerships.target_6') }}</li>
                                <li>{{ __('news_opp.partnerships.target_7') }}</li>
                            </ul>
                            <div class="eyebrow mb-3">{{ __('news_opp.partnerships.areas_eyebrow') }}</div>
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <span class="tag-ghost">{{ __('news_opp.partnerships.area_1') }}</span>
                                <span class="tag-ghost">{{ __('news_opp.partnerships.area_2') }}</span>
                                <span class="tag-ghost">{{ __('news_opp.partnerships.area_3') }}</span>
                                <span class="tag-ghost">{{ __('news_opp.partnerships.area_4') }}</span>
                                <span class="tag-ghost">{{ __('news_opp.partnerships.area_5') }}</span>
                                <span class="tag-ghost">{{ __('news_opp.partnerships.area_6') }}</span>
                                <span class="tag-ghost">{{ __('news_opp.partnerships.area_7') }}</span>
                                <span class="tag-ghost">{{ __('news_opp.partnerships.area_8') }}</span>
                                <span class="tag-ghost">{{ __('news_opp.partnerships.area_9') }}</span>
                            </div>
                            <a href="{{ route('contact') }}#collaboration" class="btn-cta">{{ __('news_opp.partnerships.submit_btn') }} <i
                                    class="bi bi-arrow-right ms-1"></i></a>
                        </div>

                        <div class="col-lg-5">
                            <div class="card-soft" style="background:var(--bg-alt);">
                                <div class="eyebrow mb-3">{{ __('news_opp.partnerships.current_partners_eyebrow') }}</div>
                                @if ($partners->isNotEmpty())
                                    <div class="d-flex flex-column gap-2 mb-3">
                                        @foreach ($partners as $partner)
                                            <div class="border rounded-3 py-3 px-3 text-center fw-bold bg-white shadow-sm"
                                                style="border-color:var(--line); color:var(--primary);">
                                                <div style="font-size:1.05rem;">{{ $partner->name }}</div>
                                                @if ($partner->full_name)
                                                    <div class="text-muted mt-1 small" style="font-weight: normal;">{{ $partner->full_name }}</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="border rounded-3 py-4 text-center fw-bold mb-3"
                                        style="border-color:var(--line); color:var(--primary); background:var(--white);">
                                        <div style="font-size:1.1rem;">RSTMH</div>
                                        <div class="text-muted-2 mt-1" style="font-size:.82rem;">Royal Society of Tropical Medicine and Hygiene</div>
                                    </div>
                                @endif
                                <p class="text-muted-2 mb-0" style="font-size:.88rem;">
                                    {{ __('news_opp.partnerships.more_partners') }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
<?php

use App\Models\Publication;
use App\Models\Resource;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'type')]
    public string $selectedType = 'all';

    #[Url(as: 'year')]
    public string $selectedYear = 'all';

    public function resetFilters(): void
    {
        $this->search = '';
        $this->selectedType = 'all';
        $this->selectedYear = 'all';
    }

    public function with(): array
    {
        $publicationsQuery = Publication::published()
            ->with(['researchProject'])
            ->when($this->search !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', "%{$this->search}%")
                        ->orWhere('abstract', 'like', "%{$this->search}%")
                        ->orWhere('journal_or_publisher', 'like', "%{$this->search}%")
                        ->orWhere('external_co_authors', 'like', "%{$this->search}%");
                });
            })
            ->when($this->selectedType !== 'all', function ($query) {
                $query->where('type', $this->selectedType);
            })
            ->when($this->selectedYear !== 'all', function ($query) {
                $query->whereYear('published_date', $this->selectedYear);
            })
            ->orderBy('published_date', 'desc');

        $availableYears = Publication::published()
            ->whereNotNull('published_date')
            ->selectRaw('strftime("%Y", published_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->filter()
            ->values();

        $toolsQuery = Resource::available()->ordered()->with('category');
        if ($this->search !== '') {
            $toolsQuery->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        return [
            'publications'   => $publicationsQuery->get(),
            'totalCount'     => Publication::published()->count(),
            'tools'          => $toolsQuery->get(),
            'availableYears' => $availableYears,
        ];
    }
};
?>

<div>
    <!-- Start main-content -->
    <x-archinest.page-title page="resources_publications" :title="__('resources.title')" defaultImage="images/pub.webp" />

    <!-- ============ INTRO & BARRE DE RECHERCHE DYNAMIQUE ============ -->
    <section class="section-sm pb-0">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                        <i class="fa fa-solid fa-flask"></i> {{ __('resources.badge_center') }}
                    </div>
                    <h2 class="h3 fw-bold text-dark mb-2">{{ __('resources.section_title') }}</h2>
                    <p class="text-muted mb-0">
                        {{ __('resources.intro') }}
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <span class="badge bg-light text-dark border px-3 py-2 fs-6">
                        <strong class="text-primary">{{ $totalCount }}</strong> {{ __('resources.publications_listed') }}
                    </span>
                </div>
            </div>

            <!-- Barre de filtres & recherche -->
            <div class="card p-3 p-md-4 border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #f8faff 0%, #f0f6ff 100%);">
                <div class="row g-3 align-items-center">
                    <!-- Champ recherche -->
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                                <i class="fa fa-solid fa-search text-muted"></i>
                            </span>
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="search" 
                                class="form-control border-start-0 rounded-end-pill py-2 shadow-none" 
                                placeholder="{{ __('resources.search_placeholder') }}"
                            >
                        </div>
                    </div>

                    <!-- Filtre Type -->
                    <div class="col-sm-6 col-lg-3">
                        <select wire:model.live="selectedType" class="form-select rounded-pill py-2 shadow-none">
                            <option value="all">📚 {{ __('resources.all_types') }}</option>
                            <option value="article_scientifique">📄 {{ __('resources.articles_scientific') }}</option>
                            <option value="rapport_technique">📊 {{ __('resources.reports_technical') }}</option>
                            <option value="note_politique">📋 {{ __('resources.policy_briefs_type') }}</option>
                            <option value="these">🎓 {{ __('resources.theses') }}</option>
                            <option value="memoire">📖 {{ __('resources.dissertations') }}</option>
                        </select>
                    </div>

                    <!-- Filtre Année -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex gap-2">
                            <select wire:model.live="selectedYear" class="form-select rounded-pill py-2 shadow-none">
                                <option value="all">🗓️ {{ __('resources.all_years') }}</option>
                                @foreach ($availableYears as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            @if ($search !== '' || $selectedType !== 'all' || $selectedYear !== 'all')
                                <button wire:click="resetFilters" class="btn btn-outline-secondary rounded-pill px-3" title="{{ __('resources.reset_filters') }}">
                                    <i class="fa fa-solid fa-rotate-left"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Onglets rapides par type -->
                <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">
                    <button 
                        type="button" 
                        wire:click="$set('selectedType', 'all')" 
                        class="btn btn-sm rounded-pill px-3 {{ $selectedType === 'all' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                    >
                        {{ __('resources.all') }}
                    </button>
                    <button 
                        type="button" 
                        wire:click="$set('selectedType', 'article_scientifique')" 
                        class="btn btn-sm rounded-pill px-3 {{ $selectedType === 'article_scientifique' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                    >
                        {{ __('resources.articles_scientific') }}
                    </button>
                    <button 
                        type="button" 
                        wire:click="$set('selectedType', 'rapport_technique')" 
                        class="btn btn-sm rounded-pill px-3 {{ $selectedType === 'rapport_technique' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                    >
                        {{ __('resources.reports_technical') }}
                    </button>
                    <button 
                        type="button" 
                        wire:click="$set('selectedType', 'note_politique')" 
                        class="btn btn-sm rounded-pill px-3 {{ $selectedType === 'note_politique' ? 'btn-primary' : 'btn-outline-secondary bg-white' }}"
                    >
                        {{ __('resources.policy_briefs_type') }}
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ LISTE DES PUBLICATIONS ============ -->
    <section class="section-sm pt-2" x-data="{ 
        copiedId: null,
        copyCitation(text, id) {
            navigator.clipboard.writeText(text);
            this.copiedId = id;
            setTimeout(() => { this.copiedId = null; }, 2500);
        }
    }">
        <div class="container">
            <!-- Indicateur de chargement -->
            <div wire:loading.flex class="justify-content-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">{{ __('resources.loading') }}</span>
                </div>
            </div>

            <div wire:loading.remove>
                @if ($publications->isNotEmpty())
                    <div class="row g-4">
                        @foreach ($publications as $pub)
                            @php
                                $typeColor = match($pub->type) {
                                    'article_scientifique' => 'primary',
                                    'rapport_technique'    => 'success',
                                    'note_politique'       => 'warning',
                                    'these', 'memoire'     => 'info',
                                    default                => 'secondary',
                                };
                                $typeLabel = match($pub->type) {
                                    'article_scientifique' => __('resources.articles_scientific'),
                                    'rapport_technique'    => __('resources.reports_technical'),
                                    'note_politique'       => __('resources.policy_briefs_type'),
                                    'these'                => __('resources.theses'),
                                    'memoire'              => __('resources.dissertations'),
                                    default                => ucfirst($pub->type),
                                };
                            @endphp
                            <div class="col-lg-6">
                                <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white d-flex flex-column justify-content-between transition-all hover-shadow">
                                    <div>
                                        <!-- En-tête de carte -->
                                        <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                                            <span class="badge bg-{{ $typeColor }}-subtle text-{{ $typeColor }} fw-semibold px-3 py-1 rounded-pill" style="font-size: .82rem;">
                                                {{ $typeLabel }}
                                            </span>
                                            @if ($pub->published_date)
                                                <span class="badge bg-light text-muted border px-2 py-1 small">
                                                    <i class="fa fa-regular fa-calendar me-1"></i>{{ $pub->published_date->format('M Y') }}
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Titre -->
                                        <h3 class="h5 fw-bold text-dark mb-2" style="line-height: 1.4;">
                                            {{ $pub->title }}
                                        </h3>

                                        <!-- Journal / Éditeur -->
                                        @if ($pub->journal_or_publisher)
                                            <p class="text-primary small fw-medium mb-2">
                                                <i class="fa fa-solid fa-book-open me-1"></i> {{ $pub->journal_or_publisher }}
                                            </p>
                                        @endif

                                        <!-- Auteurs -->
                                        <div class="text-muted small mb-3">
                                            <i class="fa fa-solid fa-pen-nib me-1 text-secondary"></i>
                                            @php
                                                $authorList = [];
                                                foreach ($pub->authors() as $author) {
                                                    $authorList[] = $author->full_name;
                                                }
                                                if ($pub->external_co_authors) {
                                                    $authorList[] = $pub->external_co_authors;
                                                }
                                            @endphp
                                            {{ !empty($authorList) ? implode(', ', $authorList) : 'Équipe CARICS' }}
                                        </div>

                                        <!-- Abstract / Résumé -->
                                        @if ($pub->abstract)
                                            <div x-data="{ expanded: false }" class="mb-3">
                                                <p class="text-secondary small mb-1" style="line-height: 1.6;" x-show="!expanded">
                                                    {{ Str::limit($pub->abstract, 160) }}
                                                    @if (strlen($pub->abstract) > 160)
                                                        <a href="javascript:void(0)" @click="expanded = true" class="text-primary fw-medium ms-1">{{ __('resources.read_more') }}</a>
                                                    @endif
                                                </p>
                                                <p class="text-secondary small mb-1" style="line-height: 1.6;" x-show="expanded" x-cloak>
                                                    {{ $pub->abstract }}
                                                    <a href="javascript:void(0)" @click="expanded = false" class="text-primary fw-medium ms-1">{{ __('resources.read_less') }}</a>
                                                </p>
                                            </div>
                                        @endif

                                        <!-- Projet de recherche lié -->
                                        @if ($pub->researchProject)
                                            <div class="mb-3">
                                                <span class="badge bg-light text-secondary border small">
                                                    <i class="fa fa-solid fa-folder-open me-1"></i> {{ __('resources.project_label') }} {{ Str::limit($pub->researchProject->title, 40) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Actions en bas de carte -->
                                    <div class="pt-3 mt-2 border-top d-flex flex-wrap justify-content-between align-items-center gap-2">
                                        <!-- Citation rapide -->
                                        <button 
                                            type="button" 
                                            @click="copyCitation(@js($pub->citation), {{ $pub->id }})" 
                                            class="btn btn-sm btn-light border rounded-pill px-3" 
                                            title="Copier la citation APA"
                                        >
                                            <span x-show="copiedId !== {{ $pub->id }}">
                                                <i class="fa fa-regular fa-copy me-1 text-muted"></i> {{ __('resources.cite') }}
                                            </span>
                                            <span x-show="copiedId === {{ $pub->id }}" x-cloak class="text-success fw-medium">
                                                <i class="fa fa-solid fa-check me-1"></i> {{ __('resources.citation_copied') }}
                                            </span>
                                        </button>

                                        <div class="d-flex gap-2">
                                            <!-- Télécharger PDF -->
                                            @if ($pub->document_url)
                                                <a href="{{ $pub->document_url }}" target="_blank" download class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                    <i class="fa fa-solid fa-file-pdf me-1"></i> PDF
                                                </a>
                                            @endif

                                            <!-- Lien externe DOI / Éditeur -->
                                            @if ($pub->external_url)
                                                <a href="{{ $pub->external_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary rounded-pill px-3">
                                                    {{ __('resources.consult') }} <i class="fa fa-solid fa-arrow-up-right-from-square ms-1 small"></i>
                                                </a>
                                            @endif
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
                        <h4 class="h5 fw-bold text-dark mb-2">{{ __('resources.no_publication_found') }}</h4>
                        <p class="text-muted small mb-3">{{ __('resources.no_publication_desc') }}</p>
                        <button type="button" wire:click="resetFilters" class="btn btn-outline-primary rounded-pill px-4 btn-sm">
                            <i class="fa fa-solid fa-rotate-left me-1"></i> {{ __('resources.reset_filters') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ============ OUTILS ET RESSOURCES PRATIQUES ============ -->
    @if ($tools->isNotEmpty())
        <section class="section-sm bg-light mt-5">
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
                        <div class="row g-3">
                            @foreach ($tools as $tool)
                                <div class="col-md-6">
                                    <div class="card p-3 border rounded-3 shadow-sm bg-white h-100">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="badge bg-success-subtle text-success fw-medium px-2 py-1" style="font-size:.8rem;">
                                                {{ $tool->category?->name ?? __('resources.tool_badge') }}
                                            </span>
                                            @if ($tool->file_type)
                                                <span class="text-muted small uppercase fw-bold">{{ $tool->file_type }}</span>
                                            @endif
                                        </div>
                                        <h3 class="h6 mb-2 fw-bold text-dark">{{ $tool->title }}</h3>
                                        @if ($tool->description)
                                            <p class="text-muted mb-3 small" style="line-height:1.5;">{{ $tool->description }}</p>
                                        @endif
                                        @if ($tool->file_path)
                                            <a href="{{ asset($tool->file_path) }}" target="_blank" download class="btn btn-sm btn-outline-secondary rounded-pill mt-auto align-self-start">
                                                <i class="fa fa-solid fa-download me-1"></i> {{ __('resources.download') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
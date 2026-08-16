<?php

use App\Models\BlogPost;
use App\Models\News;
use App\Models\Publication;
use App\Models\ResearchProject;
use App\Models\TeamMember;
use Livewire\Component;

new class extends Component {
    public string $query = '';

    public function with(): array
    {
        if (strlen(trim($this->query)) < 2) {
            return [
                'projects'     => [],
                'publications' => [],
                'news'         => [],
                'team'         => [],
                'totalResults' => 0,
            ];
        }

        $term = trim($this->query);

        $projects = ResearchProject::published()
            ->where('title', 'like', "%{$term}%")
            ->orWhere('context', 'like', "%{$term}%")
            ->take(4)
            ->get();

        $publications = Publication::published()
            ->where('title', 'like', "%{$term}%")
            ->orWhere('abstract', 'like', "%{$term}%")
            ->take(4)
            ->get();

        $news = News::published()
            ->where('title', 'like', "%{$term}%")
            ->orWhere('excerpt', 'like', "%{$term}%")
            ->take(3)
            ->get();

        $team = TeamMember::published()
            ->where(function ($q) use ($term) {
                $q->where('full_name', 'like', "%{$term}%")
                    ->orWhere('role_title', 'like', "%{$term}%")
                    ->orWhere('current_position', 'like', "%{$term}%");
            })
            ->take(3)
            ->get();

        $totalResults = count($projects) + count($publications) + count($news) + count($team);

        return [
            'projects'     => $projects,
            'publications' => $publications,
            'news'         => $news,
            'team'         => $team,
            'totalResults' => $totalResults,
        ];
    }
};
?>

<div 
    x-data="{ 
        open: false,
        openModal() {
            this.open = true;
            this.$nextTick(() => this.$refs.searchInput.focus());
        },
        closeModal() {
            this.open = false;
        }
    }"
    @keydown.window.prevent.cmd.k="openModal()"
    @keydown.window.prevent.ctrl.k="openModal()"
    @keydown.window.escape="closeModal()"
    @open-global-search.window="openModal()"
>
    <!-- Modal Backdrop -->
    <div 
        x-show="open" 
        x-transition.opacity.duration.200ms
        class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 align-items-start justify-content-center p-3 p-md-5"
        :style="open ? 'display: flex !important; z-index: 9999; backdrop-filter: blur(4px);' : 'display: none !important;'"
        @click.self="closeModal()"
        x-cloak
    >
        <div 
            x-show="open" 
            x-transition.scale.origin.top.duration.200ms
            class="card border-0 shadow-2xl rounded-4 w-100 overflow-hidden" 
            style="max-width: 680px; max-height: 85vh; background: #ffffff;"
            @click.stop
        >
            <!-- Search Header -->
            <div class="p-3 p-md-4 border-bottom bg-light d-flex align-items-center gap-3">
                <i class="fa fa-solid fa-magnifying-glass text-primary fs-5"></i>
                <input 
                    type="text" 
                    wire:model.live.debounce.250ms="query"
                    x-ref="searchInput"
                    class="form-control form-control-lg border-0 bg-transparent shadow-none p-0 fs-6" 
                    placeholder="Rechercher une publication, un projet, un chercheur... (Échap pour fermer)"
                >
                <button type="button" @click="closeModal()" class="btn btn-sm btn-light rounded-circle p-2 text-muted">
                    <i class="fa fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Search Results Body -->
            <div class="p-3 p-md-4 overflow-y-auto" style="max-height: 60vh;">
                @if (strlen(trim($query)) < 2)
                    <div class="text-center py-4 text-muted small">
                        <i class="fa fa-solid fa-keyboard fs-3 text-secondary mb-2 d-block"></i>
                        Tapez au moins 2 caractères pour explorer les ressources du CARICS.
                        <div class="mt-2 text-muted-2">
                            <span class="badge bg-light text-dark border me-1">Ctrl + K</span> pour ouvrir rapidement.
                        </div>
                    </div>
                @elseif ($totalResults === 0)
                    <div class="text-center py-4 text-muted small">
                        <i class="fa fa-regular fa-face-frown fs-3 text-secondary mb-2 d-block"></i>
                        Aucun résultat pour « <strong class="text-dark">{{ $query }}</strong> ».
                    </div>
                @else
                    <div class="d-flex flex-column gap-4">
                        <!-- Publications -->
                        @if ($publications->isNotEmpty())
                            <div>
                                <h6 class="text-uppercase text-primary fw-bold small mb-2">
                                    <i class="fa fa-solid fa-book-open me-1"></i> Publications Scientifiques ({{ count($publications) }})
                                </h6>
                                <div class="list-group list-group-flush rounded-3">
                                    @foreach ($publications as $pub)
                                        <a href="{{ route('ressource-publication') }}?q={{ urlencode($pub->title) }}" @click="closeModal()" class="list-group-item list-group-item-action p-2 border-0 rounded-2 mb-1">
                                            <div class="fw-semibold text-dark small">{{ $pub->title }}</div>
                                            <div class="text-muted small" style="font-size: .8rem;">
                                                {{ $pub->journal_or_publisher ?? 'Publication' }} • {{ $pub->published_date?->format('Y') ?? 'CARICS' }}
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Projets -->
                        @if ($projects->isNotEmpty())
                            <div>
                                <h6 class="text-uppercase text-success fw-bold small mb-2">
                                    <i class="fa fa-solid fa-flask-vial me-1"></i> Projets de Recherche ({{ count($projects) }})
                                </h6>
                                <div class="list-group list-group-flush rounded-3">
                                    @foreach ($projects as $proj)
                                        <a href="{{ route('recherche-expertize-projet') }}?q={{ urlencode($proj->title) }}" @click="closeModal()" class="list-group-item list-group-item-action p-2 border-0 rounded-2 mb-1">
                                            <div class="fw-semibold text-dark small">{{ $proj->title }}</div>
                                            <div class="text-muted small" style="font-size: .8rem;">
                                                Région : {{ $proj->region ?? 'Togo' }} • {{ $proj->status }}
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Chercheurs / Équipe -->
                        @if ($team->isNotEmpty())
                            <div>
                                <h6 class="text-uppercase text-warning fw-bold small mb-2">
                                    <i class="fa fa-solid fa-users me-1"></i> Équipe & Chercheurs ({{ count($team) }})
                                </h6>
                                <div class="list-group list-group-flush rounded-3">
                                    @foreach ($team as $member)
                                        <a href="{{ route('equipe') }}" @click="closeModal()" class="list-group-item list-group-item-action p-2 border-0 rounded-2 mb-1 d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: .85rem;">
                                                {{ substr($member->full_name, 0, 2) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark small">{{ $member->full_name }}</div>
                                                <div class="text-muted small" style="font-size: .78rem;">{{ $member->role_title ?? $member->current_position }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Actualités -->
                        @if ($news->isNotEmpty())
                            <div>
                                <h6 class="text-uppercase text-info fw-bold small mb-2">
                                    <i class="fa fa-solid fa-newspaper me-1"></i> Actualités ({{ count($news) }})
                                </h6>
                                <div class="list-group list-group-flush rounded-3">
                                    @foreach ($news as $item)
                                        <a href="{{ route('actu-opportunites') }}" @click="closeModal()" class="list-group-item list-group-item-action p-2 border-0 rounded-2 mb-1">
                                            <div class="fw-semibold text-dark small">{{ $item->title }}</div>
                                            <div class="text-muted small" style="font-size: .8rem;">{{ $item->published_date?->format('d/m/Y') }}</div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="p-3 bg-light border-top d-flex justify-content-between align-items-center small text-muted">
                <span>Appuyez sur <kbd class="bg-white text-dark border px-1 rounded">Échap</kbd> pour fermer</span>
                <span class="text-primary fw-medium">CARICS-Togo Search</span>
            </div>
        </div>
    </div>
</div>

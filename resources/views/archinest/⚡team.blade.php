<?php

use App\Models\TeamMember;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    #[Url(as: 'cat')]
    public string $selectedCategory = 'all';

    public function with(): array
    {
        $membersQuery = TeamMember::published()->ordered()
            ->when($this->selectedCategory !== 'all', function ($q) {
                $q->where('role_category', $this->selectedCategory);
            });

        return [
            'members' => $membersQuery->get(),
            'counts'  => [
                'all'                  => TeamMember::published()->count(),
                'bureau_executif'      => TeamMember::published()->where('role_category', 'bureau_executif')->count(),
                'conseil_scientifique' => TeamMember::published()->where('role_category', 'conseil_scientifique')->count(),
                'chercheur_associe'    => TeamMember::published()->where('role_category', 'chercheur_associe')->count(),
                'equipe_technique'     => TeamMember::published()->where('role_category', 'equipe_technique')->count(),
            ],
        ];
    }
};
?>

<div>
    <section class="page-title" style="background-image: url({{ asset('images/banner.jpg') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">{{ __('team.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">{{ __('navigation.menu.home') }}</a></li>
                    <li>{{ __('team.title') }}</li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <!-- ============ INTRO ============ -->
        <section class="section-sm">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-8">
                        <div class="eyebrow">{{ __('team.board_eyebrow') }}</div>
                        <h2 class="section-title mb-3">{{ __('team.board_title') }}</h2>
                        <p class="section-lead mb-0">
                            {!! __('team.intro') !!}
                        </p>
                    </div>
                </div>

                <!-- Filtres par catégorie -->
                <div class="d-flex flex-wrap gap-2 mt-4 pt-2">
                    <button type="button" 
                            wire:click="$set('selectedCategory', 'all')"
                            class="btn btn-sm rounded-pill px-3 {{ $selectedCategory === 'all' ? 'btn-primary' : 'btn-light border' }}">
                        Tous les membres <span class="badge bg-white bg-opacity-25 ms-1">{{ $counts['all'] }}</span>
                    </button>
                    @if ($counts['bureau_executif'] > 0)
                        <button type="button" 
                                wire:click="$set('selectedCategory', 'bureau_executif')"
                                class="btn btn-sm rounded-pill px-3 {{ $selectedCategory === 'bureau_executif' ? 'btn-primary' : 'btn-light border' }}">
                            Bureau Exécutif <span class="badge bg-white bg-opacity-25 ms-1">{{ $counts['bureau_executif'] }}</span>
                        </button>
                    @endif
                    @if ($counts['conseil_scientifique'] > 0)
                        <button type="button" 
                                wire:click="$set('selectedCategory', 'conseil_scientifique')"
                                class="btn btn-sm rounded-pill px-3 {{ $selectedCategory === 'conseil_scientifique' ? 'btn-primary' : 'btn-light border' }}">
                            Conseil Scientifique <span class="badge bg-white bg-opacity-25 ms-1">{{ $counts['conseil_scientifique'] }}</span>
                        </button>
                    @endif
                    @if ($counts['chercheur_associe'] > 0)
                        <button type="button" 
                                wire:click="$set('selectedCategory', 'chercheur_associe')"
                                class="btn btn-sm rounded-pill px-3 {{ $selectedCategory === 'chercheur_associe' ? 'btn-primary' : 'btn-light border' }}">
                            Chercheurs Associés <span class="badge bg-white bg-opacity-25 ms-1">{{ $counts['chercheur_associe'] }}</span>
                        </button>
                    @endif
                    @if ($counts['equipe_technique'] > 0)
                        <button type="button" 
                                wire:click="$set('selectedCategory', 'equipe_technique')"
                                class="btn btn-sm rounded-pill px-3 {{ $selectedCategory === 'equipe_technique' ? 'btn-primary' : 'btn-light border' }}">
                            Équipe Technique <span class="badge bg-white bg-opacity-25 ms-1">{{ $counts['equipe_technique'] }}</span>
                        </button>
                    @endif
                </div>
            </div>
        </section>

        <!-- ============ GRILLE DES MEMBRES ============ -->
        <section class="section pt-0">
            <div class="container">
                <div class="row g-4">
                    @forelse ($members as $member)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <a href="{{ route('team-detail', ['slug' => $member['slug']]) }}" class="text-decoration-none text-reset d-block h-100">
                                <div class="team-card h-100 d-flex flex-column justify-content-between p-3 border rounded-4 bg-white shadow-sm hover-shadow transition-all">
                                    <div>
                                        <div class="team-photo mb-3 rounded-3 overflow-hidden position-relative" style="height: 230px; background: #f1f5f9;">
                                            @if ($member->avatar_url)
                                                <img src="{{ str_starts_with($member->avatar_url, 'http') ? $member->avatar_url : asset($member->avatar_url) }}" 
                                                     alt="{{ $member['fullName'] }}" 
                                                     loading="lazy" 
                                                     decoding="async"
                                                     class="w-100 h-100 object-fit-cover"
                                                     style="object-fit: cover;">
                                            @elseif (!empty($member['imageName']))
                                                <img src="{{ asset('images/equipes/' . $member['imageName']) }}" 
                                                     alt="{{ $member['fullName'] }}" 
                                                     loading="lazy" 
                                                     decoding="async"
                                                     class="w-100 h-100 object-fit-cover"
                                                     style="object-fit: cover;">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-primary text-white fs-1 fw-bold">
                                                    {{ $member['initials'] }}
                                                </div>
                                            @endif

                                            @if ($member->is_founder)
                                                <span class="badge bg-dark bg-opacity-75 text-white position-absolute top-0 start-0 m-2 px-2 py-1 rounded-pill small">
                                                    Fondateur
                                                </span>
                                            @endif
                                        </div>
                                        <div class="team-body">
                                            <h3 class="h6 fw-bold text-dark mb-1">{{ $member['fullName'] }}</h3>
                                            <div class="text-primary small fw-semibold mb-2">{{ $member['roleTitle'] }}</div>
                                            @if (!empty($member['current_position']))
                                                <div class="text-muted small mb-2" style="font-size: .82rem;">
                                                    <i class="fa fa-solid fa-briefcase text-secondary me-1"></i> {{ Str::limit($member['current_position'], 55) }}
                                                </div>
                                            @endif
                                            <p class="text-secondary small mb-3" style="font-size: .88rem; line-height: 1.5;">
                                                {{ Str::limit($member['bioShort'], 110) }}
                                            </p>

                                            <!-- Mini-tags expertises (2 max) -->
                                            @if (!empty($member['expertises']) && is_array($member['expertises']))
                                                <div class="d-flex flex-wrap gap-1 mb-2">
                                                    @foreach (array_slice($member['expertises'], 0, 2) as $exp)
                                                        <span class="badge bg-light text-secondary border small" style="font-size: .72rem;">
                                                            {{ $exp }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="pt-2 border-top mt-auto d-flex justify-content-between align-items-center">
                                        <span class="text-primary fw-medium small">{{ __('team.view_profile') }}</span>
                                        <i class="fa-solid fa-arrow-right text-primary small"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="p-5 bg-light rounded-4 border">
                                <i class="fa fa-solid fa-users text-muted fs-1 mb-3"></i>
                                <h4 class="h5 text-dark">Aucun membre trouvé dans cette catégorie</h4>
                                <p class="text-muted small mb-3">Essayez de sélectionner une autre catégorie.</p>
                                <button type="button" wire:click="$set('selectedCategory', 'all')" class="btn btn-sm btn-primary rounded-pill px-3">
                                    Voir tous les membres
                                </button>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- ============ NOTRE ENGAGEMENT ============ -->
        <section class="section bg-bg-alt">
            <div class="container">
                <div class="row g-4 g-lg-5 align-items-center">
                    <div class="col-lg-7">
                        <div class="eyebrow">{{ __('team.commitment.eyebrow') }}</div>
                        <h2 class="section-title mb-3">{{ __('team.commitment.title') }}</h2>
                        <p>
                            {{ __('team.commitment.text_1') }}
                        </p>
                        <p class="mb-4">
                            {{ __('team.commitment.text_2') }}
                        </p>
                        <a href="{{ route('contact') }}" class="btn-cta">{{ __('team.commitment.join_cta') }} <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="col-lg-5">
                        <div class="card-soft" style="background:var(--white);">
                            <div class="eyebrow mb-3">{{ __('team.commitment.values_title') }}</div>
                            <ul class="list-unstyled mb-0" style="font-size:.92rem;">
                                <li class="d-flex gap-2 mb-3"><i class="fa fa-solid fa-award text-accent mt-1"></i><span>{{ __('team.commitment.val_1') }}</span></li>
                                <li class="d-flex gap-2 mb-3"><i class="fa-solid fa-shield-check text-accent mt-1"></i><span>{{ __('team.commitment.val_2') }}</span></li>
                                <li class="d-flex gap-2 mb-3"><i class="fa-solid fa-eye text-accent mt-1"></i><span>{{ __('team.commitment.val_3') }}</span></li>
                                <li class="d-flex gap-2 mb-0"><i class="fa-solid fa-clipboard-check text-accent mt-1"></i><span>{{ __('team.commitment.val_4') }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ CTA FINAL ============ -->
        <section class="section" style="background-image: var(--contour-light), linear-gradient(165deg, var(--primary), var(--ink)); background-size: 480px auto, cover; background-repeat: repeat, no-repeat; color:#fff;">
            <div class="container text-center">
                <div class="eyebrow light justify-content-center">{{ __('team.cta_collaborate.eyebrow') }}</div>
                <h2 class="font-display mb-3" style="font-size: clamp(1.5rem, 2.8vw, 2.2rem); color:#fff;">{{ __('team.cta_collaborate.title') }}</h2>
                <p class="mx-auto mb-4" style="max-width:38rem; color:rgba(255,255,255,.85);">
                    {{ __('team.cta_collaborate.text') }}
                </p>
                <a href="{{ route('contact') }}" class="btn-cta-light">{{ __('team.cta_collaborate.btn') }}</a>
            </div>
        </section>
    </section>
</div>
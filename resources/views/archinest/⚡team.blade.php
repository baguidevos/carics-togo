<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Data\TeamData;

new #[Layout('layouts::archinest')] class extends Component {
    public function with(): array
    {
        return [
            'members' => TeamData::all(),
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
                <div class="row">
                    <div class="col-lg-8">
                        <p class="section-lead mb-0">
                            {!! __('team.intro') !!}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ GRILLE BUREAU EXÉCUTIF ============ -->
        <section class="section">
            <div class="container">
                <div class="eyebrow">{{ __('team.board_eyebrow') }}</div>
                <h2 class="section-title mb-4">{{ __('team.board_title') }}</h2>

                <div class="row g-4">

                    @foreach ($members as $member)
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('team-detail', ['slug' => $member['slug']]) }}" class="text-decoration-none text-reset d-block h-100">
                            <div class="team-card h-100">
                                <div class="team-photo">
                                    <img src="{{ asset('images/equipes/' . $member['imageName']) }}" alt="{{ $member['fullName'] }}">
                                </div>
                                <div class="team-body">
                                    <h3 class="h6 mb-1">{{ $member['fullName'] }}</h3>
                                    <div class="team-role">{{ $member['roleTitle'] }}</div>
                                    <p class="team-excerpt">
                                        {{ $member['bioShort'] }}
                                    </p>
                                    <div class="team-link">{{ __('team.view_profile') }} <i class="fa-solid fa-arrow-right ms-1"></i></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach

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
                        <a href="{{ route('contact') }}" class="btn-cta">{{ __('team.commitment.join_cta') }} <i
                                class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="col-lg-5">
                        <div class="card-soft" style="background:var(--white);">
                            <div class="eyebrow mb-3">{{ __('team.commitment.values_title') }}</div>
                            <ul class="list-unstyled mb-0" style="font-size:.92rem;">
                                <li class="d-flex gap-2 mb-3"><i
                                        class="fa fa-solid fa-award text-accent mt-1"></i><span>{{ __('team.commitment.val_1') }}</span>
                                </li>
                                <li class="d-flex gap-2 mb-3"><i
                                        class="fa-solid fa-shield-check text-accent mt-1"></i><span>{{ __('team.commitment.val_2') }}</span></li>
                                <li class="d-flex gap-2 mb-3"><i
                                        class="fa-solid fa-eye text-accent mt-1"></i><span>{{ __('team.commitment.val_3') }}</span></li>
                                <li class="d-flex gap-2 mb-0"><i
                                        class="fa-solid fa-clipboard-check text-accent mt-1"></i><span>{{ __('team.commitment.val_4') }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ CTA FINAL ============ -->
        <section class="section"
            style="background-image: var(--contour-light), linear-gradient(165deg, var(--primary), var(--ink)); background-size: 480px auto, cover; background-repeat: repeat, no-repeat; color:#fff;">
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
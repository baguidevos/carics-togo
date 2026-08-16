<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts::archinest')] class extends Component {
    //
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
                    <div class="empty-state">
                        <span class="badge-status upcoming">{{ __('resources.badge_upcoming') }}</span>
                        <p class="mb-2" style="font-size:.95rem;">{{ __('resources.scientific_publications.empty_text') }}</p>
                        <ul class="mb-0" style="font-size:.92rem; color:var(--muted);">
                            <li>{{ __('resources.scientific_publications.item_1') }}</li>
                            <li>{{ __('resources.scientific_publications.item_2') }}
                            </li>
                            <li>{{ __('resources.scientific_publications.item_3') }}</li>
                        </ul>
                    </div>
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
                </div>
            </div>
        </div>
    </section>
</div>
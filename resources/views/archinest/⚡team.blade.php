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
    <section class="page-title" style="background-image: url(images/banner.jpg);">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">Leadership & Gouvernance</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li>Leadership & Gouvernance</li>
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
                          
                            <strong>CARICS-Togo</strong> est dirigé par un Bureau Exécutif élu conformément à ses statuts. Le Bureau
                            assure l'orientation stratégique, la gouvernance institutionnelle, la supervision
                            scientifique et la gestion administrative et financière de l'organisation. Les membres
                            fondateurs partagent une expérience commune dans la recherche en santé publique,
                            l'épidémiologie, la gestion des programmes de santé et le développement communautaire.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ GRILLE BUREAU EXÉCUTIF ============ -->
        <section class="section">
            <div class="container">
                <div class="eyebrow">Bureau Exécutif</div>
                <h2 class="section-title mb-4">Les membres du Bureau Exécutif</h2>

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
                                    <div class="team-link">Voir le profil <i class="fa-solid fa-arrow-right ms-1"></i></div>
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
                        <div class="eyebrow">Notre engagement</div>
                        <h2 class="section-title mb-3">Un réseau élargi de chercheurs et de partenaires</h2>
                        <p>
                            Le Bureau Exécutif est appuyé par un réseau de chercheurs associés, consultants,
                            experts techniques et partenaires institutionnels mobilisés en fonction des besoins
                            des projets et programmes.
                        </p>
                        <p class="mb-4">
                            CARICS-Togo s&rsquo;engage à promouvoir l&rsquo;excellence scientifique, l&rsquo;éthique de
                            la
                            recherche, la transparence institutionnelle et l&rsquo;utilisation des données probantes
                            pour améliorer les politiques, les programmes et les interventions de santé en Afrique.
                        </p>
                        <a href="{{ route('contact') }}" class="btn-cta">Rejoindre notre réseau <i
                                class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                    <div class="col-lg-5">
                        <div class="card-soft" style="background:var(--white);">
                            <div class="eyebrow mb-3">Valeurs de gouvernance</div>
                            <ul class="list-unstyled mb-0" style="font-size:.92rem;">
                                <li class="d-flex gap-2 mb-3"><i
                                        class="fa fa-solid fa-award text-accent mt-1"></i><span>Excellence scientifique</span>
                                </li>
                                <li class="d-flex gap-2 mb-3"><i
                                        class="fa-solid fa-shield-check text-accent mt-1"></i><span>Éthique de la
                                        recherche</span></li>
                                <li class="d-flex gap-2 mb-3"><i
                                        class="fa-solid fa-eye text-accent mt-1"></i><span>Transparence
                                        institutionnelle</span></li>
                                <li class="d-flex gap-2 mb-0"><i
                                        class="fa-solid fa-clipboard-check text-accent mt-1"></i><span>Utilisation des données
                                        probantes</span></li>
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
                <div class="eyebrow light justify-content-center">Chercheurs associés</div>
                <h2 class="font-display mb-3" style="font-size: clamp(1.5rem, 2.8vw, 2.2rem); color:#fff;">Vous
                    souhaitez collaborer avec CARICS-Togo&nbsp;?</h2>
                <p class="mx-auto mb-4" style="max-width:38rem; color:rgba(255,255,255,.85);">
                    Chercheurs, consultants et experts techniques sont régulièrement mobilisés selon les
                    besoins de nos projets et programmes.
                </p>
                <a href="{{ route('contact') }}" class="btn-cta-light">Proposer une collaboration</a>
            </div>
        </section>

    </section>
</div>
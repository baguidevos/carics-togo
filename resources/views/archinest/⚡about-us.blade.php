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
    <!-- Start main-content -->
    <section class="page-title" style="background-image: url(images/banner.jpg);">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">À propos de nous</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li>À propos de nous</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
    <!-- About Section -->
    <section class="about-section-home-two">
        <div class="auto-container">
            <div class="sec-title-style-two">
                <h6 class="sub-title"></h6>
                <h2 class="title text-reveal-anim">Qui sommes-nous ?</h2>
            </div>
            <div class="row">
                <div class="image-column col-xl-3 col-md-6 d-none d-xl-block">
                    <figure class="image one">
                        <img src="archinest/images/resource/feature-h2-1.jpg" alt="">
                    </figure>
                </div>
                {{-- <div class="image-column col-xl-4 col-lg-5">
                    <figure class="image">
                        <img src="archinest/images/resource/feature-h2-2.jpg" alt="">
                    </figure>
                </div> --}}
                <div class="content-column col-xl-9 col-lg-12">
                    <div class="inner-column">
                        <div class="content">
                            <div class="text">Le Centre Africain d'Action pour la Recherche et l'Innovation
                                Communautaire en Santé (CARICS-Togo) est un centre indépendant de recherche,
                                d'innovation et d'action en santé publique basé au Togo</div>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="page-about.html">Historique</a></h4>
                            <div class="text">Créé en 2026 à Dapaong, dans la Région des Savanes, CARICS-Togo a été
                                fondé par des chercheurs, professionnels de santé et spécialistes du développement
                                partageant une conviction commune : les décisions en santé publique doivent être guidées
                                par des données fiables, contextualisées et utiles à l'action.</div>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="page-about.html">Statut Juridique</a></h4>
                            <div class="text">Constitué sous la forme juridique d'une association à but non lucratif,
                                CARICS-Togo agit comme une plateforme de recherche appliquée, de collaboration
                                scientifique et d'innovation au service des communautés, des institutions publiques et
                                des partenaires du développement.</div>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="page-about.html">Ambitions</a></h4>
                            <div class="text">Notre ambition est de contribuer à l'amélioration durable de la santé des
                                populations africaines en rapprochant la recherche, l'innovation et l'action.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section-->

    <!-- Approche Section -->
    <section class="why-choose-us-four pt-0">
        <div class="container">
            <div class="inner-container">
                <figure class="image reveal"><img src="{{ asset('images/recherche.jpg') }}" alt=""></figure>
                <div class="row">
                    <div class="col-xl-6 offset-xl-6">
                        <div class="content-box">
                            <div class="sec-title-style-three">
                                {{-- <h6 class="sub-title">// Notre Approche //</h6> --}}
                                <h2 class="title text-reveal-anim">Recherche - Innovation - Action</h2>
                                <div class="text">CARICS-Togo repose sur trois piliers complémentaires qui guident
                                    l'ensemble de ses activités.</div>
                            </div>
                            <a href="page-project-details.html" class="theme-btn btn-style-one">
                                <span class="btn-title">Nous Contacter</span> <i
                                    class="icon fa-light fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xxl-10 offset-xxl-2">
                        <div class="row g-0">
                            <div class="feature-block col-lg-4 col-md-6">
                                <div class="inner-block">
                                    <div>
                                        <div class="number">01</div>
                                        <h4 class="title"><a href="#">Recherche</a></h4>
                                        <div class="text">Produire des connaissances scientifiques de qualité répondant
                                            aux
                                            défis prioritaires de santé publique. Données probantes pour la décision.
                                        </div>
                                    </div>
                                    <div class="pricing-block mt-4">
                                        <div class="inner-block active">
                                            <div class="content-column">
                                                <h4 class="pricing-title"> Résultat Attendu</h4>
                                                <div class="text">Données probantes pour la décision.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="feature-block col-lg-4 col-md-6">
                                <div class="inner-block">
                                    <div>
                                        <div class="number">02</div>
                                        <h4 class="title"><a href="#">Innovation</a></h4>
                                        <div class="text">Développer, tester et adapter des solutions innovantes
                                            répondant aux besoins des communautés et des systèmes de santé.
                                        </div>
                                    </div>
                                    <div class="pricing-block mt-4">
                                        <div class="inner-block active">
                                            <div class="content-column">
                                                <h4 class="pricing-title"> Résultat Attendu</h4>
                                                <div class="text">Des solutions adaptées au contexte.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="feature-block col-lg-4 col-md-6">
                                <div class="inner-block">
                                    <div>
                                        <div class="number">03</div>
                                        <h4 class="title"><a href="#">Action</a></h4>
                                        <div class="text">Transformer les résultats de recherche en interventions,
                                            recommandations et politiques publiques.
                                        </div>
                                    </div>
                                    <div class="pricing-block mt-4">
                                        <div class="inner-block active">
                                            <div class="content-column">
                                                <h4 class="pricing-title"> Résultat Attendu</h4>
                                                <div class="text">Amélioration durable de la santé</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Approche Section-->

    <!-- Values Section -->
    <section class="work-section pt-0 pb-0">
        <div class="large-container">
            <div class="inner-container">
                <div class="sec-title-box">
                    <div class="sec-title-style-three">
                        {{-- <h6 class="sub-title">// Nos Valeurs //</h6> --}}
                        <h2 class="title text-reveal-anim">L'intégrité au cœur de notre démarche</h2>
                    </div>
                    <div class="sec-right-box">
                        <div class="text">Les valeurs guident nos actions et nos décisions. Elles définissent la culture
                            de notre organisation et orientent nos interactions avec nos partenaires, nos bailleurs et
                            les
                            communautés que nous servons.
                        </div>
                    </div>
                </div>
                <div class="row g-24">
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">01</div>
                            <h4 class="title"><a href="page-project-details.html">Excellence scientifique</a></h4>
                            <div class="text">
                                Promouvoir la rigueur méthodologique, la qualité des données et
                                l'excellence dans toutes nos activités de recherche.
                            </div>
                        </div>
                    </div>
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">02</div>
                            <h4 class="title"><a href="page-project-details.html">Intégrité et éthique</a></h4>
                            <div class="text">
                                Respecter les principes d'éthique, de transparence, d'indépendance scientifique et de
                                responsabilité
                            </div>
                        </div>
                    </div>
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">03</div>
                            <h4 class="title"><a href="page-project-details.html">Innovation</a></h4>
                            <div class="text">
                                Développer et promouvoir des approches innovantes adaptées aux réalités africaines.
                            </div>
                        </div>
                    </div>
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">04</div>
                            <h4 class="title"><a href="page-project-details.html">Collaboration</a></h4>
                            <div class="text">
                                Favoriser les partenariats interdisciplinaires et la co-construction des connaissances
                                avec tous les acteurs.
                            </div>
                        </div>
                    </div>
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">05</div>
                            <h4 class="title"><a href="page-project-details.html">Transparence et redevabilité</a></h4>
                            <div class="text">
                                Garantir une gestion responsable des ressources et une communication ouverte avec les
                                partenaires et les bénéficiaires.
                            </div>
                        </div>
                    </div>
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">06</div>
                            <h4 class="title"><a href="page-project-details.html">Impact communautaire</a></h4>
                            <div class="text">
                                Veiller à ce que les résultats de la recherche contribuent concrètement à l'amélioration
                                de la santé des populations.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Values Section-->

    <!-- Team Section -->
    <section class="teams-section">
        <div class="auto-container">
            <div class="sec-title-box">
                <div class="sec-title-style-three">
                    {{-- <h6 class="sub-title">// Nos Membres //</h6> --}}
                    <h2 class="title text-reveal-anim">Gouvernance & <br> Leadership</h2>
                </div>
                <div class="sec-right-box">
                    <div class="text">
                        CARICS-Togo est dirigé par un Bureau Exécutif élu conformément à ses statuts.
                        Celui-ci assure la gouvernance stratégique, administrative, financière et scientifique de
                        l'organisation.

                    </div>
                    <a href="{{ route('equipe') }}" class="theme-btn btn-style-one">
                        <span class="btn-title">Voir plus </span>
                        <span class="icon">
                            <i class="fa-light fa-arrow-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($members as $member)
                    <div class="team-block col-xl-3 col-md-6 col-sm-12">
                        <div class="inner-block">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{ route('team-detail', ['slug' => $member['slug']]) }}">
                                        <img src="{{ asset('images/equipes/' . $member['imageName']) }}"
                                            alt="{{ $member['fullName'] }}">
                                    </a>
                                </figure>
                            </div>
                            <div class="info-box">
                                <h5 class="name">
                                    <a
                                        href="{{ route('team-detail', ['slug' => $member['slug']]) }}">{{ $member['fullName'] }}</a>
                                </h5>
                                <div class="designation">{{ $member['roleTitle'] }}</div>
                                <p class="mt-3">
                                    {{ $member['bioShort'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Team Section-->

    <!-- Partenaires Section -->
    <section class="clients-section home-3 pt-0">
        <div class="outer-container">
            <div class="inner-container" style="background-image: url(archinest/images/background/bg-claint1-1.jpg);">
                <div class="outer-box">
                    <div class="sec-title-style-three text-center">
                        {{-- <h6 class="sub-title">// Nos Partenaires //</h6> --}}
                        <h2 class="title text-reveal-anim">Collaboration et Réseaux</h2>
                    </div>
                    <p>
                    <div class="partenaire-content">
                        CARICS-Togo développe des collaborations avec des universités, instituts de recherche,
                        ministères de la santé, organisations non gouvernementales, agences de développement et
                        partenaires techniques et financiers partageant son engagement pour une santé publique fondée
                        sur les données probantes.
                    </div>
                    <div class="mt-4 partenaire-content">
                        L'organisation est ouverte aux partenariats scientifiques, aux projets de recherche
                        collaboratifs, aux évaluations de programmes de santé, aux activités de formation et au
                        développement de solutions innovantes adaptées aux contextes africains.
                    </div>

                    </p>
                    <div class="claint-outer">
                        <div>
                            <a href="news-grid.html" class="theme-btn btn-style-one">
                                <span class="btn-title">Découvrir nos travaux</span>
                                <span class="icon">
                                    <i class="fa-light fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                        <div>
                            <a href="news-grid.html" class="theme-btn btn-style-one">
                                <span class="btn-title">Devenir Partenaire</span>
                                <span class="icon">
                                    <i class="fa-light fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Partenaires Section-->

    <!-- Features Section -->
    <section class="features-section-two">
        <div class="auto-container">
            <div class="inner-container position-relative">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="sec-title-style-three">
                            {{-- <h6 class="sub-title">// Stats //</h6> --}}
                            <h2 class="title text-reveal-anim">CARICS en bref.</h2>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="feature-block-two">
                            <div class="inner-box">
                                <div class="number">#01</div>
                                <div class="content">
                                    <h4 class="title">Création</h4>
                                    <div class="text">Créé en 2026 à Dapaong, Région des Savanes (Togo).</div>
                                </div>
                                <figure class="image mb-0">
                                    <img src="{{ asset('images/cta-1.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <div class="feature-block-two">
                            <div class="inner-box active">
                                <div class="number">#02</div>
                                <div class="content">
                                    <h4 class="title">Statut</h4>
                                    <div class="text">Organisation indépendante à but non lucratif.</div>
                                </div>
                                <figure class="image mb-0">
                                    <img src="{{ asset('images/cta-1.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <div class="feature-block-two">
                            <div class="inner-box">
                                <div class="number">#03</div>
                                <div class="content">
                                    <h4 class="title">Fondateurs</h4>
                                    <div class="text">4 membres fondateurs issus de la recherche et de la santé
                                        publique.</div>
                                </div>
                                <figure class="image mb-0">
                                    <img src="{{ asset('images/cta-1.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <div class="feature-block-two">
                            <div class="inner-box mb-0">
                                <div class="number">#04</div>
                                <div class="content">
                                    <h4 class="title">Projets</h4>
                                    <div class="text">1 projet de recherche financé à l'international actuellement en
                                        cours.</div>
                                </div>
                                <figure class="image mb-0">
                                    <img src="{{ asset('images/cta-1.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <div class="feature-block-two">
                            <div class="inner-box mb-0">
                                <div class="number">#05</div>
                                <div class="content">
                                    <h4 class="title">Ambition</h4>
                                    <div class="text">Interventions au Togo avec une vocation régionale africaine.</div>
                                </div>
                                <figure class="image mb-0">
                                    <img src="{{ asset('images/cta-1.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features Section -->


</div>
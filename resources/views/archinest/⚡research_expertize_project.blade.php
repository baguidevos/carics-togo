<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts::archinest')] class extends Component {
    //
};
?>

<div>
    <!-- Start main-content -->
    <section class="page-title" style="background-image: url(images/banner.jpg);">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">Nos Domaines d'Expertises</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li>Nos Domaines d'Expertises</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->

    <!-- Expertise Six -->
    <section class="faq-section-home-two">
        <div class="auto-container">
            <div class="sec-title-box gap-4 gap-xl-0">
                <div class="sec-title-style-three">
                    <h6 class="sub-title">// // Expertise //</h6>
                    <h2 class="title text-reveal-anim">Notre expertises et Recherches</h2>
                </div>
                <div class="sec-right-box">
                    <div class="text">
                        CARICS-Togo développe et met en œuvre des activités de recherche appliquée, d'évaluation de
                        programmes et d'innovation en santé publique afin de produire des données probantes utiles à la
                        prise de décision.
                    </div>
                    <a href="page-faq.html" class="theme-btn btn-style-one">
                        <span class="btn-title"> Read More</span>
                        <span class="icon"><i class="fa-light fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
            <div class="row clearfix">
                <!-- Column -->
                <div class="image-column col-xl-4 col-lg-4">
                    <figure class="image reveal">
                        <img src="archinest/images/resource/faq-h2-1.jpg" alt="">
                    </figure>
                </div>

                <!-- Column -->
                <div class="column col-xl-7 col-lg-8 offset-xl-1">
                    <!-- Accordion Box / Style Three -->
                    <ul class="accordion-box">

                        <!-- Block -->
                        <li class="accordion block active-block">
                            <div class="acc-btn active">
                                Santé publique et épidémiologie
                                <div class="icon"><img src="archinest/images/icons/faq-h2-1.svg" alt=""></div>
                            </div>
                            <div class="acc-content current">
                                <div class="content">
                                    <div class="text">
                                        Production, analyse et interprétation de données permettant de comprendre les
                                        déterminants de santé, suivre les tendances épidémiologiques et orienter les
                                        politiques et programmes de santé publique.
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Block -->
                        <li class="accordion block active-block">
                            <div class="acc-btn active">
                                Recherche opérationnelle et sciences de l'implémentation
                                <div class="icon"><img src="archinest/images/icons/faq-h2-1.svg" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        Évaluation des interventions de santé dans les conditions réelles de mise en
                                        œuvre afin d'identifier les facteurs influençant leur couverture, leur qualité,
                                        leur efficacité et leur durabilité.
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                Santé communautaire
                                <div class="icon"><img src="archinest/images/icons/faq-h2-1.svg" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        Conception, mise en œuvre et évaluation d'approches innovantes visant à
                                        renforcer l'accès, l'utilisation et la qualité des services de santé au niveau
                                        communautaire.
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                Systèmes de santé et politiques publiques
                                <div class="icon"><img src="archinest/images/icons/faq-h2-1.svg" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        Analyses et évaluations destinées à améliorer la performance, la résilience,
                                        l'équité et la gouvernance des systèmes de santé.
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                Conception, mise en œuvre et suivi-évaluation des programmes de santé
                                <div class="icon"><img src="archinest/images/icons/faq-h2-1.svg" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        Appui technique aux institutions, organisations et partenaires pour la
                                        planification, la mise en œuvre, le suivi et l'évaluation des programmes et
                                        projets de santé publique.
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                Innovation numérique et intelligence artificielle
                                <div class="icon"><img src="archinest/images/icons/faq-h2-1.svg" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        Développement et utilisation de solutions digitales, d'outils de gestion et
                                        d'analyse des données ainsi que d'approches innovantes visant à renforcer la
                                        performance des programmes de santé.
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                Priorités de recherche
                                <div class="icon"><img src="archinest/images/icons/faq-h2-1.svg" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        Les travaux de CARICS s'inscrivent principalement dans les domaines suivants :
                                        <ul>

                                            <li>• Maladies infectieuses et tropicales ;</li>
                                            <li>• Santé maternelle, néonatale, infantile et adolescente ;</li>
                                            <li>• Renforcement des systèmes de santé ;</li>
                                            <li>• Santé communautaire ;</li>
                                            <li>• Contextes fragiles, humanitaires et zones affectées par l'insécurité ;
                                            </li>
                                            <li>• Santé numérique et systèmes d'information sanitaire ;</li>
                                            <li>• Sciences de l'implémentation et recherche opérationnelle ;</li>
                                            <li>• Prévention et contrôle des maladies non transmissibles.</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Expertise Six -->
    <!-- Projet phare Section -->
    <section class="project-details pt-120 pb-70">
        <div class="auto-container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 mb-5 mb-lg-0">
                    <div class="sec-title-style-three">
                        <h6 class="sub-title">// Projets //</h6>
                        <h2 class="title text-reveal-anim wow fadeInUp" data-wow-delay=".3s">
                            Notre projet phare en cours
                        </h2>
                        <p class="text wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                            Renforcement de la mise en œuvre de la ChimioPrévention Saisonnière du Paludisme dans un
                            contexte transfrontalier confronté à l'insécurité au Nord du Togo
                        </p>
                    </div>
                    <a href="page-project-details.html" class="theme-btn btn-style-one">
                        <span class="btn-title">Les autres projets</span> <i class="icon fa-light fa-arrow-right"></i>
                    </a>

                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-7">
                    <div class="project-details__content-right mt-0">
                        <div class="project-details__details-box rounded-0">
                            <ul class="list-unstyled project-details__details-list">
                                <li>
                                    <h4 class="project-details__name mb-2">Période :</h4>
                                    <p class="project-details__client">2026 - 2027</p>
                                </li>
                                <li>
                                    <h4 class="project-details__name mb-2">Zone d’intervention :</h4>
                                    <p class="project-details__client">Région des Savanes, Togo</p>
                                </li>
                                <li>
                                    <h4 class="project-details__name mb-2">Financement </h4>
                                    <p class="project-details__client">Royal Society of Tropical Medicine and Hygiene (RSTMH)</p>
                                </li>
                                <li>
                                    <h4 class="project-details__name mb-2">Statut :</h4>
                                    <p class="project-details__client">Projet en cours</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5 mb-lg-0">
                {{-- <div class="rounded-2">
                    <div class="project-details__top mt-5">
                        <div class="project-details__img"> <img class="rounded-0"
                                src="archinest/images/resource/project-details-1.jpg" alt=""> </div>
                    </div>
                </div> --}}
                <div class="">
                    <div class="project-details__top mt-5">
                        <div class="project-details__img"> <img class="rounded-0"
                                src="archinest/images/resource/project-details-2.jpg" alt=""> </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-lg-center">
                <div class="col-lg-6">
                    <div class="sec-title mb-40">
                        <h2 class="title mb-30 wow splt-txt" data-splitting="">
                            Contexte
                        </h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="project-details__top mt-lg-5">
                        <div class="text mb-40">
                            La Région des Savanes est confrontée à une forte charge du paludisme, à une mobilité
                            importante des populations et à un contexte sécuritaire complexe pouvant affecter la mise en
                            œuvre des interventions de santé publique. La ChimioPrévention Saisonnière du Paludisme
                            (CPS) constitue l'une des principales stratégies de prévention du paludisme chez les enfants
                            de moins de cinq ans.
                        </div>

                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-5 mb-lg-0">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="sec-title mb-40">
                        <h2 class="title mb-30 wow splt-txt" data-splitting="">Détails du projet</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="project-details__top mt-lg-5">
                        {{-- <div class="text mb-40">Will give you a complete account of the system, and expound the
                            actual
                            teachings of the great explorer of the truth, the master-builder of human happiness rejects,
                            dislikes, or avoids pleasure </div> --}}
                        <div class="project-list-item mb-5">
                            <h5 class="title">
                                <i class="icon fa-classic fa-solid fa-circle-check fa-fw mr-15"></i>
                                Objectif
                            </h5>
                            <div class="text">
                                Étudier la fidélité de mise en œuvre, la couverture, l'adhésion au traitement et les
                                adaptations du système de santé associées à la mise en œuvre de la CPS dans un contexte
                                marqué par l'insécurité et les mouvements transfrontaliers de populations.
                            </div>
                        </div>
                        <div class="project-list-item mb-5">
                            <h5 class="title"><i class="icon fa-classic fa-solid fa-circle-check fa-fw mr-15"></i>
                                Résultats attendus</h5>
                            <div class="text">
                                <ul>

                                    <li class="d-flex align-items-center"><i
                                            class="icon fa-classic fa-solid fa-check fa-fw"></i>Documentation des défis
                                        opérationnels de mise en œuvre ;</li>
                                    <li class="d-flex align-items-center"><i
                                            class="icon fa-classic fa-solid fa-check fa-fw"></i>Analyse des barrières
                                        et facilitateurs de l'adhésion à la CPS ;</li>
                                    <li class="d-flex align-items-center"><i
                                            class="icon fa-classic fa-solid fa-check fa-fw"></i>Identification des
                                        adaptations mises en place par le système de santé ;</li>
                                    <li class="d-flex align-items-center"><i
                                            class="icon fa-classic fa-solid fa-check fa-fw"></i>Production de
                                        recommandations opérationnelles pour améliorer l'efficacité et
                                        la
                                        résilience des programmes de prévention du paludisme.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="project-list-item">
                            <h5 class="title"><i
                                    class="icon fa-classic fa-solid fa-circle-check fa-fw mr-15"></i>Perspectives</h5>
                            <div class="text">
                                CARICS développe actuellement son portefeuille de projets de recherche et de
                                partenariats scientifiques dans plusieurs domaines prioritaires de santé publique au
                                Togo et en Afrique de l'Ouest.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Projet phare Section -->



</div>
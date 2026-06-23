<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts::archinest')] class extends Component {
    //
};
?>

<div>

    <!-- ============ HERO ============ -->
    {{-- <header class="hero-sm">
        <div class="container">
            <div class="breadcrumb-carics"><a href="index.html">Accueil</a><span class="sep">/</span>Actualités &amp;
                Opportunités</div>
            <h1 class="font-display">Actualités &amp; Opportunités</h1>
            <p class="lead">Nouvelles institutionnelles, agenda scientifique, offres d&rsquo;emploi, stages, bourses et
                partenariats.</p>
        </div>
    </header> --}}

       <!-- Start main-content -->
    <section class="page-title" style="background-image: url(images/banner.jpg);">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">Actualités &amp; Opportunités</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li>Actualités & Opportunités</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ============ TABS ============ -->
    <section class="section-sm pb-0" style="background:var(--white); border-bottom:1px solid var(--line);">
        {{-- <p class="lead">Nouvelles institutionnelles, agenda scientifique, offres d&rsquo;emploi, stages, bourses et
                partenariats.</p> --}}
        <div class="container">
            <ul class="nav nav-carics" id="actuTabs" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-actu"
                        role="tab">Actualités</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-emploi"
                        role="tab">Emplois &amp; Consultances</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-stage"
                        role="tab">Stages</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-bourses"
                        role="tab">Bourses</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-partenariat"
                        role="tab">Partenariats</button></li>
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
                        <div class="col-12">
                            <div class="project-highlight shadow-soft">
                                <div class="ph-head">
                                    <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                                        <span class="badge-status light">À la une</span>
                                        <span style="color:rgba(255,255,255,.65); font-size:.85rem;"><i
                                                class="bi bi-calendar3 me-1"></i>Juin 2026</span>
                                    </div>
                                    <h2 class="h4 mb-1">CARICS-Togo lance son premier projet de recherche financé à
                                        l&rsquo;international</h2>
                                    <p
                                        style="color:rgba(255,255,255,.82); font-size:.95rem; max-width:42rem; margin-bottom:0;">
                                        Avec le soutien de la Royal Society of Tropical Medicine and Hygiene (RSTMH),
                                        CARICS-Togo démarre un projet sur la mise en œuvre de la CPS dans la Région des
                                        Savanes.
                                    </p>
                                </div>
                                <div class="ph-body">
                                    <p class="mb-3">
                                        Ce projet marque une étape majeure pour CARICS-Togo, qui obtient son premier
                                        financement international quelques mois seulement après sa création. Il portera
                                        sur la fidélité de mise en œuvre, la couverture et l&rsquo;adhésion à la CPS
                                        dans
                                        un contexte transfrontalier complexe.
                                    </p>
                                    <a href="blog-projet.html" class="btn-cta-outline">Lire le projet complet <i
                                            class="bi bi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Actualité 2 -->
                        <div class="col-md-6">
                            <div class="card-soft h-100">
                                <div class="d-flex gap-2 mb-2">
                                    <span class="badge-status ongoing">Institutionnel</span>
                                    <span class="text-muted-2" style="font-size:.82rem;"><i
                                            class="bi bi-calendar3 me-1"></i>Mars 2026</span>
                                </div>
                                <h3 class="h5 mb-2">CARICS-Togo officiellement enregistré à Dapaong</h3>
                                <p class="text-muted-2 mb-3" style="font-size:.92rem;">
                                    Le Centre Africain d&rsquo;Action pour la Recherche et l&rsquo;Innovation
                                    Communautaire en Santé
                                    obtient son enregistrement officiel auprès des autorités togolaises compétentes.
                                </p>
                                <a href="blog-article.html" class="btn-cta-sm btn-cta-outline"
                                    style="display:inline-block;">Lire <i class="bi bi-arrow-right ms-1"></i></a>
                            </div>
                        </div>

                        <!-- Actualité 3 -->
                        <div class="col-md-6">
                            <div class="card-soft h-100">
                                <div class="d-flex gap-2 mb-2">
                                    <span class="badge-status upcoming">Bientôt</span>
                                    <span class="text-muted-2" style="font-size:.82rem;"><i
                                            class="bi bi-calendar3 me-1"></i>Septembre 2026</span>
                                </div>
                                <h3 class="h5 mb-2">Présentation des premiers résultats lors d&rsquo;un séminaire
                                    régional</h3>
                                <p class="text-muted-2 mb-3" style="font-size:.92rem;">
                                    L&rsquo;équipe CARICS prévoit de présenter les premières données terrain du projet
                                    CPS
                                    lors d&rsquo;un séminaire régional sur la santé communautaire en Afrique de
                                    l&rsquo;Ouest.
                                </p>
                                <span class="text-muted-2" style="font-size:.85rem;"><i
                                        class="bi bi-clock me-1"></i>Annonce à venir</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- TAB 2 : EMPLOIS -->
                <div class="tab-pane fade" id="tab-emploi" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="eyebrow mb-2">Emplois &amp; consultances</div>
                            <h2 class="section-title mb-3">Offres d&rsquo;emploi et de consultance</h2>
                            <div class="empty-state">
                                <span class="badge-status upcoming">Aucune offre actuellement</span>
                                <p class="mb-3" style="font-size:.95rem;">
                                    CARICS-Togo ne dispose d&rsquo;aucune offre d&rsquo;emploi ou de consultance ouverte
                                    en ce moment. Les prochaines opportunités seront annoncées sur cette page et dans
                                    notre newsletter.
                                </p>
                                <p class="text-muted-2 mb-4" style="font-size:.9rem;">
                                    Nous recrutons généralement des profils dans les domaines suivants&nbsp;:
                                    épidémiologistes, biostatisticiens, experts en suivi-évaluation, professionnels de
                                    santé publique, consultants techniques, coordonnateurs de projets et spécialistes
                                    en santé numérique.
                                </p>
                                <a href="newsletter.html" class="btn-cta-outline">S&rsquo;abonner à la newsletter pour
                                    être notifié</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3 : STAGES -->
                <div class="tab-pane fade" id="tab-stage" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="eyebrow mb-2">Stages &amp; mentorat</div>
                            <h2 class="section-title mb-3">Stages et mentorat</h2>
                            <div class="empty-state">
                                <span class="badge-status upcoming">Aucune offre actuellement</span>
                                <p class="mb-3" style="font-size:.95rem;">
                                    Aucune offre de stage n&rsquo;est actuellement disponible. CARICS-Togo accueille
                                    ponctuellement des étudiants et jeunes chercheurs dans les domaines de la
                                    santé publique, de l&rsquo;épidémiologie, de la gestion de projets et de la
                                    santé numérique.
                                </p>
                                <p class="text-muted-2 mb-4" style="font-size:.9rem;">
                                    Niveaux concernés&nbsp;: Master · Doctorat · Post-doctorat. Les candidatures
                                    spontanées sont acceptées.
                                </p>
                                <a href="contact.html#stage" class="btn-cta-outline">Envoyer une candidature
                                    spontanée</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 4 : BOURSES -->
                <div class="tab-pane fade" id="tab-bourses" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="eyebrow mb-2">Bourses &amp; formations</div>
                            <h2 class="section-title mb-3">Bourses et formations</h2>
                            <div class="empty-state">
                                <span class="badge-status upcoming">Aucune opportunité actuellement</span>
                                <p class="mb-3" style="font-size:.95rem;">
                                    Aucune bourse ou opportunité de formation n&rsquo;est actuellement disponible.
                                    CARICS-Togo publie dans cette section les fellowships, bourses d&rsquo;études et
                                    formations spécialisées pertinentes pour les chercheurs et professionnels de
                                    santé publique en Afrique.
                                </p>
                                <a href="newsletter.html" class="btn-cta-outline">S&rsquo;abonner à la newsletter</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 5 : PARTENARIATS -->
                <div class="tab-pane fade" id="tab-partenariat" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-7">
                            <div class="eyebrow mb-2">Partenariats</div>
                            <h2 class="section-title mb-3">Proposer un partenariat</h2>
                            <p>
                                CARICS-Togo est ouvert aux propositions de collaboration de la part de toute
                                institution ou organisation partageant son engagement pour une santé publique
                                fondée sur les données probantes. Nous collaborons notamment avec&nbsp;:
                            </p>
                            <ul class="mb-4">
                                <li>Universités et facultés de santé publique</li>
                                <li>Centres et instituts de recherche en santé</li>
                                <li>Ministères de la santé et agences nationales</li>
                                <li>Organisations non gouvernementales et associations</li>
                                <li>Agences de développement et partenaires techniques et financiers</li>
                                <li>Réseaux scientifiques régionaux et internationaux</li>
                                <li>Étudiants Master, Doctorat et Postdoc</li>
                            </ul>
                            <div class="eyebrow mb-3">Domaines de collaboration</div>
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <span class="tag-ghost">Recherche appliquée</span>
                                <span class="tag-ghost">Recherche opérationnelle</span>
                                <span class="tag-ghost">Sciences de la mise en œuvre</span>
                                <span class="tag-ghost">Évaluation de programmes</span>
                                <span class="tag-ghost">Analyses statistiques</span>
                                <span class="tag-ghost">Revues systématiques</span>
                                <span class="tag-ghost">Rédaction scientifique</span>
                                <span class="tag-ghost">Renforcement des capacités</span>
                                <span class="tag-ghost">Consortiums internationaux</span>
                            </div>
                            <a href="contact.html#collaboration" class="btn-cta">Soumettre une proposition <i
                                    class="bi bi-arrow-right ms-1"></i></a>
                        </div>

                        <div class="col-lg-5">
                            <div class="card-soft" style="background:var(--bg-alt);">
                                <div class="eyebrow mb-3">Partenaires actuels</div>
                                <div class="border rounded-3 py-4 text-center fw-bold mb-3"
                                    style="border-color:var(--line); color:var(--primary); background:var(--white);">
                                    <div style="font-size:1.1rem;">RSTMH</div>
                                    <div class="text-muted-2 mt-1" style="font-size:.82rem;">Royal Society of Tropical
                                        Medicine and Hygiene</div>
                                </div>
                                <p class="text-muted-2 mb-0" style="font-size:.88rem;">
                                    D&rsquo;autres partenariats institutionnels et scientifiques seront annoncés
                                    prochainement.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
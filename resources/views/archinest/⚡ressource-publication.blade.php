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
                <h1 class="title">Ressources & Publications</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home2') }}">Accueil</a></li>
                    <li>Ressources & Publications</li>
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
                        CARICS-Togo s&rsquo;engage à partager les connaissances produites dans le cadre de ses
                        activités de recherche et de ses projets. Cette section regroupe progressivement les
                        publications scientifiques, rapports techniques, notes de politique sanitaire et outils
                        pratiques destinés aux chercheurs, professionnels de santé, décideurs et acteurs
                        communautaires. Le centre étant récemment créé, plusieurs catégories seront alimentées au
                        fil de l&rsquo;avancement de nos projets&nbsp;: inscrivez-vous à la newsletter pour être informé
                        dès
                        leur publication.
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
                    <div class="eyebrow">Tableau 05 — Catégorie 01</div>
                    <h2 class="section-title mb-2" style="font-size:1.4rem;">Publications scientifiques</h2>
                    <p class="text-muted-2" style="font-size:.92rem;">
                        Articles scientifiques, publications en revue à comité de lecture et actes de conférences
                        issus de nos projets de recherche.
                    </p>
                </div>
                <div class="col-lg-8">
                    <div class="empty-state">
                        <span class="badge-status upcoming">Prochainement</span>
                        <p class="mb-2" style="font-size:.95rem;">Aucune publication disponible pour le moment. Les
                            contenus suivants seront ajoutés au fil de l&rsquo;avancement de nos projets de
                            recherche&nbsp;:</p>
                        <ul class="mb-0" style="font-size:.92rem; color:var(--muted);">
                            <li>Articles issus des projets de recherche en cours</li>
                            <li>Publications réalisées en collaboration avec des universités et instituts partenaires
                            </li>
                            <li>Communications présentées lors de conférences scientifiques</li>
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
                    <div class="eyebrow">Tableau 05 — Catégorie 02</div>
                    <h2 class="section-title mb-2" style="font-size:1.4rem;">Rapports techniques</h2>
                    <p class="text-muted-2" style="font-size:.92rem;">
                        Rapports de recherche, évaluations de programmes et documents méthodologiques produits dans
                        le cadre de nos projets.
                    </p>
                </div>
                <div class="col-lg-8">
                    <div class="empty-state" style="background:var(--white);">
                        <span class="badge-status upcoming">Prochainement</span>
                        <p class="mb-2" style="font-size:.95rem;">Cette catégorie accueillera progressivement&nbsp;:</p>
                        <ul class="mb-0" style="font-size:.92rem; color:var(--muted);">
                            <li>Rapports de recherche issus des projets en cours</li>
                            <li>Rapports d&rsquo;évaluation de programmes de santé</li>
                            <li>Rapports de suivi et d&rsquo;apprentissage</li>
                            <li>Documents méthodologiques</li>
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
                    <div class="eyebrow">Tableau 05 — Catégorie 03</div>
                    <h2 class="section-title mb-2" style="font-size:1.4rem;">Notes de politique sanitaire</h2>
                    <p class="text-muted-2" style="font-size:.92rem;">
                        Recommandations opérationnelles destinées aux décideurs, gestionnaires de programmes et
                        partenaires techniques et financiers.
                    </p>
                </div>
                <div class="col-lg-8">
                    <div class="empty-state">
                        <span class="badge-status upcoming">Prochainement</span>
                        <p class="mb-2" style="font-size:.95rem;">Ces documents traduiront nos résultats de recherche en
                            recommandations actionnables&nbsp;:</p>
                        <ul class="mb-0" style="font-size:.92rem; color:var(--muted);">
                            <li>Notes de politique sanitaire (policy briefs)</li>
                            <li>Notes stratégiques</li>
                            <li>Synthèses de résultats</li>
                            <li>Recommandations opérationnelles à destination des décideurs</li>
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
                    <div class="eyebrow">Tableau 05 — Catégorie 04</div>
                    <h2 class="section-title mb-2" style="font-size:1.4rem;">Outils et ressources pratiques</h2>
                    <p class="text-muted-2" style="font-size:.92rem;">
                        Ressources destinées aux chercheurs, professionnels de santé, gestionnaires de programmes
                        et acteurs communautaires.
                    </p>
                </div>
                <div class="col-lg-8">
                    <div class="empty-state" style="background:var(--white);">
                        <span class="badge-status upcoming">Prochainement</span>
                        <p class="mb-2" style="font-size:.95rem;">Cette section regroupera notamment&nbsp;:</p>
                        <ul class="mb-0" style="font-size:.92rem; color:var(--muted);">
                            <li>Protocoles de recherche</li>
                            <li>Guides méthodologiques</li>
                            <li>Outils de collecte de données</li>
                            <li>Supports de formation et boîtes à outils pour la mise en œuvre</li>
                            <li>Ressources pédagogiques</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Data\TeamData;

new #[Layout('layouts::archinest')] class extends Component {
    //
};
?>

<div>

    <!-- ============ HERO ============ -->
    {{-- <header class="hero-sm">
        <div class="container">
            <div class="breadcrumb-carics"><a href="index.html">Accueil</a><span class="sep">/</span>Contact</div>
            <h1 class="font-display">Contactez-nous</h1>
            <p class="lead">Notre équipe répond à toutes les demandes de collaboration, de partenariat ou
                d&rsquo;information dans les meilleurs délais.</p>
        </div>
    </header> --}}

     <section class="page-title" style="background-image: url(images/banner.jpg);">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">Contactez-nous</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li>Contactez-nous</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ============ FORMULAIRE GÉNÉRAL + COORDONNÉES ============ -->
    <section class="section">
        <div class="container">
            <div class="row g-4 g-lg-5">

                <!-- FORMULAIRE PRINCIPAL -->
                <div class="col-lg-7">
                    <div class="eyebrow">Formulaire de contact</div>
                    <h2 class="section-title mb-4">Envoyez-nous un message</h2>

                    <form class="form-carics needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nom">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom" placeholder="Votre nom" required>
                                <div class="invalid-feedback">Ce champ est obligatoire.</div>
                            </div>
                            <div class="col-sm-6">
                                <label for="prenom">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="prenom" placeholder="Votre prénom" required>
                                <div class="invalid-feedback">Ce champ est obligatoire.</div>
                            </div>
                            <div class="col-12">
                                <label for="email">Adresse email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" placeholder="votre@email.com"
                                    required>
                                <div class="invalid-feedback">Veuillez saisir une adresse email valide.</div>
                            </div>
                            <div class="col-12">
                                <label for="organisation">Organisation / Établissement</label>
                                <input type="text" class="form-control" id="organisation"
                                    placeholder="Votre institution ou organisation">
                            </div>
                            <div class="col-12">
                                <label for="objet">Objet de la demande <span class="text-danger">*</span></label>
                                <select class="form-select" id="objet" required>
                                    <option value="" selected disabled>Sélectionner un objet</option>
                                    <option value="collaboration">Collaboration scientifique</option>
                                    <option value="stage">Stage / Mentorat</option>
                                    <option value="partenariat">Partenariat institutionnel</option>
                                    <option value="information">Demande d'information générale</option>
                                    <option value="media">Demande média / Interview</option>
                                    <option value="autre">Autre</option>
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner un objet.</div>
                            </div>
                            <div class="col-12">
                                <label for="message">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message"
                                    placeholder="Décrivez l'objet de votre prise de contact..." required
                                    minlength="30"></textarea>
                                <div class="invalid-feedback">Votre message doit comporter au moins 30 caractères.</div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rgpd" required>
                                    <label class="form-check-label" for="rgpd"
                                        style="font-weight:400; font-size:.88rem; color:var(--muted);">
                                        J&rsquo;accepte que CARICS-Togo traite mes données personnelles dans le cadre
                                        de cette prise de contact, conformément à la
                                        <a href="#" class="text-accent">politique de confidentialité</a>. <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="invalid-feedback">Vous devez accepter la politique de confidentialité.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-cta w-100 border-0">Envoyer le message <i
                                        class="bi bi-arrow-right ms-1"></i></button>
                            </div>
                        </div>

                        <!-- Message de succès (caché par défaut) -->
                        <div class="form-success d-none mt-4 p-4 rounded-3"
                            style="background:var(--success-soft); border-left:3px solid var(--success);">
                            <div class="d-flex gap-3 align-items-start">
                                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                <div>
                                    <div class="fw-semibold mb-1" style="color:var(--success);">Message envoyé avec
                                        succès</div>
                                    <p class="mb-0" style="font-size:.92rem; color:var(--ink);">
                                        Votre message a bien été envoyé. L&rsquo;équipe CARICS-Togo vous répondra dans
                                        les meilleurs délais, généralement sous 3 à 5 jours ouvrables.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- COORDONNÉES -->
                <div class="col-lg-5">
                    <div class="eyebrow">Informations</div>
                    <h2 class="section-title mb-4">Nos coordonnées</h2>

                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="card-soft d-flex gap-3 align-items-start" style="padding:1.1rem 1.3rem;">
                            <div class="icon-tile flex-shrink-0"
                                style="width:38px;height:38px;font-size:1rem;margin-bottom:0;"><i
                                    class="fa fa-envelope"></i></div>
                            <div>
                                <div class="text-muted-2 mb-1"
                                    style="font-size:.78rem; font-family:var(--font-mono); letter-spacing:.08em; text-transform:uppercase;">
                                    Email</div>
                                <a href="mailto:contact@carics-togo.org" class="fw-semibold text-decoration-none"
                                    style="color:var(--ink);">contact@carics-togo.org</a>
                            </div>
                        </div>

                        <div class="card-soft d-flex gap-3 align-items-start" style="padding:1.1rem 1.3rem;">
                            <div class="icon-tile flex-shrink-0"
                                style="width:38px;height:38px;font-size:1rem;margin-bottom:0;"><i
                                    class="fa fa-phone"></i></div>
                            <div>
                                <div class="text-muted-2 mb-1"
                                    style="font-size:.78rem; font-family:var(--font-mono); letter-spacing:.08em; text-transform:uppercase;">
                                    Téléphone</div>
                                <div class="fw-semibold" style="color:var(--ink); line-height:1.8;">
                                    +228 90 99 18 59<br>
                                    +228 99 56 10 55<br>
                                    +228 91 37 21 34
                                </div>
                            </div>
                        </div>

                        <div class="card-soft d-flex gap-3 align-items-start" style="padding:1.1rem 1.3rem;">
                            <div class="icon-tile flex-shrink-0"
                                style="width:38px;height:38px;font-size:1rem;margin-bottom:0;"><i
                                    class="fa fa-map"></i></div>
                            <div>
                                <div class="text-muted-2 mb-1"
                                    style="font-size:.78rem; font-family:var(--font-mono); letter-spacing:.08em; text-transform:uppercase;">
                                    Adresse</div>
                                <address class="mb-0 fw-normal" style="color:var(--ink); font-style:normal;">
                                    Quartier Nassablée<br>
                                    Commune de Tône 1, Préfecture de Tône<br>
                                    Région des Savanes<br>
                                    <strong>République Togolaise</strong>
                                </address>
                            </div>
                        </div>
                    </div>

                    <!-- Carte placeholder -->
                    <div class="map-frame mb-4">
                        <div class="text-center">
                            <i class="fa fa-map-location display-5 d-block mb-2" style="color:var(--accent);"></i>
                            <div class="fw-semibold mb-1" style="color:var(--ink);">Dapaong, Région des Savanes</div>
                            <div class="text-muted-2" style="font-size:.85rem;">Quartier Nassablée, Commune de Tône 1
                            </div>
                            <a href="https://www.openstreetmap.org/?mlat=10.8706&mlon=0.2013&zoom=14" target="_blank"
                                rel="noopener" class="btn-cta-outline btn-cta-sm mt-3 d-inline-block">
                                <i class="bi bi-box-arrow-up-right me-1"></i>Ouvrir dans OpenStreetMap
                            </a>
                        </div>
                    </div>

                    <!-- Réseaux sociaux -->
                    {{-- <div class="card-soft" style="background:var(--bg-alt);">
                        <div class="text-muted-2 mb-2"
                            style="font-size:.78rem; font-family:var(--font-mono); letter-spacing:.08em; text-transform:uppercase;">
                            Suivez-nous</div>
                        <div class="d-flex gap-2">
                            <a href="#" class="share-btn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="share-btn" title="X / Twitter"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="share-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="share-btn" title="YouTube"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>
    </section>

    <!-- ============ FORMULAIRES SPÉCIALISÉS ============ -->
    <section class="section bg-bg-alt">
        <div class="container">
            <div class="eyebrow">Formulaires spécialisés</div>
            <h2 class="section-title mb-4">Demandes spécifiques</h2>
            <div class="row g-4">

                <!-- Collaboration -->
                <div class="col-lg-4" id="collaboration">
                    <div class="card-soft h-100">
                        <div class="icon-tile mb-3"><i class="fa fa-diagram-lean-canvas"></i></div>
                        <h3 class="h5 mb-2">Proposer une collaboration</h3>
                        <p class="text-muted-2 mb-4" style="font-size:.92rem;">
                            Vous souhaitez initier un projet collaboratif, rejoindre un consortium ou proposer
                            une co-supervision&nbsp;? Décrivez votre projet et joignez une note conceptuelle.
                        </p>
                        <form class="form-carics needs-validation" novalidate>
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <label for="c-nom">Nom et prénom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c-nom" required>
                                </div>
                                <div>
                                    <label for="c-institution">Institution <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c-institution" required>
                                </div>
                                <div>
                                    <label for="c-domaine">Domaine d&rsquo;expertise <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c-domaine" required>
                                </div>
                                <div>
                                    <label for="c-projet">Description du projet <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="c-projet" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn-cta border-0">Soumettre <i
                                        class="bi bi-arrow-right ms-1"></i></button>
                            </div>
                            <div class="form-success d-none mt-3 p-3 rounded-2" style="background:var(--success-soft);">
                                <i class="fa fa-check-circle text-success me-2"></i>Proposition envoyée avec
                                succès&nbsp;!
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Stage -->
                <div class="col-lg-4" id="stage">
                    <div class="card-soft h-100">
                        <div class="icon-tile mb-3"><i class="fa fa-mortar-board"></i></div>
                        <h3 class="h5 mb-2">Candidature stage / Mentorat</h3>
                        <p class="text-muted-2 mb-4" style="font-size:.92rem;">
                            Étudiant en Master, Doctorat ou Postdoc souhaitant effectuer un stage ou bénéficier
                            d&rsquo;un mentorat scientifique&nbsp;? Soumettez votre candidature spontanée.
                        </p>
                        <form class="form-carics needs-validation" novalidate>
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <label for="s-nom">Nom et prénom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="s-nom" required>
                                </div>
                                <div>
                                    <label for="s-universite">Université / École <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="s-universite" required>
                                </div>
                                <div>
                                    <label for="s-niveau">Niveau d&rsquo;études <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="s-niveau" required>
                                        <option value="" selected disabled>Sélectionner</option>
                                        <option>Master</option>
                                        <option>Doctorat</option>
                                        <option>Post-doctorat</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="s-domaine">Domaine de recherche <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="s-domaine" required>
                                </div>
                                <button type="submit" class="btn-cta border-0">Envoyer ma candidature <i
                                        class="fa fa-arrow-right ms-1"></i></button>
                            </div>
                            <div class="form-success d-none mt-3 p-3 rounded-2" style="background:var(--success-soft);">
                                <i class="fa fa-check-circle text-success me-2"></i>Candidature envoyée avec
                                succès&nbsp;!
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Médias -->
                <div class="col-lg-4" id="media">
                    <div class="card-soft h-100">
                        <div class="icon-tile mb-3"><i class="fa fa-camcorder"></i></div>
                        <h3 class="h5 mb-2">Demande média / Interview</h3>
                        <p class="text-muted-2 mb-4" style="font-size:.92rem;">
                            Journaliste, documentariste ou communicant souhaitant interviewer un expert de
                            CARICS-Togo&nbsp;? Envoyez votre demande en précisant le sujet et la date souhaitée.
                        </p>
                        <form class="form-carics needs-validation" novalidate>
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <label for="m-nom">Nom et prénom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="m-nom" required>
                                </div>
                                <div>
                                    <label for="m-media">Média / Organisation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="m-media" required>
                                </div>
                                <div>
                                    <label for="m-sujet">Sujet de l&rsquo;interview <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="m-sujet" required>
                                </div>
                                <div>
                                    <label for="m-date">Date souhaitée</label>
                                    <input type="date" class="form-control" id="m-date">
                                </div>
                                <div>
                                    <label for="m-contact">Email de contact <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="m-contact" required>
                                </div>
                                <button type="submit" class="btn-cta border-0">Envoyer la demande <i
                                        class="fa fa-arrow-right ms-1"></i></button>
                            </div>
                            <div class="form-success d-none mt-3 p-3 rounded-2" style="background:var(--success-soft);">
                                <i class="fa fa-check-circle text-success me-2"></i>Demande envoyée avec
                                succès&nbsp;!
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="eyebrow">FAQ</div>
                    <h2 class="section-title mb-4">Questions fréquentes</h2>
                    <div class="accordion accordion-carics" id="faqAccordion" wire:ignore
                        x-data="{ open: 'faq1' }">

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" :class="open !== 'faq1' ? 'collapsed' : ''"
                                    type="button" @click="open = open === 'faq1' ? null : 'faq1'">
                                    CARICS-Togo est-il ouvert aux collaborations avec des institutions hors du
                                    Togo&nbsp;?
                                </button>
                            </h3>
                            <div class="accordion-collapse" x-show="open === 'faq1'" x-collapse>
                                <div class="accordion-body text-muted-2" style="font-size:.95rem;">
                                    Oui, tout à fait. CARICS-Togo a une vocation régionale et internationale. Nous
                                    sommes ouverts aux collaborations avec des universités, instituts de recherche,
                                    ONG et agences de développement du monde entier, en particulier d&rsquo;Afrique de
                                    l&rsquo;Ouest et francophone.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" :class="open !== 'faq2' ? 'collapsed' : ''"
                                    type="button" @click="open = open === 'faq2' ? null : 'faq2'">
                                    Comment soumettre une proposition de projet commun&nbsp;?
                                </button>
                            </h3>
                            <div class="accordion-collapse" x-show="open === 'faq2'" x-collapse>
                                <div class="accordion-body text-muted-2" style="font-size:.95rem;">
                                    Utilisez le formulaire « Proposer une collaboration » sur cette page en décrivant
                                    votre projet et en joignant si possible une note conceptuelle (2–5 pages).
                                    L&rsquo;équipe vous répondra sous 5 jours ouvrables.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" :class="open !== 'faq3' ? 'collapsed' : ''"
                                    type="button" @click="open = open === 'faq3' ? null : 'faq3'">
                                    Acceptez-vous des étudiants en stage de courte durée&nbsp;?
                                </button>
                            </h3>
                            <div class="accordion-collapse" x-show="open === 'faq3'" x-collapse>
                                <div class="accordion-body text-muted-2" style="font-size:.95rem;">
                                    Oui, selon les capacités d&rsquo;encadrement disponibles. Les stages de minimum
                                    3 mois sont préférés. Envoyez votre candidature spontanée via le formulaire
                                    dédié sur cette page.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" :class="open !== 'faq4' ? 'collapsed' : ''"
                                    type="button" @click="open = open === 'faq4' ? null : 'faq4'">
                                    Puis-je utiliser les données et publications de CARICS-Togo dans mes
                                    recherches&nbsp;?
                                </button>
                            </h3>
                            <div class="accordion-collapse" x-show="open === 'faq4'" x-collapse>
                                <div class="accordion-body text-muted-2" style="font-size:.95rem;">
                                    Oui, les ressources publiées sur le site sont accessibles librement dans le
                                    respect de leurs licences respectives. Pour des demandes spécifiques d&rsquo;accès
                                    à des données ou protocoles non encore publiés, contactez-nous directement.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
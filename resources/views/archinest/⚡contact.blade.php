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
            <div class="breadcrumb-carics"><a href="index.html">Accueil</a><span class="sep">/</span>Contact</div>
            <h1 class="font-display">Contactez-nous</h1>
            <p class="lead">Notre équipe répond à toutes les demandes de collaboration, de partenariat ou
                d&rsquo;information dans les meilleurs délais.</p>
        </div>
    </header> --}}

     <section class="page-title" style="background-image: url({{ asset('images/banner.jpg') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">{{ __('contact.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">{{ __('navigation.menu.home') }}</a></li>
                    <li>{{ __('contact.title') }}</li>
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
                    <div class="eyebrow">{{ __('contact.form.eyebrow') }}</div>
                    <h2 class="section-title mb-4">{{ __('contact.form.title') }}</h2>

                    <form class="form-carics needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nom">{{ __('contact.form.last_name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom" placeholder="{{ __('contact.form.last_name_placeholder') }}" required>
                                <div class="invalid-feedback">{{ __('contact.form.required_field') }}</div>
                            </div>
                            <div class="col-sm-6">
                                <label for="prenom">{{ __('contact.form.first_name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="prenom" placeholder="{{ __('contact.form.first_name_placeholder') }}" required>
                                <div class="invalid-feedback">{{ __('contact.form.required_field') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="email">{{ __('contact.form.email') }} <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" placeholder="{{ __('contact.form.email_placeholder') }}"
                                    required>
                                <div class="invalid-feedback">{{ __('contact.form.invalid_email') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="organisation">{{ __('contact.form.organization') }}</label>
                                <input type="text" class="form-control" id="organisation"
                                    placeholder="{{ __('contact.form.organization_placeholder') }}">
                            </div>
                            <div class="col-12">
                                <label for="objet">{{ __('contact.form.subject') }} <span class="text-danger">*</span></label>
                                <select class="form-select" id="objet" required>
                                    <option value="" selected disabled>{{ __('contact.form.select_subject') }}</option>
                                    <option value="collaboration">{{ __('contact.form.subjects.collaboration') }}</option>
                                    <option value="stage">{{ __('contact.form.subjects.internship') }}</option>
                                    <option value="partenariat">{{ __('contact.form.subjects.partnership') }}</option>
                                    <option value="information">{{ __('contact.form.subjects.information') }}</option>
                                    <option value="media">{{ __('contact.form.subjects.media') }}</option>
                                    <option value="autre">{{ __('contact.form.subjects.other') }}</option>
                                </select>
                                <div class="invalid-feedback">{{ __('contact.form.required_field') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="message">{{ __('contact.form.message') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message"
                                    placeholder="{{ __('contact.form.message_placeholder') }}" required
                                    minlength="30"></textarea>
                                <div class="invalid-feedback">{{ __('contact.form.invalid_message') }}</div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rgpd" required>
                                    <label class="form-check-label" for="rgpd"
                                        style="font-weight:400; font-size:.88rem; color:var(--muted);">
                                        {{ __('contact.form.privacy_agree') }}
                                        <a href="#" class="text-accent">{{ __('contact.form.privacy_link') }}</a>. <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="invalid-feedback">{{ __('contact.form.privacy_required') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-cta w-100 border-0">{{ __('contact.form.send_btn') }} <i
                                        class="bi bi-arrow-right ms-1"></i></button>
                            </div>
                        </div>

                        <!-- Message de succès (caché par défaut) -->
                        <div class="form-success d-none mt-4 p-4 rounded-3"
                            style="background:var(--success-soft); border-left:3px solid var(--success);">
                            <div class="d-flex gap-3 align-items-start">
                                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                <div>
                                    <div class="fw-semibold mb-1" style="color:var(--success);">{{ __('contact.form.success_title') }}</div>
                                    <p class="mb-0" style="font-size:.92rem; color:var(--ink);">
                                        {{ __('contact.form.success_text') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- COORDONNÉES -->
                <div class="col-lg-5">
                    <div class="eyebrow">{{ __('contact.info.eyebrow') }}</div>
                    <h2 class="section-title mb-4">{{ __('contact.info.title') }}</h2>

                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="card-soft d-flex gap-3 align-items-start" style="padding:1.1rem 1.3rem;">
                            <div class="icon-tile flex-shrink-0"
                                style="width:38px;height:38px;font-size:1rem;margin-bottom:0;"><i
                                    class="fa fa-envelope"></i></div>
                            <div>
                                <div class="text-muted-2 mb-1"
                                    style="font-size:.78rem; font-family:var(--font-mono); letter-spacing:.08em; text-transform:uppercase;">
                                    {{ __('contact.info.email_label') }}</div>
                                <a href="mailto:info@carics.org" class="fw-semibold text-decoration-none"
                                    style="color:var(--ink);">info@carics.org</a>
                            </div>
                        </div>

                        <div class="card-soft d-flex gap-3 align-items-start" style="padding:1.1rem 1.3rem;">
                            <div class="icon-tile flex-shrink-0"
                                style="width:38px;height:38px;font-size:1rem;margin-bottom:0;"><i
                                    class="fa fa-phone"></i></div>
                            <div>
                                <div class="text-muted-2 mb-1"
                                    style="font-size:.78rem; font-family:var(--font-mono); letter-spacing:.08em; text-transform:uppercase;">
                                    {{ __('contact.info.phone_label') }}</div>
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
                                    {{ __('contact.info.address_label') }}</div>
                                <address class="mb-0 fw-normal" style="color:var(--ink); font-style:normal;">
                                    {!! __('contact.info.address_value') !!}
                                </address>
                            </div>
                        </div>
                    </div>

                    <!-- Carte placeholder -->
                    <div class="map-frame mb-4">
                        <div class="text-center">
                            <i class="fa fa-map-location display-5 d-block mb-2" style="color:var(--accent);"></i>
                            <div class="fw-semibold mb-1" style="color:var(--ink);">{{ __('contact.info.location_title') }}</div>
                            <div class="text-muted-2" style="font-size:.85rem;">{{ __('contact.info.location_subtitle') }}
                            </div>
                            <a href="https://www.openstreetmap.org/?mlat=10.8706&mlon=0.2013&zoom=14" target="_blank"
                                rel="noopener" class="btn-cta-outline btn-cta-sm mt-3 d-inline-block">
                                <i class="bi bi-box-arrow-up-right me-1"></i>{{ __('contact.info.open_in_osm') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============ FORMULAIRES SPÉCIALISÉS ============ -->
    <section class="section bg-bg-alt">
        <div class="container">
            <div class="eyebrow">{{ __('contact.specialized.eyebrow') }}</div>
            <h2 class="section-title mb-4">{{ __('contact.specialized.title') }}</h2>
            <div class="row g-4">

                <!-- Collaboration -->
                <div class="col-lg-4" id="collaboration">
                    <div class="card-soft h-100">
                        <div class="icon-tile mb-3"><i class="fa fa-diagram-lean-canvas"></i></div>
                        <h3 class="h5 mb-2">{{ __('contact.specialized.collaboration.title') }}</h3>
                        <p class="text-muted-2 mb-4" style="font-size:.92rem;">
                            {{ __('contact.specialized.collaboration.desc') }}
                        </p>
                        <form class="form-carics needs-validation" novalidate>
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <label for="c-nom">{{ __('contact.specialized.collaboration.fullname') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c-nom" required>
                                </div>
                                <div>
                                    <label for="c-institution">{{ __('contact.specialized.collaboration.institution') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c-institution" required>
                                </div>
                                <div>
                                    <label for="c-domaine">{{ __('contact.specialized.collaboration.domain') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c-domaine" required>
                                </div>
                                <div>
                                    <label for="c-projet">{{ __('contact.specialized.collaboration.project_desc') }} <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="c-projet" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn-cta border-0">{{ __('contact.specialized.collaboration.submit') }} <i
                                        class="bi bi-arrow-right ms-1"></i></button>
                            </div>
                            <div class="form-success d-none mt-3 p-3 rounded-2" style="background:var(--success-soft);">
                                <i class="fa fa-check-circle text-success me-2"></i>{{ __('contact.specialized.collaboration.success') }}
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Stage -->
                <div class="col-lg-4" id="stage">
                    <div class="card-soft h-100">
                        <div class="icon-tile mb-3"><i class="fa fa-mortar-board"></i></div>
                        <h3 class="h5 mb-2">{{ __('contact.specialized.stage.title') }}</h3>
                        <p class="text-muted-2 mb-4" style="font-size:.92rem;">
                            {{ __('contact.specialized.stage.desc') }}
                        </p>
                        <form class="form-carics needs-validation" novalidate>
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <label for="s-nom">{{ __('contact.specialized.stage.fullname') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="s-nom" required>
                                </div>
                                <div>
                                    <label for="s-universite">{{ __('contact.specialized.stage.university') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="s-universite" required>
                                </div>
                                <div>
                                    <label for="s-niveau">{{ __('contact.specialized.stage.level') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="s-niveau" required>
                                        <option value="" selected disabled>{{ __('contact.specialized.stage.select_level') }}</option>
                                        <option>{{ __('contact.specialized.stage.levels.master') }}</option>
                                        <option>{{ __('contact.specialized.stage.levels.doctorate') }}</option>
                                        <option>{{ __('contact.specialized.stage.levels.postdoc') }}</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="s-domaine">{{ __('contact.specialized.stage.domain') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="s-domaine" required>
                                </div>
                                <button type="submit" class="btn-cta border-0">{{ __('contact.specialized.stage.submit') }} <i
                                        class="fa fa-arrow-right ms-1"></i></button>
                            </div>
                            <div class="form-success d-none mt-3 p-3 rounded-2" style="background:var(--success-soft);">
                                <i class="fa fa-check-circle text-success me-2"></i>{{ __('contact.specialized.stage.success') }}
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Médias -->
                <div class="col-lg-4" id="media">
                    <div class="card-soft h-100">
                        <div class="icon-tile mb-3"><i class="fa fa-camcorder"></i></div>
                        <h3 class="h5 mb-2">{{ __('contact.specialized.media.title') }}</h3>
                        <p class="text-muted-2 mb-4" style="font-size:.92rem;">
                            {{ __('contact.specialized.media.desc') }}
                        </p>
                        <form class="form-carics needs-validation" novalidate>
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <label for="m-nom">{{ __('contact.specialized.media.fullname') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="m-nom" required>
                                </div>
                                <div>
                                    <label for="m-media">{{ __('contact.specialized.media.organization') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="m-media" required>
                                </div>
                                <div>
                                    <label for="m-sujet">{{ __('contact.specialized.media.subject') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="m-sujet" required>
                                </div>
                                <div>
                                    <label for="m-date">{{ __('contact.specialized.media.date') }}</label>
                                    <input type="date" class="form-control" id="m-date">
                                </div>
                                <div>
                                    <label for="m-contact">{{ __('contact.specialized.media.email') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="m-contact" required>
                                </div>
                                <button type="submit" class="btn-cta border-0">{{ __('contact.specialized.media.submit') }} <i
                                        class="fa fa-arrow-right ms-1"></i></button>
                            </div>
                            <div class="form-success d-none mt-3 p-3 rounded-2" style="background:var(--success-soft);">
                                <i class="fa fa-check-circle text-success me-2"></i>{{ __('contact.specialized.media.success') }}
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
                    <div class="eyebrow">{{ __('contact.faq.eyebrow') }}</div>
                    <h2 class="section-title mb-4">{{ __('contact.faq.title') }}</h2>
                    <div class="accordion accordion-carics" id="faqAccordion" wire:ignore
                        x-data="{ open: 'faq1' }">

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" :class="open !== 'faq1' ? 'collapsed' : ''"
                                    type="button" @click="open = open === 'faq1' ? null : 'faq1'">
                                    {{ __('contact.faq.q1') }}
                                </button>
                            </h3>
                            <div class="accordion-collapse" x-show="open === 'faq1'" x-collapse>
                                <div class="accordion-body text-muted-2" style="font-size:.95rem;">
                                    {{ __('contact.faq.a1') }}
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" :class="open !== 'faq2' ? 'collapsed' : ''"
                                    type="button" @click="open = open === 'faq2' ? null : 'faq2'">
                                    {{ __('contact.faq.q2') }}
                                </button>
                            </h3>
                            <div class="accordion-collapse" x-show="open === 'faq2'" x-collapse>
                                <div class="accordion-body text-muted-2" style="font-size:.95rem;">
                                    {{ __('contact.faq.a2') }}
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" :class="open !== 'faq3' ? 'collapsed' : ''"
                                    type="button" @click="open = open === 'faq3' ? null : 'faq3'">
                                    {{ __('contact.faq.q3') }}
                                </button>
                            </h3>
                            <div class="accordion-collapse" x-show="open === 'faq3'" x-collapse>
                                <div class="accordion-body text-muted-2" style="font-size:.95rem;">
                                    {{ __('contact.faq.a3') }}
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" :class="open !== 'faq4' ? 'collapsed' : ''"
                                    type="button" @click="open = open === 'faq4' ? null : 'faq4'">
                                    {{ __('contact.faq.q4') }}
                                </button>
                            </h3>
                            <div class="accordion-collapse" x-show="open === 'faq4'" x-collapse>
                                <div class="accordion-body text-muted-2" style="font-size:.95rem;">
                                    {{ __('contact.faq.a4') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
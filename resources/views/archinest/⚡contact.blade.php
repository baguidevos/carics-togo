<?php

use App\Models\ContactSubmission;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    // Formulaire Général
    public string $nom = '';
    public string $prenom = '';
    public string $email = '';
    public string $organisation = '';
    public string $objet = '';
    public string $message = '';
    public bool $rgpd = false;
    public bool $successGeneral = false;

    // Formulaire Spécialisé : Collaboration
    public string $c_nom = '';
    public string $c_institution = '';
    public string $c_domaine = '';
    public string $c_projet = '';
    public bool $successCollaboration = false;

    // Formulaire Spécialisé : Stage
    public string $s_nom = '';
    public string $s_universite = '';
    public string $s_niveau = '';
    public string $s_domaine = '';
    public bool $successStage = false;

    // Formulaire Spécialisé : Médias
    public string $m_nom = '';
    public string $m_media = '';
    public string $m_sujet = '';
    public string $m_date = '';
    public string $m_contact = '';
    public bool $successMedia = false;

    public function submitGeneral(): void
    {
        $this->validate([
            'nom'          => 'required|string|min:2|max:100',
            'prenom'       => 'required|string|min:2|max:100',
            'email'        => 'required|email|max:150',
            'organisation' => 'nullable|string|max:150',
            'objet'        => 'required|string|max:100',
            'message'      => 'required|string|min:10|max:5000',
            'rgpd'         => 'accepted',
        ]);

        ContactSubmission::create([
            'form_type'    => 'general',
            'full_name'    => trim("{$this->prenom} {$this->nom}"),
            'email'        => $this->email,
            'organisation' => $this->organisation ?: null,
            'subject'      => $this->objet,
            'message'      => $this->message,
            'meta'         => ['source' => 'web_contact_general'],
            'is_read'      => false,
            'is_archived'  => false,
        ]);

        $this->reset(['nom', 'prenom', 'email', 'organisation', 'objet', 'message', 'rgpd']);
        $this->successGeneral = true;
    }

    public function submitCollaboration(): void
    {
        $this->validate([
            'c_nom'         => 'required|string|min:2|max:150',
            'c_institution' => 'required|string|min:2|max:150',
            'c_domaine'     => 'required|string|min:2|max:150',
            'c_projet'      => 'required|string|min:10|max:5000',
        ]);

        ContactSubmission::create([
            'form_type'    => 'collaboration',
            'full_name'    => $this->c_nom,
            'email'        => 'contact@carics-togo.org', // Email par défaut si non renseigné
            'organisation' => $this->c_institution,
            'subject'      => "Demande de Collaboration : {$this->c_domaine}",
            'message'      => $this->c_projet,
            'meta'         => [
                'institution' => $this->c_institution,
                'domaine'     => $this->c_domaine,
            ],
            'is_read'      => false,
            'is_archived'  => false,
        ]);

        $this->reset(['c_nom', 'c_institution', 'c_domaine', 'c_projet']);
        $this->successCollaboration = true;
    }

    public function submitStage(): void
    {
        $this->validate([
            's_nom'        => 'required|string|min:2|max:150',
            's_universite' => 'required|string|min:2|max:150',
            's_niveau'     => 'required|string|max:50',
            's_domaine'    => 'required|string|min:2|max:150',
        ]);

        ContactSubmission::create([
            'form_type'    => 'stage',
            'full_name'    => $this->s_nom,
            'email'        => 'contact@carics-togo.org',
            'organisation' => $this->s_universite,
            'subject'      => "Candidature Stage ({$this->s_niveau}) : {$this->s_domaine}",
            'message'      => "Candidature pour un stage / accueil scientifique.\nUniversité : {$this->s_universite}\nNiveau : {$this->s_niveau}\nDomaine : {$this->s_domaine}",
            'meta'         => [
                'universite' => $this->s_universite,
                'niveau'     => $this->s_niveau,
                'domaine'    => $this->s_domaine,
            ],
            'is_read'      => false,
            'is_archived'  => false,
        ]);

        $this->reset(['s_nom', 's_universite', 's_niveau', 's_domaine']);
        $this->successStage = true;
    }

    public function submitMedia(): void
    {
        $this->validate([
            'm_nom'     => 'required|string|min:2|max:150',
            'm_media'   => 'required|string|min:2|max:150',
            'm_sujet'   => 'required|string|min:2|max:200',
            'm_date'    => 'nullable|date',
            'm_contact' => 'required|email|max:150',
        ]);

        ContactSubmission::create([
            'form_type'    => 'media',
            'full_name'    => $this->m_nom,
            'email'        => $this->m_contact,
            'organisation' => $this->m_media,
            'subject'      => "Demande Média / Presse : {$this->m_sujet}",
            'message'      => "Demande d'interview ou de reportage.\nMédia : {$this->m_media}\nSujet : {$this->m_sujet}\nDate souhaitée : {$this->m_date}",
            'meta'         => [
                'media'          => $this->m_media,
                'date_souhaitee' => $this->m_date,
            ],
            'is_read'      => false,
            'is_archived'  => false,
        ]);

        $this->reset(['m_nom', 'm_media', 'm_sujet', 'm_date', 'm_contact']);
        $this->successMedia = true;
    }
};
?>

<div>

    <!-- Start main-content -->
    <x-archinest.page-title page="contact" :title="__('contact.title')" defaultImage="images/contact.webp" />

    <!-- ============ FORMULAIRE GÉNÉRAL + COORDONNÉES ============ -->
    <section class="section">
        <div class="container">
            <div class="row g-4 g-lg-5">

                <!-- FORMULAIRE PRINCIPAL -->
                <div class="col-lg-7">
                    <div class="eyebrow">{{ __('contact.form.eyebrow') }}</div>
                    <h2 class="section-title mb-4">{{ __('contact.form.title') }}</h2>

                    @if ($successGeneral)
                        <div class="form-success mb-4 p-4 rounded-3"
                            style="background:var(--success-soft); border-left:4px solid var(--success);">
                            <div class="d-flex gap-3 align-items-start">
                                <i class="bi bi-check-circle-fill text-success mt-1 fs-5"></i>
                                <div>
                                    <div class="fw-semibold mb-1" style="color:var(--success);">{{ __('contact.form.success_title') }}</div>
                                    <p class="mb-0" style="font-size:.92rem; color:var(--ink);">
                                        {{ __('contact.form.success_text') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form wire:submit="submitGeneral" class="form-carics">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nom">{{ __('contact.form.last_name') }} <span class="text-danger">*</span></label>
                                <input type="text" wire:model="nom" class="form-control @error('nom') is-invalid @enderror" id="nom" placeholder="{{ __('contact.form.last_name_placeholder') }}">
                                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="prenom">{{ __('contact.form.first_name') }} <span class="text-danger">*</span></label>
                                <input type="text" wire:model="prenom" class="form-control @error('prenom') is-invalid @enderror" id="prenom" placeholder="{{ __('contact.form.first_name_placeholder') }}">
                                @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="email">{{ __('contact.form.email') }} <span class="text-danger">*</span></label>
                                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{ __('contact.form.email_placeholder') }}">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="organisation">{{ __('contact.form.organization') }}</label>
                                <input type="text" wire:model="organisation" class="form-control @error('organisation') is-invalid @enderror" id="organisation"
                                    placeholder="{{ __('contact.form.organization_placeholder') }}">
                                @error('organisation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="objet">{{ __('contact.form.subject') }} <span class="text-danger">*</span></label>
                                <select wire:model="objet" class="form-select @error('objet') is-invalid @enderror" id="objet">
                                    <option value="" selected>{{ __('contact.form.select_subject') }}</option>
                                    <option value="collaboration">{{ __('contact.form.subjects.collaboration') }}</option>
                                    <option value="stage">{{ __('contact.form.subjects.internship') }}</option>
                                    <option value="partenariat">{{ __('contact.form.subjects.partnership') }}</option>
                                    <option value="information">{{ __('contact.form.subjects.information') }}</option>
                                    <option value="media">{{ __('contact.form.subjects.media') }}</option>
                                    <option value="autre">{{ __('contact.form.subjects.other') }}</option>
                                </select>
                                @error('objet') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="message">{{ __('contact.form.message') }} <span class="text-danger">*</span></label>
                                <textarea wire:model="message" class="form-control @error('message') is-invalid @enderror" id="message"
                                    placeholder="{{ __('contact.form.message_placeholder') }}" rows="4"></textarea>
                                @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" wire:model="rgpd" class="form-check-input @error('rgpd') is-invalid @enderror" id="rgpd">
                                    <label class="form-check-label" for="rgpd"
                                        style="font-weight:400; font-size:.88rem; color:var(--muted);">
                                        {{ __('contact.form.privacy_agree') }}
                                        <a href="#" class="text-accent">{{ __('contact.form.privacy_link') }}</a>. <span
                                            class="text-danger">*</span>
                                    </label>
                                    @error('rgpd') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-cta w-100 border-0" wire:loading.attr="disabled">
                                    <span wire:loading.remove>{{ __('contact.form.send_btn') }} <i class="bi bi-arrow-right ms-1"></i></span>
                                    <span wire:loading><i class="fa fa-spinner fa-spin me-2"></i>{{ __('contact.form.sending') }}</span>
                                </button>
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

                    <!-- Carte -->
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

                        @if ($successCollaboration)
                            <div class="form-success mb-3 p-3 rounded-2" style="background:var(--success-soft); color:var(--success);">
                                <i class="fa fa-check-circle me-2"></i>{{ __('contact.specialized.collaboration.success') }}
                            </div>
                        @endif

                        <form wire:submit="submitCollaboration" class="form-carics">
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <label for="c-nom">{{ __('contact.specialized.collaboration.fullname') }} <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="c_nom" class="form-control @error('c_nom') is-invalid @enderror" id="c-nom">
                                    @error('c_nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="c-institution">{{ __('contact.specialized.collaboration.institution') }} <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="c_institution" class="form-control @error('c_institution') is-invalid @enderror" id="c-institution">
                                    @error('c_institution') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="c-domaine">{{ __('contact.specialized.collaboration.domain') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model="c_domaine" class="form-control @error('c_domaine') is-invalid @enderror" id="c-domaine">
                                    @error('c_domaine') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="c-projet">{{ __('contact.specialized.collaboration.project_desc') }} <span
                                            class="text-danger">*</span></label>
                                    <textarea wire:model="c_projet" class="form-control @error('c_projet') is-invalid @enderror" id="c-projet" rows="3"></textarea>
                                    @error('c_projet') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="btn-cta border-0" wire:loading.attr="disabled">
                                    <span wire:loading.remove>{{ __('contact.specialized.collaboration.submit') }} <i class="bi bi-arrow-right ms-1"></i></span>
                                    <span wire:loading><i class="fa fa-spinner fa-spin me-2"></i>{{ __('contact.specialized.sending') }}</span>
                                </button>
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

                        @if ($successStage)
                            <div class="form-success mb-3 p-3 rounded-2" style="background:var(--success-soft); color:var(--success);">
                                <i class="fa fa-check-circle me-2"></i>{{ __('contact.specialized.stage.success') }}
                            </div>
                        @endif

                        <form wire:submit="submitStage" class="form-carics">
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <label for="s-nom">{{ __('contact.specialized.stage.fullname') }} <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="s_nom" class="form-control @error('s_nom') is-invalid @enderror" id="s-nom">
                                    @error('s_nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="s-universite">{{ __('contact.specialized.stage.university') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model="s_universite" class="form-control @error('s_universite') is-invalid @enderror" id="s-universite">
                                    @error('s_universite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="s-niveau">{{ __('contact.specialized.stage.level') }} <span
                                            class="text-danger">*</span></label>
                                    <select wire:model="s_niveau" class="form-select @error('s_niveau') is-invalid @enderror" id="s-niveau">
                                        <option value="" selected>{{ __('contact.specialized.stage.select_level') }}</option>
                                        <option value="master">{{ __('contact.specialized.stage.levels.master') }}</option>
                                        <option value="doctorate">{{ __('contact.specialized.stage.levels.doctorate') }}</option>
                                        <option value="postdoc">{{ __('contact.specialized.stage.levels.postdoc') }}</option>
                                    </select>
                                    @error('s_niveau') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="s-domaine">{{ __('contact.specialized.stage.domain') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model="s_domaine" class="form-control @error('s_domaine') is-invalid @enderror" id="s-domaine">
                                    @error('s_domaine') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="btn-cta border-0" wire:loading.attr="disabled">
                                    <span wire:loading.remove>{{ __('contact.specialized.stage.submit') }} <i class="fa fa-arrow-right ms-1"></i></span>
                                    <span wire:loading><i class="fa fa-spinner fa-spin me-2"></i>{{ __('contact.specialized.sending') }}</span>
                                </button>
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

                        @if ($successMedia)
                            <div class="form-success mb-3 p-3 rounded-2" style="background:var(--success-soft); color:var(--success);">
                                <i class="fa fa-check-circle text-success me-2"></i>{{ __('contact.specialized.media.success') }}
                            </div>
                        @endif

                        <form wire:submit="submitMedia" class="form-carics">
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <label for="m-nom">{{ __('contact.specialized.media.fullname') }} <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="m_nom" class="form-control @error('m_nom') is-invalid @enderror" id="m-nom">
                                    @error('m_nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="m-media">{{ __('contact.specialized.media.organization') }} <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="m_media" class="form-control @error('m_media') is-invalid @enderror" id="m-media">
                                    @error('m_media') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="m-sujet">{{ __('contact.specialized.media.subject') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model="m_sujet" class="form-control @error('m_sujet') is-invalid @enderror" id="m-sujet">
                                    @error('m_sujet') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="m-date">{{ __('contact.specialized.media.date') }}</label>
                                    <input type="date" wire:model="m_date" class="form-control @error('m_date') is-invalid @enderror" id="m-date">
                                    @error('m_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label for="m-contact">{{ __('contact.specialized.media.email') }} <span class="text-danger">*</span></label>
                                    <input type="email" wire:model="m_contact" class="form-control @error('m_contact') is-invalid @enderror" id="m-contact">
                                    @error('m_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="btn-cta border-0" wire:loading.attr="disabled">
                                    <span wire:loading.remove>{{ __('contact.specialized.media.submit') }} <i class="fa fa-arrow-right ms-1"></i></span>
                                    <span wire:loading><i class="fa fa-spinner fa-spin me-2"></i>{{ __('contact.specialized.sending') }}</span>
                                </button>
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
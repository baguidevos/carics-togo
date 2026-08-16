<?php

use App\Models\ContactSubmission;
use App\Models\NewsletterSubscriber;
use Database\Seeders\DatabaseSeeder;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('general contact form validates and creates ContactSubmission in database', function () {
    Livewire::test('archinest::contact')
        ->set('nom', 'Dupont')
        ->set('prenom', 'Jean')
        ->set('email', 'jean.dupont@example.com')
        ->set('organisation', 'Université de Lomé')
        ->set('objet', 'collaboration')
        ->set('message', 'Bonjour, nous souhaiterions collaborer avec CARICS-Togo sur un projet de recherche en santé.')
        ->set('rgpd', true)
        ->call('submitGeneral')
        ->assertHasNoErrors()
        ->assertSet('successGeneral', true);

    expect(ContactSubmission::where('email', 'jean.dupont@example.com')->where('form_type', 'general')->exists())->toBeTrue();
});

test('general contact form validates required fields', function () {
    Livewire::test('archinest::contact')
        ->call('submitGeneral')
        ->assertHasErrors(['nom', 'prenom', 'email', 'objet', 'message', 'rgpd']);
});

test('collaboration specialized form creates record in database', function () {
    Livewire::test('archinest::contact')
        ->set('c_nom', 'Dr Alice Martin')
        ->set('c_institution', 'ITM Anvers')
        ->set('c_domaine', 'Épidémiologie spatiale')
        ->set('c_projet', 'Proposition de partenariat de recherche pour analyse spatiale conjointe.')
        ->call('submitCollaboration')
        ->assertHasNoErrors()
        ->assertSet('successCollaboration', true);

    expect(ContactSubmission::where('form_type', 'collaboration')->where('full_name', 'Dr Alice Martin')->exists())->toBeTrue();
});

test('stage specialized form creates record in database', function () {
    Livewire::test('archinest::contact')
        ->set('s_nom', 'Koffi Mensah')
        ->set('s_universite', 'Université de Kara')
        ->set('s_niveau', 'master')
        ->set('s_domaine', 'Santé publique et biostatistiques')
        ->call('submitStage')
        ->assertHasNoErrors()
        ->assertSet('successStage', true);

    expect(ContactSubmission::where('form_type', 'stage')->where('full_name', 'Koffi Mensah')->exists())->toBeTrue();
});

test('media specialized form creates record in database', function () {
    Livewire::test('archinest::contact')
        ->set('m_nom', 'Journaliste Togo Presse')
        ->set('m_media', 'Togo Presse')
        ->set('m_sujet', 'Interview sur la CPS dans les Savanes')
        ->set('m_date', '2026-09-15')
        ->set('m_contact', 'presse@togopresse.tg')
        ->call('submitMedia')
        ->assertHasNoErrors()
        ->assertSet('successMedia', true);

    expect(ContactSubmission::where('form_type', 'media')->where('email', 'presse@togopresse.tg')->exists())->toBeTrue();
});

test('newsletter subscription creates a new subscriber', function () {
    Livewire::test('archinest::newsletter-form')
        ->set('email', 'subscriber@example.com')
        ->call('subscribe')
        ->assertHasNoErrors()
        ->assertSet('subscribed', true);

    expect(NewsletterSubscriber::where('email', 'subscriber@example.com')->where('is_active', true)->exists())->toBeTrue();
});

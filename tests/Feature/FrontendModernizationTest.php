<?php

use App\Models\Opportunity;
use App\Models\Publication;
use App\Models\ResearchProject;
use App\Models\TeamMember;
use Livewire\Livewire;

test('la page ressource publication est accessible et affiche le hub de publications', function () {
    $pub = Publication::factory()->create([
        'title' => 'Étude épidémiologique paludisme Togo',
        'type' => 'article_scientifique',
        'status' => 'publie',
    ]);

    $response = $this->get(route('ressource-publication'));
    $response->assertOk();
    $response->assertSee('Centre de Ressources Scientifiques');
    $response->assertSee('Étude épidémiologique paludisme Togo');
});

test('la page recherche expertize et projet est accessible avec la carte interactive', function () {
    $project = ResearchProject::factory()->create([
        'title' => 'Projet Maternité Sans Risque',
        'status' => 'en_cours',
        'region' => 'Centrale',
    ]);

    $response = $this->get(route('recherche-expertize-projet'));
    $response->assertOk();
    $response->assertSee('Implantation Territoriale & Sites d\'Intervention', false);
    $response->assertSee('Tous nos Projets de Recherche');
    $response->assertSee('Projet Maternité Sans Risque');
});

test('la page actualites et opportunites affiche le bento grid et les opportunites', function () {
    $opp = Opportunity::factory()->create([
        'title'         => 'Coordonnateur de Recherche Santé',
        'contract_type' => 'cdi',
        'status'        => 'ouverte',
    ]);

    $response = $this->get(route('actu-opportunites'));
    $response->assertOk();
    $response->assertSee('Opportunités', false);
});

test('le composant global search modal retourne les resultats de recherche', function () {
    $member = TeamMember::factory()->create([
        'full_name' => 'Dr. Koffi Ametowoyona',
        'role_title' => 'Chercheur Principal',
        'is_published' => true,
    ]);

    Livewire::test('global-search-modal')
        ->set('query', 'Ameto')
        ->assertSee('Dr. Koffi Ametowoyona')
        ->assertSee('Équipe', false);
});

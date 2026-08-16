<?php

use App\Models\News;
use App\Models\Opportunity;
use App\Models\Publication;
use App\Models\ResearchProject;

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
        'title' => 'Coordonnateur de Recherche Santé',
        'contract_type' => 'cdi',
        'status' => 'ouverte',
    ]);

    $response = $this->get(route('actu-opportunites'));
    $response->assertOk();
    $response->assertSee('Opportunités', false);
});

test('la page detail actualite est accessible et affiche le contenu complet', function () {
    $news = News::factory()->create([
        'title' => 'Formation des assistants de recherche CPS Cinkassé',
        'slug' => 'formation-assistants-recherche-cps-cinkasse',
        'excerpt' => 'Formation des équipes pour la collecte de données sur la CPS.',
        'content' => '<p>Le projet est financé par la RSTMH dans le cadre du grant 2025.</p>',
        'published_date' => now()->toDateString(),
        'is_published' => true,
    ]);

    $response = $this->get(route('news-detail', ['slug' => $news->slug]));
    $response->assertOk();
    $response->assertSee('Formation des assistants de recherche CPS Cinkassé');
    $response->assertSee('Le projet est financé par la RSTMH');
    $response->assertSee('min de lecture');
});

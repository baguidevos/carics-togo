<?php

use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('all public pages load with 200 OK without errors', function (string $routeName, array $params = []) {
    $response = $this->get(route($routeName, $params));

    $response->assertOk();
})->with([
    'home' => ['home', []],
    'about' => ['about', []],
    'recherche-expertize-projet' => ['recherche-expertize-projet', []],
    'ressource-publication' => ['ressource-publication', []],
    'actu-opportunites' => ['actu-opportunites', []],
    'equipe' => ['equipe', []],
    'team-detail' => ['team-detail', ['slug' => 'gountante-kombate']],
    'contact' => ['contact', []],
]);

test('language switcher sets locale and redirects back', function () {
    $response = $this->get(route('lang.switch', ['locale' => 'en']));

    $response->assertRedirect();
    expect(session('locale'))->toBe('en');

    $responseFr = $this->get(route('lang.switch', ['locale' => 'fr']));
    $responseFr->assertRedirect();
    expect(session('locale'))->toBe('fr');
});

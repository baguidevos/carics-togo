<?php

use App\Models\TeamMember;
use Database\Seeders\TeamMemberSeeder;

beforeEach(function () {
    $this->seed(TeamMemberSeeder::class);
});

test('team page can be rendered', function () {
    $response = $this->get(route('equipe'));

    $response->assertOk()
        ->assertSee('Dr Gountante KOMBATE')
        ->assertSee('Berthilde W. NIKIEMA KOMBATE');
});

test('team detail page can be rendered for a valid slug', function () {
    $response = $this->get(route('team-detail', ['slug' => 'gountante-kombate']));

    $response->assertOk()
        ->assertSee('Dr Gountante KOMBATE')
        ->assertSee('Président');
});

test('team detail page returns 404 for invalid slug', function () {
    $response = $this->get(route('team-detail', ['slug' => 'non-existent-member']));

    $response->assertNotFound();
});

test('team member scopes work correctly', function () {
    expect(TeamMember::published()->count())->toBe(4);
    expect(TeamMember::founders()->count())->toBe(4);
    expect(TeamMember::bureauExecutif()->count())->toBe(4);

    $ordered = TeamMember::published()->ordered()->get();
    expect($ordered->first()->slug)->toBe('gountante-kombate');
});

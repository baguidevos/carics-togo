<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('unauthenticated users are redirected to admincarics login', function () {
    $response = $this->get('/admincarics');

    $response->assertRedirect('/admincarics/login');
});

test('authenticated admin can access admincarics dashboard and resources', function (string $uri) {
    $admin = User::first();

    $response = $this->actingAs($admin)->get($uri);

    $response->assertOk();
})->with([
    '/admincarics',
    '/admincarics/team-members',
    '/admincarics/research-projects',
    '/admincarics/blog-posts',
    '/admincarics/publications',
    '/admincarics/news',
    '/admincarics/opportunities',
    '/admincarics/partners',
    '/admincarics/resources',
    '/admincarics/categories',
    '/admincarics/contact-submissions',
    '/admincarics/newsletter-subscribers',
    '/admincarics/site-settings',
]);

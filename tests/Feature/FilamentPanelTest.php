<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('unauthenticated users are redirected to cpanel login', function () {
    $response = $this->get('/cpanel');

    $response->assertRedirect('/cpanel/login');
});

test('authenticated admin can access cpanel dashboard and resources', function (string $uri) {
    $admin = User::first();

    $response = $this->actingAs($admin)->get($uri);

    $response->assertOk();
})->with([
    '/cpanel',
    '/cpanel/team-members',
    '/cpanel/research-projects',
    '/cpanel/blog-posts',
    '/cpanel/publications',
    '/cpanel/news',
    '/cpanel/opportunities',
    '/cpanel/partners',
    '/cpanel/resources',
    '/cpanel/categories',
    '/cpanel/contact-submissions',
    '/cpanel/newsletter-subscribers',
    '/cpanel/site-settings',
]);

<?php

use App\Filament\Resources\BlogPosts\Pages\CreateBlogPost;
use App\Filament\Resources\BlogPosts\Pages\EditBlogPost;
use App\Filament\Resources\News\Pages\CreateNews;
use App\Filament\Resources\News\Pages\EditNews;
use App\Models\BlogPost;
use App\Models\News;
use App\Models\User;
use Livewire\Livewire;

test('news detail page renders static image when hero_media_type is image', function () {
    $news = News::create([
        'title' => 'Visite terrain Kara',
        'slug' => 'visite-terrain-kara',
        'content' => '<p>Contenu test</p>',
        'excerpt' => 'Résumé test',
        'hero_media_type' => 'image',
        'cover_image' => 'images/test.jpg',
        'published_date' => now(),
        'is_published' => true,
    ]);

    $response = $this->get(route('news-detail', ['slug' => 'visite-terrain-kara']));

    $response->assertOk()
        ->assertSee('Visite terrain Kara');
});

test('news detail page renders properly when hero_media_type is slider', function () {
    $news = News::create([
        'title' => 'Atelier National Cinkassé',
        'slug' => 'atelier-national-cinkasse',
        'content' => '<p>Contenu test slider</p>',
        'excerpt' => 'Résumé slider',
        'hero_media_type' => 'slider',
        'cover_image' => 'images/test.jpg',
        'published_date' => now(),
        'is_published' => true,
    ]);

    $response = $this->get(route('news-detail', ['slug' => 'atelier-national-cinkasse']));

    $response->assertOk()
        ->assertSee('Atelier National Cinkassé');
});

test('filament news create and edit pages load hero_media_type properly', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $news = News::create([
        'title' => 'Actualité Admin Test',
        'slug' => 'actualite-admin-test',
        'content' => '<p>Contenu</p>',
        'hero_media_type' => 'slider',
        'published_date' => now(),
        'is_published' => true,
    ]);

    Livewire::test(CreateNews::class)->assertSuccessful();
    Livewire::test(EditNews::class, ['record' => $news->getKey()])->assertSuccessful();
});

test('filament blog post create and edit pages load hero_media_type properly', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $post = BlogPost::create([
        'title' => 'Article Blog Test',
        'slug' => 'article-blog-test',
        'body' => '<p>Contenu</p>',
        'hero_media_type' => 'slider',
        'status' => 'publie',
    ]);

    Livewire::test(CreateBlogPost::class)->assertSuccessful();
    Livewire::test(EditBlogPost::class, ['record' => $post->getKey()])->assertSuccessful();
});

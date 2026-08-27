<?php

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\News;

test('news model supports french and english translations with fallback', function () {
    $news = News::create([
        'title' => [
            'fr' => 'Titre en Français',
            'en' => 'Title in English',
        ],
        'slug' => [
            'fr' => 'titre-en-francais',
            'en' => 'title-in-english',
        ],
        'excerpt' => [
            'fr' => 'Extrait FR',
            'en' => 'Excerpt EN',
        ],
        'content' => [
            'fr' => 'Contenu FR',
            'en' => 'Content EN',
        ],
        'is_published' => true,
    ]);

    app()->setLocale('fr');
    expect($news->title)->toBe('Titre en Français')
        ->and($news->excerpt)->toBe('Extrait FR')
        ->and($news->content)->toBe('Contenu FR');

    app()->setLocale('en');
    expect($news->title)->toBe('Title in English')
        ->and($news->excerpt)->toBe('Excerpt EN')
        ->and($news->content)->toBe('Content EN');

    // Test fallback
    $newsWithoutEn = News::create([
        'title' => ['fr' => 'Uniquement en Français'],
        'slug' => ['fr' => 'uniquement-en-francais'],
        'is_published' => true,
    ]);

    app()->setLocale('en');
    expect($newsWithoutEn->title)->toBe('Uniquement en Français');
});

test('category and blog post models support translations', function () {
    $category = Category::create([
        'name' => [
            'fr' => 'Santé Publique',
            'en' => 'Public Health',
        ],
        'slug' => [
            'fr' => 'sante-publique',
            'en' => 'public-health',
        ],
        'categorizable_type' => BlogPost::class,
    ]);

    app()->setLocale('fr');
    expect($category->name)->toBe('Santé Publique');

    app()->setLocale('en');
    expect($category->name)->toBe('Public Health');
});

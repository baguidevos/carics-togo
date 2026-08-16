<?php

use App\Models\News;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

// Routes publiques principales
Route::livewire('/', 'archinest::home')->name('home');
Route::livewire('/a-propos', 'archinest::about-us')->name('about');
Route::livewire('/recherche-expertize-projet', 'archinest::research_expertize_project')->name('recherche-expertize-projet');
Route::livewire('/ressource-publication', 'archinest::ressource-publication')->name('ressource-publication');
Route::livewire('/actu-opportunites', 'archinest::actu-opportunites')->name('actu-opportunites');
Route::livewire('/actualites/{slug}', 'archinest::news-detail')->name('news-detail');
Route::livewire('/equipe', 'archinest::team')->name('equipe');
Route::livewire('/equipe/{slug}', 'archinest::team-detail')->name('team-detail');
Route::livewire('/contact', 'archinest::contact')->name('contact');

// Changement de langue
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['fr', 'en'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('lang.switch');

// Sitemap XML dynamique
Route::get('/sitemap.xml', function () {
    $baseUrl = config('app.url', 'https://carics-togo.org');
    $staticRoutes = ['home', 'about', 'recherche-expertize-projet', 'ressource-publication', 'actu-opportunites', 'equipe', 'contact'];
    $teamMembers = TeamMember::published()->get();
    $newsList = News::published()->get();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

    foreach ($staticRoutes as $route) {
        $loc = route($route);
        $xml .= '<url>';
        $xml .= "<loc>{$loc}</loc>";
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>'.($route === 'home' ? '1.0' : '0.8').'</priority>';
        $xml .= '</url>';
    }

    foreach ($teamMembers as $member) {
        $loc = route('team-detail', ['slug' => $member->slug]);
        $xml .= '<url>';
        $xml .= "<loc>{$loc}</loc>";
        $xml .= '<changefreq>monthly</changefreq>';
        $xml .= '<priority>0.7</priority>';
        $xml .= '</url>';
    }

    foreach ($newsList as $newsItem) {
        $loc = route('news-detail', ['slug' => $newsItem->slug]);
        $xml .= '<url>';
        $xml .= "<loc>{$loc}</loc>";
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.7</priority>';
        $xml .= '</url>';
    }

    $xml .= '</urlset>';

    return Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=utf-8']);
})->name('sitemap');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

<?php

use Illuminate\Support\Facades\Route;

//
Route::livewire('/1', 'pages::home')->name('home2');
Route::livewire('/', 'archinest::home')->name('home');
Route::livewire('/a-propos', 'archinest::about-us')->name('about');
Route::livewire('/recherche-expertize-projet', 'archinest::research_expertize_project')->name('recherche-expertize-projet');
Route::livewire('/ressource-publication', 'archinest::ressource-publication')->name('ressource-publication');
Route::livewire('/actu-opportunites', 'archinest::actu-opportunites')->name('actu-opportunites');
Route::livewire('/equipe', 'archinest::team')->name('equipe');
Route::livewire('/equipe/{slug}', 'archinest::team-detail')->name('team-detail');

// Route::get('/about', 'about')->name('about');
// Route::get('/contact', 'contact')->name('contact');
// Route::get('/portfolio', 'portfolio')->name('portfolio');
// Route::get('/blog', 'blog')->name('blog');
// Route::get('/services', 'services')->name('services');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

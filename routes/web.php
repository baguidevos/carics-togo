<?php

use Illuminate\Support\Facades\Route;

//
Route::livewire('/', 'archinest::home')->name('home');
Route::livewire('/a-propos', 'archinest::about-us')->name('about');
Route::livewire('/recherche-expertize-projet', 'archinest::research_expertize_project')->name('recherche-expertize-projet');
Route::livewire('/ressource-publication', 'archinest::ressource-publication')->name('ressource-publication');
Route::livewire('/actu-opportunites', 'archinest::actu-opportunites')->name('actu-opportunites');
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

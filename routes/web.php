<?php

use Illuminate\Support\Facades\Route;

// 
// Route::view('/', 'home')->name('home');
// Route::get('/about', 'about')->name('about');
// Route::get('/contact', 'contact')->name('contact');
// Route::get('/portfolio', 'portfolio')->name('portfolio');
// Route::get('/blog', 'blog')->name('blog');
// Route::get('/services', 'services')->name('services');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

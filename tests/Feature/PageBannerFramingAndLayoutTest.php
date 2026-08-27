<?php

use App\Filament\Resources\PageBanners\Pages\EditPageBanner;
use App\Models\PageBanner;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

test('page banner has default layout_type full and image_position center', function () {
    $banner = PageBanner::create([
        'page_key' => 'test_defaults',
        'title' => 'Default Title',
    ]);

    expect($banner->layout_type)->toBe('full')
        ->and($banner->image_position)->toBe('center');
});

test('page banner persists custom layout_type and image_position', function () {
    $banner = PageBanner::create([
        'page_key' => 'test_custom',
        'title' => 'Custom Title',
        'layout_type' => 'split',
        'image_position' => 'top',
    ]);

    $fresh = $banner->fresh();
    expect($fresh->layout_type)->toBe('split')
        ->and($fresh->image_position)->toBe('top');
});

test('page-title component renders split layout when configured', function () {
    PageBanner::updateOrCreate(
        ['page_key' => 'about'],
        [
            'title' => 'À Propos - Mode Split',
            'layout_type' => 'split',
            'image_position' => 'top',
            'is_active' => true,
        ]
    );

    $html = Blade::render('<x-archinest.page-title page="about" title="Fallback" />');

    expect($html)
        ->toContain('page-title--split')
        ->toContain('banner-split-card')
        ->toContain('object-position: top')
        ->toContain('À Propos - Mode Split');
});

test('page-title component renders full width banner with customized image position', function () {
    PageBanner::updateOrCreate(
        ['page_key' => 'contact'],
        [
            'title' => 'Contactez-nous',
            'layout_type' => 'full',
            'image_position' => 'bottom',
            'is_active' => true,
        ]
    );

    $html = Blade::render('<x-archinest.page-title page="contact" title="Contact" />');

    expect($html)
        ->toContain('background-position: bottom')
        ->toContain('Contactez-nous')
        ->not->toContain('page-title--split');
});

test('filament page banner form can save layout_type and image_position', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $banner = PageBanner::create([
        'page_key' => 'research',
        'title' => 'Recherche',
        'layout_type' => 'full',
        'image_position' => 'center',
    ]);

    Livewire::test(EditPageBanner::class, ['record' => $banner->getKey()])
        ->fillForm([
            'layout_type' => 'split',
            'image_position' => 'top',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $banner->refresh();
    expect($banner->layout_type)->toBe('split')
        ->and($banner->image_position)->toBe('top');
});

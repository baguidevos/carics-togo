<?php

use App\Filament\Resources\PageBanners\Pages\CreatePageBanner;
use App\Filament\Resources\PageBanners\Pages\EditPageBanner;
use App\Filament\Resources\PageBanners\Pages\ListPageBanners;
use App\Models\PageBanner;
use App\Models\User;
use Livewire\Livewire;

test('about page renders dynamic banner from database', function () {
    PageBanner::updateOrCreate(
        ['page_key' => 'about'],
        [
            'title' => [
                'fr' => 'Notre Histoire & Vision Personnalisée',
                'en' => 'Our History & Custom Vision',
            ],
            'hero_media_type' => 'image',
            'is_active' => true,
        ]
    );

    $response = $this->get(route('about'));

    $response->assertOk()
        ->assertSee('Notre Histoire & Vision Personnalisée');
});

test('filament page banners pages load successfully', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $banner = PageBanner::updateOrCreate(
        ['page_key' => 'team'],
        [
            'title' => 'Équipe CARICS',
            'hero_media_type' => 'slider',
            'is_active' => true,
        ]
    );

    Livewire::test(ListPageBanners::class)->assertSuccessful();
    Livewire::test(CreatePageBanner::class)->assertSuccessful();
    Livewire::test(EditPageBanner::class, ['record' => $banner->getKey()])->assertSuccessful();
});

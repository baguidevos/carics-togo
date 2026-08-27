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
                'fr' => 'Notre Histoire et Vision Personnalisée',
                'en' => 'Our History and Custom Vision',
            ],
            'hero_media_type' => 'image',
            'is_active' => true,
        ]
    );

    app()->setLocale('fr');
    $responseFr = $this->get(route('about'));
    $responseFr->assertOk()->assertSee('Notre Histoire et Vision Personnalisée');

    app()->setLocale('en');
    $responseEn = $this->get(route('about'));
    $responseEn->assertOk()->assertSee('Our History and Custom Vision');
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

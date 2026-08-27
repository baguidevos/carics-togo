<?php

use App\Filament\Resources\HeroSlides\Pages\CreateHeroSlide;
use App\Filament\Resources\HeroSlides\Pages\EditHeroSlide;
use App\Filament\Resources\HeroSlides\Pages\ListHeroSlides;
use App\Models\HeroSlide;
use App\Models\User;
use Livewire\Livewire;

test('homepage renders hero slide from database', function () {
    HeroSlide::create([
        'title' => [
            'fr' => 'Titre de Test Hero Slide',
            'en' => 'Test Hero Slide Title',
        ],
        'badge' => [
            'fr' => 'Badge Test',
            'en' => 'Test Badge',
        ],
        'description' => [
            'fr' => 'Description dynamique pour test',
            'en' => 'Dynamic description for test',
        ],
        'primary_cta_label' => [
            'fr' => 'Bouton Test',
            'en' => 'Test Button',
        ],
        'primary_cta_url' => '/recherche-expertize-projet',
        'is_active' => true,
        'display_order' => 1,
    ]);

    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertSee('Titre de Test Hero Slide');
});

test('filament hero slides pages load successfully', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $slide = HeroSlide::create([
        'title' => 'Slide Admin',
        'is_active' => true,
        'display_order' => 1,
    ]);

    Livewire::test(ListHeroSlides::class)->assertSuccessful();
    Livewire::test(CreateHeroSlide::class)->assertSuccessful();
    Livewire::test(EditHeroSlide::class, ['record' => $slide->getKey()])->assertSuccessful();
});

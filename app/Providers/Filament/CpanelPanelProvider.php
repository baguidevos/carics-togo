<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\StatsOverviewWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CpanelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admincarics')
            ->path('admincarics')
            ->login()
            ->registration()
            ->spa(hasPrefetching:true)
            // ── Palette CARICS : bleu marine + vert forêt ──
            ->colors([
                'primary' => Color::hex('#1B3A6B'),
                'success' => Color::hex('#1A7A3A'),
                'info' => Color::hex('#008A5E'),
                'warning' => Color::Amber,
                'danger' => Color::Rose,
                'gray' => Color::Slate,
            ])

            // ── Apparence & Layout ──
            ->maxContentWidth(Width::Full)
            ->sidebarCollapsibleOnDesktop()
            ->favicon(asset('favicons/apple-touch-icon.png'))
            ->brandLogo(asset('logo.jpeg'))
            ->brandName('CARICS')
            ->brandLogoHeight('3rem')
            ->icons([
                'panels::sidebar.collapse-button' => 'heroicon-o-arrows-pointing-in',
                'panels::sidebar.expand-button' => 'heroicon-o-chevron-double-right',
            ])

            // ── Global Search ──
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])

            // ── Notifications (badge simple) ──
            ->databaseNotifications()

            // ── Ordre des groupes de navigation ──
            ->navigationGroups([
                NavigationGroup::make('🔬 Recherche & Projets')
                    ->icon('heroicon-o-academic-cap'),
                NavigationGroup::make('📰 Communication & Blog')
                    ->icon('heroicon-o-newspaper'),
                NavigationGroup::make('👥 Gouvernance & Équipe')
                    ->icon('heroicon-o-users'),
                NavigationGroup::make('📬 Interactions & Abonnés')
                    ->icon('heroicon-o-envelope'),
                NavigationGroup::make('⚙️ Paramètres & Structure')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ])

            // ── Découverte automatique ──
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                StatsOverviewWidget::class,
            ])

            // ── Middleware ──
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}

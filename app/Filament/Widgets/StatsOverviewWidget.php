<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use App\Models\NewsletterSubscriber;
use App\Models\Publication;
use App\Models\ResearchProject;
use App\Models\TeamMember;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Projets de Recherche', ResearchProject::count())
                ->description('Projets scientifiques enregistrés')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Publications & Rapports', Publication::count())
                ->description('Articles et notes techniques')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('Membres de l\'équipe', TeamMember::count())
                ->description('Chercheurs & gouvernance')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Messages reçus', ContactSubmission::unread()->count())
                ->description('Messages en attente de lecture')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning'),

            Stat::make('Abonnés Newsletter', NewsletterSubscriber::active()->count())
                ->description('Lecteurs actifs')
                ->descriptionIcon('heroicon-m-at-symbol')
                ->color('gray'),
        ];
    }
}

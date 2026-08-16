<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\ContactSubmission;
use App\Models\NewsletterSubscriber;
use App\Models\Publication;
use App\Models\ResearchProject;
use App\Models\TeamMember;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Projets de Recherche', ResearchProject::count())
                ->description('Projets scientifiques enregistrés')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary')
                ->chart($this->getWeeklyTrend(ResearchProject::class))
                ->url(route('filament.admincarics.resources.research-projects.index')),

            Stat::make('Publications & Rapports', Publication::count())
                ->description('Articles et notes techniques')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success')
                ->chart($this->getWeeklyTrend(Publication::class))
                ->url(route('filament.admincarics.resources.publications.index')),

            Stat::make('Membres de l\'équipe', TeamMember::count())
                ->description('Chercheurs & gouvernance')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->url(route('filament.admincarics.resources.team-members.index')),

            Stat::make('Articles de blog', BlogPost::count())
                ->description('Contenus publiés')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary')
                ->chart($this->getWeeklyTrend(BlogPost::class))
                ->url(route('filament.admincarics.resources.blog-posts.index')),

            Stat::make('Messages non lus', ContactSubmission::unread()->count())
                ->description('Messages en attente')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning')
                ->url(route('filament.admincarics.resources.contact-submissions.index')),

            Stat::make('Abonnés Newsletter', NewsletterSubscriber::active()->count())
                ->description('Lecteurs actifs')
                ->descriptionIcon('heroicon-m-at-symbol')
                ->color('gray')
                ->url(route('filament.admincarics.resources.newsletter-subscribers.index')),
        ];
    }

    /**
     * @param  class-string<Model>  $model
     * @return array<int, int>
     */
    private function getWeeklyTrend(string $model): array
    {
        return collect(range(6, 0))
            ->map(fn (int $daysAgo) => $model::whereDate('created_at', Carbon::today()->subDays($daysAgo))->count())
            ->values()
            ->toArray();
    }
}

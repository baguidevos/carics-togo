<?php

namespace App\Filament\Resources\SiteSettings\Pages;

use App\Filament\Resources\SiteSettings\SiteSettingResource;
use Database\Seeders\SiteSettingSeeder;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListSiteSettings extends ListRecords
{
    protected static string $resource = SiteSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('seedDefaults')
                ->label('Générer les paramètres par défaut')
                ->icon('heroicon-o-sparkles')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Générer les paramètres par défaut')
                ->modalDescription('Cette action va créer tous les paramètres standard manquants (Téléphone, Email, Réseaux sociaux, Slogan, etc.) sans écraser vos modifications existantes.')
                ->action(function () {
                    (new SiteSettingSeeder)->run();
                    Notification::make()
                        ->success()
                        ->title('Paramètres initialisés avec succès')
                        ->body('Tous les paramètres standard du site sont désormais présents.')
                        ->send();
                }),
            CreateAction::make(),
        ];
    }
}

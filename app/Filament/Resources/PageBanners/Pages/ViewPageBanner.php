<?php

namespace App\Filament\Resources\PageBanners\Pages;

use App\Filament\Resources\PageBanners\PageBannerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ViewRecord\Concerns\Translatable;

class ViewPageBanner extends ViewRecord
{
    use Translatable;

    protected static string $resource = PageBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\PageBanners\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PageBannerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('page_key'),
                TextEntry::make('title')
                    ->placeholder('-'),
                TextEntry::make('subtitle')
                    ->placeholder('-'),
                TextEntry::make('layout_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'split' => 'warning',
                        default => 'primary',
                    }),
                TextEntry::make('image_position')
                    ->badge(),
                TextEntry::make('hero_media_type')
                    ->badge(),
                ImageEntry::make('image')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

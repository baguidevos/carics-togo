<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HeroSlideInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('badge')
                    ->placeholder('-'),
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('image')
                    ->placeholder('-'),
                TextEntry::make('primary_cta_label')
                    ->placeholder('-'),
                TextEntry::make('primary_cta_url')
                    ->placeholder('-'),
                TextEntry::make('primary_cta_icon'),
                TextEntry::make('secondary_cta_label')
                    ->placeholder('-'),
                TextEntry::make('secondary_cta_url')
                    ->placeholder('-'),
                TextEntry::make('secondary_cta_icon'),
                TextEntry::make('display_order')
                    ->numeric(),
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

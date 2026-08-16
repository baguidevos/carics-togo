<?php

namespace App\Filament\Resources\Publications\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PublicationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('type'),
                TextEntry::make('abstract')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('journal_or_publisher')
                    ->placeholder('-'),
                TextEntry::make('author_ids')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('external_co_authors')
                    ->placeholder('-'),
                TextEntry::make('file_path')
                    ->placeholder('-'),
                TextEntry::make('external_url')
                    ->placeholder('-'),
                TextEntry::make('published_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('researchProject.title')
                    ->label('Research project')
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

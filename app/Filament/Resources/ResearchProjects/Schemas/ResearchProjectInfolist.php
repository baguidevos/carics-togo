<?php

namespace App\Filament\Resources\ResearchProjects\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ResearchProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('slug'),
                TextEntry::make('status'),
                TextEntry::make('funder')
                    ->placeholder('-'),
                TextEntry::make('start_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('end_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('country'),
                TextEntry::make('region')
                    ->placeholder('-'),
                TextEntry::make('intervention_zones')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('map_lat')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('map_lng')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('context')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('objective')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('methodology')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('expected_results')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('research_domains')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('lead.id')
                    ->label('Lead')
                    ->placeholder('-'),
                IconEntry::make('is_featured')
                    ->boolean(),
                IconEntry::make('is_published')
                    ->boolean(),
                TextEntry::make('display_order')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

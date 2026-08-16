<?php

namespace App\Filament\Resources\ResearchProjects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ResearchProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('en_cours'),
                TextInput::make('funder'),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                TextInput::make('country')
                    ->required()
                    ->default('Togo'),
                TextInput::make('region'),
                Textarea::make('intervention_zones')
                    ->columnSpanFull(),
                TextInput::make('map_lat')
                    ->numeric(),
                TextInput::make('map_lng')
                    ->numeric(),
                Textarea::make('context')
                    ->columnSpanFull(),
                Textarea::make('objective')
                    ->columnSpanFull(),
                Textarea::make('methodology')
                    ->columnSpanFull(),
                Textarea::make('expected_results')
                    ->columnSpanFull(),
                Textarea::make('research_domains')
                    ->columnSpanFull(),
                Select::make('lead_id')
                    ->relationship('lead', 'id'),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_published')
                    ->required(),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}

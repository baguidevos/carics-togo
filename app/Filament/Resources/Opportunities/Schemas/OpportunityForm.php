<?php

namespace App\Filament\Resources\Opportunities\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OpportunityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name'),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('requirements')
                    ->columnSpanFull(),
                TextInput::make('location'),
                TextInput::make('contract_type'),
                DatePicker::make('deadline'),
                TextInput::make('application_email')
                    ->email(),
                TextInput::make('application_url')
                    ->url(),
                TextInput::make('status')
                    ->required()
                    ->default('ouverte'),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('group')
                    ->required()
                    ->default('general'),
                TextInput::make('key')
                    ->required(),
                Textarea::make('value')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('logo')
                    ->collection('logo')
                    ->image(),
                SpatieMediaLibraryFileUpload::make('favicon')
                    ->collection('favicon')
                    ->image(),
                TextInput::make('type')
                    ->required()
                    ->default('text'),
                TextInput::make('label'),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}

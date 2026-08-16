<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('full_name'),
                SpatieMediaLibraryFileUpload::make('logo')
                    ->collection('logo')
                    ->image()
                    ->imageEditor(),
                TextInput::make('website_url')
                    ->url(),
                TextInput::make('type')
                    ->required()
                    ->default('autre'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}

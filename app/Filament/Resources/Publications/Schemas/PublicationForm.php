<?php

namespace App\Filament\Resources\Publications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PublicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('type')
                    ->required()
                    ->default('article_scientifique'),
                Textarea::make('abstract')
                    ->columnSpanFull(),
                TextInput::make('journal_or_publisher'),
                Textarea::make('author_ids')
                    ->columnSpanFull(),
                TextInput::make('external_co_authors'),
                TextInput::make('file_path'),
                TextInput::make('external_url')
                    ->url(),
                DatePicker::make('published_date'),
                Select::make('research_project_id')
                    ->relationship('researchProject', 'title'),
                TextInput::make('status')
                    ->required()
                    ->default('a_paraitre'),
            ]);
    }
}

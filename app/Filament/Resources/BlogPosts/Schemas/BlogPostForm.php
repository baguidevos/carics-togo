<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('type')
                    ->required()
                    ->default('article'),
                Textarea::make('excerpt')
                    ->columnSpanFull(),
                Textarea::make('body')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('cover')
                    ->collection('cover')
                    ->image()
                    ->imageEditor(),
                Select::make('author_id')
                    ->relationship('author', 'id'),
                Select::make('category_id')
                    ->relationship('category', 'name'),
                Select::make('research_project_id')
                    ->relationship('researchProject', 'title'),
                TextInput::make('reading_time_minutes')
                    ->numeric(),
                Textarea::make('references')
                    ->columnSpanFull(),
                TextInput::make('meta_title'),
                TextInput::make('meta_description'),
                TextInput::make('status')
                    ->required()
                    ->default('brouillon'),
                DateTimePicker::make('published_at'),
                Toggle::make('is_featured')
                    ->required(),
            ]);
    }
}

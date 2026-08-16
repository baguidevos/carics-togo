<?php

namespace App\Filament\Resources\Publications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PublicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations bibliographiques')
                    ->icon('heroicon-m-document-text')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->columnSpanFull(),
                        Select::make('type')
                            ->label('Type de publication')
                            ->options([
                                'article_scientifique' => '📄 Article scientifique',
                                'rapport_technique' => '📊 Rapport technique',
                                'note_politique' => '📋 Note politique',
                                'these' => '🎓 Thèse',
                                'memoire' => '📖 Mémoire',
                            ])
                            ->required()
                            ->default('article_scientifique'),
                        TextInput::make('journal_or_publisher')
                            ->label('Revue / Éditeur'),
                        Textarea::make('abstract')
                            ->label('Résumé / Abstract')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('author_ids')
                            ->label('Auteurs (IDs)')
                            ->columnSpanFull(),
                        TextInput::make('external_co_authors')
                            ->label('Co-auteurs externes'),
                        Select::make('research_project_id')
                            ->label('Projet de recherche lié')
                            ->relationship('researchProject', 'title')
                            ->searchable()
                            ->preload(),
                    ]),

                Section::make('Fichiers')
                    ->icon('heroicon-m-paper-clip')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('document')
                            ->label('Document PDF / Word')
                            ->collection('document')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->downloadable(),
                        SpatieMediaLibraryFileUpload::make('cover')
                            ->label('Image de couverture')
                            ->collection('cover')
                            ->image(),
                        TextInput::make('external_url')
                            ->label('URL externe (DOI, lien éditeur)')
                            ->url()
                            ->prefix('https://'),
                    ]),

                Section::make('Publication')
                    ->icon('heroicon-m-rocket-launch')
                    ->columns(2)
                    ->schema([
                        DatePicker::make('published_date')
                            ->label('Date de publication'),
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'a_paraitre' => '🟡 À paraître',
                                'publie' => '🟢 Publié',
                                'en_revision' => '🔵 En révision',
                            ])
                            ->required()
                            ->default('a_paraitre'),
                    ]),
            ]);
    }
}

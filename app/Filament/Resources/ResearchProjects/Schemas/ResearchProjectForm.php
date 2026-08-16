<?php

namespace App\Filament\Resources\ResearchProjects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ResearchProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Projet de recherche')
                    ->tabs([
                        Tab::make('🔬 Identification')
                            ->icon('heroicon-m-academic-cap')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Titre du projet')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                                TextInput::make('slug')
                                    ->label('Slug URL')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Select::make('status')
                                    ->label('Statut')
                                    ->options([
                                        'en_cours' => '🟢 En cours',
                                        'termine' => '🔵 Terminé',
                                        'en_attente' => '🟡 En attente',
                                        'suspendu' => '🔴 Suspendu',
                                    ])
                                    ->required()
                                    ->default('en_cours'),
                                TextInput::make('funder')
                                    ->label('Bailleur / Financeur'),
                                Select::make('lead_id')
                                    ->label('Chef de projet')
                                    ->relationship('lead', 'full_name')
                                    ->searchable()
                                    ->preload(),
                                DatePicker::make('start_date')
                                    ->label('Date de début'),
                                DatePicker::make('end_date')
                                    ->label('Date de fin'),
                            ]),

                        Tab::make('📍 Localisation')
                            ->icon('heroicon-m-map-pin')
                            ->schema([
                                TextInput::make('country')
                                    ->label('Pays')
                                    ->required()
                                    ->default('Togo'),
                                TextInput::make('region')
                                    ->label('Région'),
                                RichEditor::make('intervention_zones')
                                    ->label('Zones d\'intervention')
                                    ->toolbarButtons(['bold', 'bulletList', 'orderedList'])
                                    ->columnSpanFull(),
                                TextInput::make('map_lat')
                                    ->label('Latitude')
                                    ->numeric(),
                                TextInput::make('map_lng')
                                    ->label('Longitude')
                                    ->numeric(),
                            ]),

                        Tab::make('📋 Contenu scientifique')
                            ->icon('heroicon-m-beaker')
                            ->schema([
                                RichEditor::make('context')
                                    ->label('Contexte')
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link'])
                                    ->columnSpanFull(),
                                RichEditor::make('objective')
                                    ->label('Objectifs')
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link'])
                                    ->columnSpanFull(),
                                RichEditor::make('methodology')
                                    ->label('Méthodologie')
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link'])
                                    ->columnSpanFull(),
                                RichEditor::make('expected_results')
                                    ->label('Résultats attendus')
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link'])
                                    ->columnSpanFull(),
                                RichEditor::make('research_domains')
                                    ->label('Domaines de recherche')
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('🖼️ Médias & Documents')
                            ->icon('heroicon-m-photo')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('cover')
                                    ->label('Image de couverture')
                                    ->collection('cover')
                                    ->image()
                                    ->imageEditor()
                                    ->columnSpanFull(),
                                SpatieMediaLibraryFileUpload::make('documents')
                                    ->label('Documents associés')
                                    ->collection('documents')
                                    ->multiple()
                                    ->downloadable()
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('⚙️ Paramètres')
                            ->icon('heroicon-m-cog-6-tooth')
                            ->schema([
                                Toggle::make('is_featured')
                                    ->label('Mettre en avant'),
                                Toggle::make('is_published')
                                    ->label('Publié'),
                                TextInput::make('display_order')
                                    ->label('Ordre d\'affichage')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

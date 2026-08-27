<?php

namespace App\Filament\Resources\PageBanners\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageBannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->columnSpanFull()
                    ->schema([
                        // ─── Colonne Gauche (Identité de la Page & Textes) ───────────
                        Section::make('Page & Textes d\'en-tête')
                            ->icon('heroicon-m-document-text')
                            ->columnSpan(['default' => 1, 'lg' => 2])
                            ->schema([
                                Select::make('page_key')
                                    ->label('Page cible')
                                    ->options([
                                        'about' => 'À propos de nous (/a-propos)',
                                        'research' => 'Recherche, Expertise & Projets (/recherche-expertize-projet)',
                                        'resources_publications' => 'Ressources & Publications (/ressource-publication)',
                                        'news_opportunities' => 'Actualités & Opportunités (/actu-opportunites)',
                                        'team' => 'Notre Équipe & Gouvernance (/equipe)',
                                        'contact' => 'Contact & Partenariats (/contact)',
                                    ])
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->native(false),

                                TextInput::make('title')
                                    ->label('Titre d\'en-tête (optionnel)')
                                    ->placeholder('Laissez vide pour utiliser le titre standard de la page'),

                                TextInput::make('subtitle')
                                    ->label('Sous-titre / Slogan (optionnel)')
                                    ->placeholder('Laissez vide pour utiliser le sous-titre standard'),

                                TextInput::make('breadcrumb_title')
                                    ->label('Libellé fil d\'Ariane (optionnel)')
                                    ->placeholder('Laissez vide pour conserver la valeur par défaut'),

                                ToggleButtons::make('hero_media_type')
                                    ->label('Mode d\'affichage du média d\'en-tête')
                                    ->options([
                                        'image' => 'Image fixe',
                                        'slider' => 'Slider défilant (Carrousel)',
                                    ])
                                    ->icons([
                                        'image' => 'heroicon-m-photo',
                                        'slider' => 'heroicon-m-play-circle',
                                    ])
                                    ->colors([
                                        'image' => 'primary',
                                        'slider' => 'info',
                                    ])
                                    ->default('image')
                                    ->required()
                                    ->inline()
                                    ->helperText('En mode "Slider", les photos téléversées dans la Galerie ci-contre défileront automatiquement en fond de l\'en-tête.'),
                            ]),

                        // ─── Colonne Droite (Médias & Statut) ───────────────────────
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 1])
                            ->schema([
                                Section::make('Médias de la bannière')
                                    ->icon('heroicon-m-photo')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('cover')
                                            ->label('Image de couverture fixe')
                                            ->collection('cover')
                                            ->disk('public')
                                            ->image()
                                            ->imageEditor()
                                            ->imageEditorAspectRatios(['16:9', '21:9'])
                                            ->helperText('Image principale d\'arrière-plan (1920×800px).'),

                                        SpatieMediaLibraryFileUpload::make('gallery')
                                            ->label('Photos du Slider (si mode Slider)')
                                            ->collection('gallery')
                                            ->disk('public')
                                            ->multiple()
                                            ->reorderable()
                                            ->image()
                                            ->imageEditor()
                                            ->helperText('Ajoutez plusieurs images pour composer le slider d\'en-tête.'),
                                    ]),

                                Section::make('Statut')
                                    ->icon('heroicon-m-check-circle')
                                    ->schema([
                                        ToggleButtons::make('is_active')
                                            ->label('Bannière active')
                                            ->boolean()
                                            ->default(true)
                                            ->required()
                                            ->inline(),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->columnSpanFull()
                    ->schema([
                        // ─── Colonne Gauche (Contenu du Slide) ───────────────
                        Section::make('Contenu textuel du Slide')
                            ->icon('heroicon-m-document-text')
                            ->columnSpan(['default' => 1, 'lg' => 2])
                            ->schema([
                                TextInput::make('badge')
                                    ->label('Badge / Surtitre')
                                    ->placeholder('Ex: Pôle d\'Excellence en Recherche'),
                                TextInput::make('title')
                                    ->label('Titre principal')
                                    ->required()
                                    ->placeholder('Ex: Générer des données probantes pour transformer la santé en Afrique'),
                                Textarea::make('description')
                                    ->label('Description / Accroche')
                                    ->rows(4)
                                    ->placeholder('Texte d\'introduction du slide...'),

                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('primary_cta_label')
                                            ->label('Bouton 1 - Libellé')
                                            ->placeholder('Ex: Découvrir nos Projets'),
                                        TextInput::make('primary_cta_url')
                                            ->label('Bouton 1 - Lien URL / Route')
                                            ->placeholder('Ex: /recherche-expertize-projet'),
                                        TextInput::make('primary_cta_icon')
                                            ->label('Bouton 1 - Icône FontAwesome')
                                            ->default('fa-solid fa-flask-vial'),
                                    ]),

                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('secondary_cta_label')
                                            ->label('Bouton 2 - Libellé')
                                            ->placeholder('Ex: En savoir plus'),
                                        TextInput::make('secondary_cta_url')
                                            ->label('Bouton 2 - Lien URL / Route')
                                            ->placeholder('Ex: /a-propos'),
                                        TextInput::make('secondary_cta_icon')
                                            ->label('Bouton 2 - Icône FontAwesome')
                                            ->default('fa-solid fa-circle-info'),
                                    ]),
                            ]),

                        // ─── Colonne Droite (Image de fond & Paramètres) ───
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 1])
                            ->schema([
                                Section::make('Image d\'arrière-plan')
                                    ->icon('heroicon-m-photo')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('image')
                                            ->label('Image de fond (Slide)')
                                            ->collection('image')
                                            ->disk('public')
                                            ->image()
                                            ->imageEditor()
                                            ->imageEditorAspectRatios(['16:9', '21:9'])
                                            ->helperText('Image haute résolution recommandée (1920×1080px).'),
                                    ]),

                                Section::make('Affichage & Ordre')
                                    ->icon('heroicon-m-cog-6-tooth')
                                    ->schema([
                                        TextInput::make('display_order')
                                            ->label('Ordre d\'apparition')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                        ToggleButtons::make('is_active')
                                            ->label('Statut')
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

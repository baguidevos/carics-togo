<?php

namespace App\Filament\Resources\Opportunities\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OpportunityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Détails de l\'offre')
                    ->icon('heroicon-m-briefcase')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre de l\'offre')
                            ->required()
                            ->columnSpanFull(),
                        Select::make('category_id')
                            ->label('Catégorie')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload(),
                        ToggleButtons::make('contract_type')
                            ->label('Type de contrat')
                            ->options([
                                'stage' => 'Stage',
                                'cdd' => 'CDD',
                                'cdi' => 'CDI',
                                'benevolat' => 'Bénévolat',
                                'consultation' => 'Consultation',
                            ])
                            ->icons([
                                'stage' => 'heroicon-m-academic-cap',
                                'cdd' => 'heroicon-m-document-text',
                                'cdi' => 'heroicon-m-lock-closed',
                                'benevolat' => 'heroicon-m-heart',
                                'consultation' => 'heroicon-m-briefcase',
                            ])
                            ->inline()
                            ->columnSpanFull(),
                        TextInput::make('location')
                            ->label('Lieu'),
                        DatePicker::make('deadline')
                            ->label('Date limite de candidature'),
                        RichEditor::make('description')
                            ->label('Description du poste')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'h2', 'h3',
                                'bulletList', 'orderedList',
                                'link', 'blockquote', 'table',
                                'undo', 'redo',
                            ])
                            ->columnSpanFull(),
                        RichEditor::make('requirements')
                            ->label('Profil recherché / Prérequis')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'h2', 'h3',
                                'bulletList', 'orderedList',
                                'link', 'blockquote', 'table',
                                'undo', 'redo',
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Candidature')
                    ->icon('heroicon-m-envelope')
                    ->columns(2)
                    ->schema([
                        TextInput::make('application_email')
                            ->label('Email de candidature')
                            ->email(),
                        TextInput::make('application_url')
                            ->label('Lien de candidature')
                            ->url()
                            ->prefix('https://'),
                    ]),

                Section::make('Paramètres')
                    ->icon('heroicon-m-cog-6-tooth')
                    ->columns(2)
                    ->schema([
                        ToggleButtons::make('status')
                            ->label('Statut')
                            ->options([
                                'ouverte' => 'Ouverte',
                                'fermee' => 'Fermée',
                                'en_cours' => 'En cours',
                            ])
                            ->colors([
                                'ouverte' => 'success',
                                'fermee' => 'danger',
                                'en_cours' => 'warning',
                            ])
                            ->icons([
                                'ouverte' => 'heroicon-m-check-circle',
                                'fermee' => 'heroicon-m-x-circle',
                                'en_cours' => 'heroicon-m-clock',
                            ])
                            ->inline()
                            ->required()
                            ->default('ouverte'),
                        Toggle::make('is_published')
                            ->label('Publié'),
                    ]),
            ]);
    }
}

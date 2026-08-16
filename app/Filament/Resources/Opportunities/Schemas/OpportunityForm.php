<?php

namespace App\Filament\Resources\Opportunities\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
                        Select::make('contract_type')
                            ->label('Type de contrat')
                            ->options([
                                'stage' => '🎓 Stage',
                                'cdd' => '📋 CDD',
                                'cdi' => '🔒 CDI',
                                'benevolat' => '🤝 Bénévolat',
                                'consultation' => '💼 Consultation',
                            ]),
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
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'ouverte' => '🟢 Ouverte',
                                'fermee' => '🔴 Fermée',
                                'en_cours' => '🟡 En cours de traitement',
                            ])
                            ->required()
                            ->default('ouverte'),
                        Toggle::make('is_published')
                            ->label('Publié'),
                    ]),
            ]);
    }
}

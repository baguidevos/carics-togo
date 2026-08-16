<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Expéditeur')
                    ->icon('heroicon-m-user')
                    ->columns(2)
                    ->schema([
                        ToggleButtons::make('form_type')
                            ->label('Type de formulaire')
                            ->options([
                                'general' => 'Général',
                                'collaboration' => 'Collaboration',
                                'stage' => 'Stage',
                                'presse' => 'Presse',
                            ])
                            ->icons([
                                'general' => 'heroicon-m-envelope',
                                'collaboration' => 'heroicon-m-user-plus',
                                'stage' => 'heroicon-m-academic-cap',
                                'presse' => 'heroicon-m-newspaper',
                            ])
                            ->inline()
                            ->required()
                            ->default('general')
                            ->disabled()
                            ->columnSpanFull(),
                        TextInput::make('full_name')
                            ->label('Nom complet')
                            ->required(),
                        TextInput::make('email')
                            ->label('Adresse email')
                            ->email()
                            ->required(),
                        TextInput::make('organisation')
                            ->label('Organisation'),
                    ]),

                Section::make('Message')
                    ->icon('heroicon-m-chat-bubble-left-right')
                    ->schema([
                        TextInput::make('subject')
                            ->label('Sujet'),
                        Textarea::make('message')
                            ->label('Contenu du message')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull(),
                        TextInput::make('file_path')
                            ->label('Fichier joint'),
                        Textarea::make('meta')
                            ->label('Métadonnées (JSON)')
                            ->columnSpanFull(),
                    ]),

                Section::make('Statut')
                    ->icon('heroicon-m-flag')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_read')
                            ->label('Lu'),
                        Toggle::make('is_archived')
                            ->label('Archivé'),
                    ]),
            ]);
    }
}

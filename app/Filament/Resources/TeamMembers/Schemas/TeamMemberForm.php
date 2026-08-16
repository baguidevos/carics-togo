<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identité')
                    ->icon('heroicon-m-user')
                    ->columns(2)
                    ->schema([
                        TextInput::make('full_name')
                            ->label('Nom complet')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('role_title')
                            ->label('Titre / Fonction')
                            ->required()
                            ->columnSpanFull(),
                        ToggleButtons::make('role_category')
                            ->label('Catégorie de membre')
                            ->options([
                                'bureau_executif' => 'Bureau Exécutif',
                                'conseil_scientifique' => 'Conseil Scientifique',
                                'equipe_technique' => 'Équipe Technique',
                                'doctorant' => 'Doctorant',
                                'partenaire_associe' => 'Partenaire Associé',
                            ])
                            ->icons([
                                'bureau_executif' => 'heroicon-m-user-group',
                                'conseil_scientifique' => 'heroicon-m-academic-cap',
                                'equipe_technique' => 'heroicon-m-wrench-screwdriver',
                                'doctorant' => 'heroicon-m-sparkles',
                                'partenaire_associe' => 'heroicon-m-building-office-2',
                            ])
                            ->inline()
                            ->default('bureau_executif')
                            ->columnSpanFull(),
                    ]),

                Section::make('Biographie & Compétences')
                    ->icon('heroicon-m-book-open')
                    ->collapsible()
                    ->schema([
                        Textarea::make('bio_short')
                            ->label('Biographie courte')
                            ->rows(3)
                            ->columnSpanFull(),
                        RichEditor::make('bio_full')
                            ->label('Biographie complète')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('team-attachments')
                            ->fileAttachmentsVisibility('public')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'h2', 'h3',
                                'bulletList', 'orderedList',
                                'link', 'blockquote', 'codeBlock', 'table',
                                'attachFiles',
                                'undo', 'redo',
                            ])
                            ->columnSpanFull(),
                        Textarea::make('mission_text')
                            ->label('Mission')
                            ->rows(2)
                            ->columnSpanFull(),
                        Textarea::make('expertises')
                            ->label('Domaines d\'expertise')
                            ->rows(2)
                            ->columnSpanFull(),
                        Textarea::make('education')
                            ->label('Formation')
                            ->rows(2)
                            ->columnSpanFull(),
                        Textarea::make('distinctions')
                            ->label('Distinctions')
                            ->rows(2)
                            ->columnSpanFull(),
                        Textarea::make('affiliations')
                            ->label('Affiliations')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),

                Section::make('Photo & Liens')
                    ->icon('heroicon-m-link')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->label('Photo de profil')
                            ->collection('avatar')
                            ->image()
                            ->avatar()
                            ->imageEditor()
                            ->columnSpanFull(),
                        TextInput::make('avatar_color')
                            ->label('Couleur avatar (fallback)')
                            ->required()
                            ->default('primary'),
                        TextInput::make('email')
                            ->label('Adresse email')
                            ->email(),
                        TextInput::make('linkedin_url')
                            ->label('LinkedIn')
                            ->url()
                            ->prefix('https://'),
                        TextInput::make('orcid_url')
                            ->label('ORCID')
                            ->url()
                            ->prefix('https://'),
                        TextInput::make('google_scholar_url')
                            ->label('Google Scholar')
                            ->url()
                            ->prefix('https://'),
                    ]),

                Section::make('Paramètres')
                    ->icon('heroicon-m-cog-6-tooth')
                    ->columns(3)
                    ->schema([
                        Toggle::make('is_founder')
                            ->label('Membre fondateur'),
                        Toggle::make('is_published')
                            ->label('Publié'),
                        TextInput::make('display_order')
                            ->label('Ordre d\'affichage')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}

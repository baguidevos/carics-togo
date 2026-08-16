<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use App\Models\ResearchProject;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
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
                Grid::make(['default' => 1, 'lg' => 3])
                    ->schema([
                        // ─── COLONNE PRINCIPALE (2/3) ───────────────────────────
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 2])
                            ->schema([
                                Section::make('Identité & Fonction')
                                    ->icon('heroicon-m-user')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('full_name')
                                            ->label('Nom complet & Titre honorifique')
                                            ->placeholder('Ex: Dr Gountante KOMBATE')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                                        TextInput::make('slug')
                                            ->label('Slug URL')
                                            ->required()
                                            ->unique(ignoreRecord: true),
                                        TextInput::make('role_title')
                                            ->label('Titre / Rôle officiel')
                                            ->placeholder('Ex: Président & Chercheur Principal')
                                            ->required(),
                                        TextInput::make('current_position')
                                            ->label('Poste / Affiliation principale actuelle')
                                            ->placeholder('Ex: Épidémiologiste, PhD Université d\'Utrecht'),
                                        ToggleButtons::make('role_category')
                                            ->label('Catégorie de membre')
                                            ->options([
                                                'bureau_executif' => 'Bureau Exécutif',
                                                'conseil_scientifique' => 'Conseil Scientifique',
                                                'chercheur_associe' => 'Chercheur Associé',
                                                'equipe_technique' => 'Équipe Technique',
                                                'doctorant' => 'Doctorant / Stagiaire',
                                                'partenaire_associe' => 'Partenaire Associé',
                                            ])
                                            ->icons([
                                                'bureau_executif' => 'heroicon-m-user-group',
                                                'conseil_scientifique' => 'heroicon-m-academic-cap',
                                                'chercheur_associe' => 'heroicon-m-beaker',
                                                'equipe_technique' => 'heroicon-m-wrench-screwdriver',
                                                'doctorant' => 'heroicon-m-sparkles',
                                                'partenaire_associe' => 'heroicon-m-building-office-2',
                                            ])
                                            ->inline()
                                            ->default('bureau_executif')
                                            ->columnSpanFull(),
                                        Select::make('related_project_slug')
                                            ->label('Projet de recherche associé (mis en avant sur le profil)')
                                            ->options(fn () => ResearchProject::pluck('title', 'slug')->toArray())
                                            ->searchable()
                                            ->preload()
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Biographie & Vision')
                                    ->icon('heroicon-m-book-open')
                                    ->collapsible()
                                    ->schema([
                                        Textarea::make('bio_short')
                                            ->label('Biographie courte (affichée sur les cartes d\'équipe)')
                                            ->placeholder('Résumé percutant en 2-3 phrases...')
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
                                        Textarea::make('bio_quote')
                                            ->label('Citation / Vision de recherche')
                                            ->placeholder('Citation marquante ou projet phare dirigé...')
                                            ->rows(2)
                                            ->columnSpanFull(),
                                        Textarea::make('mission_text')
                                            ->label('Mission au sein de CARICS-Togo')
                                            ->placeholder('Rôle stratégique et responsabilités au sein du centre...')
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Cursus Académique & Distinctions')
                                    ->icon('heroicon-m-academic-cap')
                                    ->collapsible()
                                    ->schema([
                                        Repeater::make('education')
                                            ->label('Formations & Diplômes universitaires')
                                            ->schema([
                                                TextInput::make('degree')
                                                    ->label('Diplôme')
                                                    ->placeholder('Ex: PhD, MD, MPH, Master')
                                                    ->required(),
                                                TextInput::make('field')
                                                    ->label('Discipline / Spécialité')
                                                    ->placeholder('Ex: Épidémiologie & Santé Mondiale'),
                                                TextInput::make('institution')
                                                    ->label('Université / École / Institution')
                                                    ->placeholder('Ex: Université d\'Utrecht (Pays-Bas)')
                                                    ->required(),
                                            ])
                                            ->columns(3)
                                            ->defaultItems(0)
                                            ->addActionLabel('Ajouter une formation')
                                            ->reorderable()
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => trim(($state['degree'] ?? '').' '.($state['field'] ?? '').' — '.($state['institution'] ?? '')) ?: 'Nouvelle formation')
                                            ->columnSpanFull(),

                                        Repeater::make('distinctions')
                                            ->label('Prix, Bourses & Distinctions scientifiques')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Intitulé de la distinction')
                                                    ->placeholder('Ex: Early Career Grant 2025')
                                                    ->required(),
                                                TextInput::make('organisation')
                                                    ->label('Organisme / Institution de délivrance')
                                                    ->placeholder('Ex: Royal Society of Tropical Medicine and Hygiene (RSTMH)')
                                                    ->required(),
                                                TextInput::make('year')
                                                    ->label('Année')
                                                    ->placeholder('Ex: 2025'),
                                            ])
                                            ->columns(3)
                                            ->defaultItems(0)
                                            ->addActionLabel('Ajouter une distinction')
                                            ->reorderable()
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => trim(($state['title'] ?? '').' — '.($state['organisation'] ?? '').' ('.($state['year'] ?? '').')') ?: 'Nouvelle distinction')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Domaines d\'Expertise & Affiliations')
                                    ->icon('heroicon-m-tag')
                                    ->collapsible()
                                    ->schema([
                                        TagsInput::make('expertises')
                                            ->label('Domaines d\'expertise')
                                            ->placeholder('Ajouter un domaine et appuyer sur Entrée')
                                            ->suggestions([
                                                'Épidémiologie et santé mondiale',
                                                'Paludisme et maladies infectieuses',
                                                'Sciences de la mise en œuvre',
                                                'Recherche opérationnelle',
                                                'Renforcement des systèmes de santé',
                                                'Santé communautaire',
                                                'Analyse spatiale et SIG',
                                                'Suivi-évaluation et utilisation des données',
                                                'Santé numérique et SIS',
                                            ])
                                            ->columnSpanFull(),

                                        TagsInput::make('affiliations')
                                            ->label('Affiliations institutionnelles & Partenariats passés')
                                            ->placeholder('Ajouter une institution et appuyer sur Entrée')
                                            ->suggestions([
                                                'RTI International',
                                                'John Snow, Inc. (JSI)',
                                                'Jhpiego / Johns Hopkins University',
                                                'FHI 360',
                                                'Institute of Tropical Medicine, Anvers',
                                                'Université d\'Utrecht',
                                                'Université Joseph Ki-Zerbo',
                                                'Ministère de la Santé du Togo',
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // ─── COLONNE LATÉRALE (1/3) ─────────────────────────────
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 1])
                            ->schema([
                                Section::make('Photo & Identité Visuelle')
                                    ->icon('heroicon-m-camera')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('avatar')
                                            ->label('Photo de profil officielle')
                                            ->collection('avatar')
                                            ->disk('public')
                                            ->image()
                                            ->avatar()
                                            ->imageEditor()
                                            ->columnSpanFull(),
                                        TextInput::make('photo')
                                            ->label('Nom du fichier photo local (fallback)')
                                            ->placeholder('Ex: Kombate.jpg')
                                            ->helperText('Utilisé si aucun avatar téléversé n\'est disponible.'),
                                        Select::make('avatar_color')
                                            ->label('Couleur d\'accentuation de l\'avatar')
                                            ->options([
                                                'primary' => 'Bleu CARICS (Principal)',
                                                'accent' => 'Vert Forêt (Accent)',
                                                'info' => 'Bleu Ciel (Info)',
                                                'success' => 'Vert Émeraude (Succès)',
                                                'warning' => 'Ocre / Jaune (Avertissement)',
                                                'danger' => 'Rouge / Brique',
                                            ])
                                            ->default('primary')
                                            ->required(),
                                    ]),

                                Section::make('Réseaux & Contact Scientifique')
                                    ->icon('heroicon-m-link')
                                    ->schema([
                                        TextInput::make('email')
                                            ->label('Adresse email professionnelle')
                                            ->placeholder('nom@carics-togo.org')
                                            ->email()
                                            ->prefixIcon('heroicon-m-envelope'),
                                        TextInput::make('orcid_url')
                                            ->label('Identifiant ORCID (URL complète)')
                                            ->placeholder('https://orcid.org/0000-0002-XXXX-XXXX')
                                            ->url()
                                            ->prefixIcon('heroicon-m-identification'),
                                        TextInput::make('google_scholar_url')
                                            ->label('Profil Google Scholar')
                                            ->placeholder('https://scholar.google.com/citations?user=...')
                                            ->url()
                                            ->prefixIcon('heroicon-m-academic-cap'),
                                        TextInput::make('linkedin_url')
                                            ->label('Profil LinkedIn')
                                            ->placeholder('https://linkedin.com/in/...')
                                            ->url()
                                            ->prefixIcon('heroicon-m-globe-alt'),
                                    ]),

                                Section::make('Publication & Visibilité')
                                    ->icon('heroicon-m-rocket-launch')
                                    ->schema([
                                        ToggleButtons::make('is_founder')
                                            ->label('Statut Membre Fondateur')
                                            ->boolean()
                                            ->default(false)
                                            ->required()
                                            ->inline(),
                                        ToggleButtons::make('is_published')
                                            ->label('Statut de publication')
                                            ->boolean()
                                            ->default(true)
                                            ->required()
                                            ->inline(),
                                        TextInput::make('display_order')
                                            ->label('Ordre d\'affichage')
                                            ->helperText('Les nombres les plus bas apparaissent en premier.')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}

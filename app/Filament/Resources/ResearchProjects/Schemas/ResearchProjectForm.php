<?php

namespace App\Filament\Resources\ResearchProjects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\FileAttachmentProviders\SpatieMediaLibraryFileAttachmentProvider;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ResearchProjectForm
{
    /**
     * Boutons de barre d'outils complets pour les éditeurs scientifiques.
     *
     * @var array<string>
     */
    private const FULL_TOOLBAR = [
        'bold',
        'italic',
        'underline',
        'strike',
        'h2',
        'h3',
        'bulletList',
        'orderedList',
        'link',
        'blockquote',
        'codeBlock',
        'table',
        'attachFiles',
        'undo',
        'redo',
    ];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Projet de recherche')
                    ->tabs([
                        // ── TAB 1 : Identification & Pilotage ──
                        Tab::make('🔬 Informations Générales')
                            ->icon('heroicon-m-academic-cap')
                            ->schema([
                                Grid::make(['default' => 1, 'lg' => 3])
                                    ->schema([
                                        // Bloc Principal (2 colonnes)
                                        Section::make('Détails du projet')
                                            ->description('Informations d\'identification et de financement')
                                            ->icon('heroicon-m-document-text')
                                            ->columnSpan(['default' => 1, 'lg' => 2])
                                            ->columns(2)
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Titre du projet')
                                                    ->placeholder('Ex: Étude d\'impact sur la santé communautaire...')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

                                                TextInput::make('slug')
                                                    ->label('Identifiant URL (Slug)')
                                                    ->prefix('projets/')
                                                    ->required()
                                                    ->unique(ignoreRecord: true)
                                                    ->columnSpanFull(),

                                                TextInput::make('funder')
                                                    ->label('Bailleur / Partenaire financier')
                                                    ->placeholder('Ex: OMS, USAID, Union Européenne...')
                                                    ->prefixIcon('heroicon-m-banknotes'),

                                                Select::make('lead_id')
                                                    ->label('Chef de projet scientifique')
                                                    ->relationship('lead', 'full_name')
                                                    ->searchable()
                                                    ->preload()
                                                    ->prefixIcon('heroicon-m-user-circle'),

                                                DatePicker::make('start_date')
                                                    ->label('Date de lancement')
                                                    ->native(false)
                                                    ->displayFormat('d/m/Y')
                                                    ->prefixIcon('heroicon-m-calendar'),

                                                DatePicker::make('end_date')
                                                    ->label('Date d\'achèvement prévue')
                                                    ->native(false)
                                                    ->displayFormat('d/m/Y')
                                                    ->prefixIcon('heroicon-m-calendar-days'),
                                            ]),

                                        // Bloc Latéral (1 colonne)
                                        Section::make('Statut & Visibilité')
                                            ->description('Contrôle de publication')
                                            ->icon('heroicon-m-check-badge')
                                            ->columnSpan(['default' => 1, 'lg' => 1])
                                            ->schema([
                                                Select::make('status')
                                                    ->label('État d\'avancement')
                                                    ->options([
                                                        'en_cours' => '🟢 En cours de réalisation',
                                                        'termine' => '🔵 Projet achevé',
                                                        'en_attente' => '🟡 En phase de préparation',
                                                        'suspendu' => '🔴 Suspendu',
                                                    ])
                                                    ->required()
                                                    ->default('en_cours'),

                                                TextInput::make('display_order')
                                                    ->label('Priorité d\'affichage')
                                                    ->helperText('Un chiffre bas apparaît en premier')
                                                    ->required()
                                                    ->numeric()
                                                    ->default(0),

                                                Toggle::make('is_published')
                                                    ->label('Publier sur le site')
                                                    ->helperText('Visible par le grand public')
                                                    ->default(true),

                                                Toggle::make('is_featured')
                                                    ->label('Mettre à la une')
                                                    ->helperText('Affiché en bannière d\'accueil')
                                                    ->default(false),
                                            ]),
                                    ]),
                            ]),

                        // ── TAB 2 : Contenu Scientifique ──
                        Tab::make('📋 Dossier Scientifique')
                            ->icon('heroicon-m-beaker')
                            ->schema([
                                Section::make('Contexte & Problématique')
                                    ->description('Présentation générale et justification du projet')
                                    ->icon('heroicon-m-newspaper')
                                    ->collapsible()
                                    ->schema([
                                        RichEditor::make('context')
                                            ->label('Contexte de l\'étude')
                                            ->placeholder('Décrivez le contexte institutionnel, géographique et sanitaire...')
                                            ->fileAttachmentProvider(
                                                SpatieMediaLibraryFileAttachmentProvider::make()
                                                    ->collection('content_attachments')
                                            )
                                            ->fileAttachmentsVisibility('public')
                                            ->toolbarButtons(self::FULL_TOOLBAR)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Objectifs & Méthodologie')
                                    ->description('Cadre méthodologique et buts recherchés')
                                    ->icon('heroicon-m-clipboard-document-check')
                                    ->collapsible()
                                    ->columns(1)
                                    ->schema([
                                        RichEditor::make('objective')
                                            ->label('Objectifs généraux & spécifiques')
                                            ->fileAttachmentProvider(
                                                SpatieMediaLibraryFileAttachmentProvider::make()
                                                    ->collection('content_attachments')
                                            )
                                            ->fileAttachmentsVisibility('public')
                                            ->toolbarButtons(self::FULL_TOOLBAR)
                                            ->columnSpanFull(),

                                        RichEditor::make('methodology')
                                            ->label('Protocole méthodologique')
                                            ->placeholder('Approche quantitative, qualitative, échantillonnage...')
                                            ->fileAttachmentProvider(
                                                SpatieMediaLibraryFileAttachmentProvider::make()
                                                    ->collection('content_attachments')
                                            )
                                            ->fileAttachmentsVisibility('public')
                                            ->toolbarButtons(self::FULL_TOOLBAR)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Résultats & Domaines d\'expertise')
                                    ->description('Impacts attendus et axes de recherche associés')
                                    ->icon('heroicon-m-chart-bar-square')
                                    ->collapsible()
                                    ->schema([
                                        RichEditor::make('expected_results')
                                            ->label('Résultats attendus & Livrables')
                                            ->fileAttachmentProvider(
                                                SpatieMediaLibraryFileAttachmentProvider::make()
                                                    ->collection('content_attachments')
                                            )
                                            ->fileAttachmentsVisibility('public')
                                            ->toolbarButtons(self::FULL_TOOLBAR)
                                            ->columnSpanFull(),

                                        RichEditor::make('research_domains')
                                            ->label('Thématiques de recherche couvertes')
                                            ->placeholder('Épidémiologie, Santé publique, Innovation communautaire...')
                                            ->fileAttachmentProvider(
                                                SpatieMediaLibraryFileAttachmentProvider::make()
                                                    ->collection('content_attachments')
                                            )
                                            ->fileAttachmentsVisibility('public')
                                            ->toolbarButtons(self::FULL_TOOLBAR)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // ── TAB 3 : Localisation & Géographie ──
                        Tab::make('📍 Zone Géographique')
                            ->icon('heroicon-m-map-pin')
                            ->schema([
                                Section::make('Implantation territoriale')
                                    ->description('Couverture spatiale et coordonnées géographiques')
                                    ->icon('heroicon-m-globe-alt')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('country')
                                                    ->label('Pays')
                                                    ->default('Togo')
                                                    ->required()
                                                    ->prefixIcon('heroicon-m-flag'),

                                                TextInput::make('region')
                                                    ->label('Région / District')
                                                    ->placeholder('Ex: Région Maritime, Plateaux, Kara...')
                                                    ->prefixIcon('heroicon-m-map'),

                                                TextInput::make('map_lat')
                                                    ->label('Latitude GPS')
                                                    ->placeholder('Ex: 6.1375')
                                                    ->numeric(),

                                                TextInput::make('map_lng')
                                                    ->label('Longitude GPS')
                                                    ->placeholder('Ex: 1.2123')
                                                    ->numeric(),
                                            ]),

                                        RichEditor::make('intervention_zones')
                                            ->label('Précisions sur les sites d\'intervention')
                                            ->placeholder('Listez les préfectures, cantons, villages ou centres de santé partenaires...')
                                            ->fileAttachmentProvider(
                                                SpatieMediaLibraryFileAttachmentProvider::make()
                                                    ->collection('content_attachments')
                                            )
                                            ->fileAttachmentsVisibility('public')
                                            ->toolbarButtons(self::FULL_TOOLBAR)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // ── TAB 4 : Médias & Documents ──
                        Tab::make('📁 Médias & Livrables')
                            ->icon('heroicon-m-photo')
                            ->schema([
                                Grid::make(['default' => 1, 'lg' => 2])
                                    ->schema([
                                        Section::make('Image de couverture')
                                            ->description('Visuel principal pour les cartes et bannières')
                                            ->icon('heroicon-m-photo')
                                            ->schema([
                                                SpatieMediaLibraryFileUpload::make('cover')
                                                    ->label('Visuel du projet')
                                                    ->collection('cover')
                                                    ->image()
                                                    ->imageEditor()
                                                    ->imageEditorAspectRatios([
                                                        '16:9',
                                                        '4:3',
                                                        '1:1',
                                                    ])
                                                    ->columnSpanFull(),
                                            ]),

                                        Section::make('Documents & Rapports joints')
                                            ->description('Protocoles, termes de référence, rapports intermédiaires')
                                            ->icon('heroicon-m-paper-clip')
                                            ->schema([
                                                SpatieMediaLibraryFileUpload::make('documents')
                                                    ->label('Fichiers PDF / Word / Excel')
                                                    ->collection('documents')
                                                    ->multiple()
                                                    ->downloadable()
                                                    ->openable()
                                                    ->maxFiles(10)
                                                    ->columnSpanFull(),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

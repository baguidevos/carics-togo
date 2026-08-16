<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\FileAttachmentProviders\SpatieMediaLibraryFileAttachmentProvider;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogPostForm
{
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
                Tabs::make('Article')
                    ->tabs([
                        Tab::make('📝 Rédaction & Contenu')
                            ->icon('heroicon-m-document-text')
                            ->schema([
                                Grid::make(['default' => 1, 'lg' => 3])
                                    ->schema([
                                        Section::make('Corps de l\'article')
                                            ->columnSpan(['default' => 1, 'lg' => 2])
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Titre de l\'article')
                                                    ->placeholder('Titre accrocheur...')
                                                    ->required()
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

                                                TextInput::make('slug')
                                                    ->label('Identifiant URL')
                                                    ->prefix('blog/')
                                                    ->required()
                                                    ->unique(ignoreRecord: true),

                                                Textarea::make('excerpt')
                                                    ->label('Résumé introductif (chapeau)')
                                                    ->placeholder('Bref résumé de l\'article affiché dans les cartes...')
                                                    ->rows(3)
                                                    ->columnSpanFull(),

                                                RichEditor::make('body')
                                                    ->label('Contenu complet')
                                                    ->required()
                                                    ->fileAttachmentProvider(
                                                        SpatieMediaLibraryFileAttachmentProvider::make()
                                                            ->collection('content_attachments')
                                                    )
                                                    ->fileAttachmentsVisibility('public')
                                                    ->toolbarButtons(self::FULL_TOOLBAR)
                                                    ->columnSpanFull(),
                                            ]),

                                        Section::make('Classification & Métriques')
                                            ->columnSpan(['default' => 1, 'lg' => 1])
                                            ->schema([
                                                Select::make('type')
                                                    ->label('Type de publication')
                                                    ->options([
                                                        'article' => '📄 Article standard',
                                                        'billet' => '✍️ Billet d\'opinion',
                                                        'tribune' => '🏛️ Tribune libre',
                                                        'interview' => '🎙️ Interview',
                                                    ])
                                                    ->required()
                                                    ->default('article'),

                                                Select::make('category_id')
                                                    ->label('Catégorie')
                                                    ->relationship('category', 'name')
                                                    ->searchable()
                                                    ->preload(),

                                                Select::make('research_project_id')
                                                    ->label('Projet de recherche associé')
                                                    ->relationship('researchProject', 'title')
                                                    ->searchable()
                                                    ->preload(),

                                                TextInput::make('reading_time_minutes')
                                                    ->label('Temps de lecture')
                                                    ->numeric()
                                                    ->suffix('min')
                                                    ->placeholder('Ex: 5'),
                                            ]),
                                    ]),
                            ]),

                        Tab::make('🖼️ Médias & Référencement')
                            ->icon('heroicon-m-photo')
                            ->schema([
                                Grid::make(['default' => 1, 'lg' => 2])
                                    ->schema([
                                        Section::make('Couverture & Illustration')
                                            ->description('Image principale de l\'article')
                                            ->schema([
                                                SpatieMediaLibraryFileUpload::make('cover')
                                                    ->label('Image de mise en avant')
                                                    ->collection('cover')
                                                    ->image()
                                                    ->imageEditor()
                                                    ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                                                    ->columnSpanFull(),
                                            ]),

                                        Section::make('Optimisation SEO')
                                            ->description('Balises pour Google et réseaux sociaux')
                                            ->schema([
                                                TextInput::make('meta_title')
                                                    ->label('Titre SEO')
                                                    ->placeholder('Titre dans les moteurs de recherche'),

                                                Textarea::make('meta_description')
                                                    ->label('Description SEO')
                                                    ->placeholder('Description pour les partages et snippets...')
                                                    ->rows(3),

                                                Textarea::make('references')
                                                    ->label('Sources & Références')
                                                    ->placeholder('Notes bibliographiques ou liens vers les études citées...')
                                                    ->rows(3),
                                            ]),
                                    ]),
                            ]),

                        Tab::make('🚀 Publication & Auteurs')
                            ->icon('heroicon-m-rocket-launch')
                            ->schema([
                                Section::make('Diffusion')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('author_id')
                                            ->label('Auteur principal')
                                            ->relationship('author', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->prefixIcon('heroicon-m-user'),

                                        Select::make('status')
                                            ->label('État de publication')
                                            ->options([
                                                'brouillon' => '🔘 Brouillon',
                                                'en_revision' => '🟡 En relecture',
                                                'publie' => '🟢 Publié immédiatement',
                                                'archive' => '⚫ Archivé',
                                            ])
                                            ->required()
                                            ->default('brouillon'),

                                        DateTimePicker::make('published_at')
                                            ->label('Date & Heure de publication')
                                            ->native(false)
                                            ->displayFormat('d/m/Y H:i'),

                                        Toggle::make('is_featured')
                                            ->label('Épingler en haut du blog')
                                            ->helperText('Mettre en avant sur la page d\'accueil du blog')
                                            ->default(false),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

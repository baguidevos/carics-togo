<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Article')
                    ->tabs([
                        Tab::make('📝 Contenu')
                            ->icon('heroicon-m-document-text')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Titre')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                                TextInput::make('slug')
                                    ->label('Slug URL')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Select::make('type')
                                    ->label('Type d\'article')
                                    ->options([
                                        'article' => 'Article',
                                        'billet' => 'Billet de blog',
                                        'tribune' => 'Tribune',
                                        'interview' => 'Interview',
                                    ])
                                    ->required()
                                    ->default('article'),
                                Textarea::make('excerpt')
                                    ->label('Résumé / Chapeau')
                                    ->rows(3)
                                    ->columnSpanFull(),
                                RichEditor::make('body')
                                    ->label('Contenu de l\'article')
                                    ->required()
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike',
                                        'h2', 'h3',
                                        'bulletList', 'orderedList',
                                        'link', 'blockquote', 'codeBlock',
                                        'undo', 'redo',
                                    ])
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('🖼️ Médias & SEO')
                            ->icon('heroicon-m-photo')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('cover')
                                    ->label('Image de couverture')
                                    ->collection('cover')
                                    ->image()
                                    ->imageEditor()
                                    ->columnSpanFull(),
                                Section::make('SEO')
                                    ->description('Optimisation pour les moteurs de recherche')
                                    ->icon('heroicon-m-magnifying-glass')
                                    ->schema([
                                        TextInput::make('meta_title')
                                            ->label('Titre SEO')
                                            ->placeholder('Titre affiché dans Google'),
                                        TextInput::make('meta_description')
                                            ->label('Description SEO')
                                            ->placeholder('Description affichée dans Google'),
                                    ]),
                            ]),

                        Tab::make('🚀 Publication')
                            ->icon('heroicon-m-rocket-launch')
                            ->schema([
                                Select::make('author_id')
                                    ->label('Auteur')
                                    ->relationship('author', 'name')
                                    ->searchable()
                                    ->preload(),
                                Select::make('category_id')
                                    ->label('Catégorie')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload(),
                                Select::make('research_project_id')
                                    ->label('Projet de recherche lié')
                                    ->relationship('researchProject', 'title')
                                    ->searchable()
                                    ->preload(),
                                TextInput::make('reading_time_minutes')
                                    ->label('Temps de lecture (min)')
                                    ->numeric()
                                    ->suffix('min'),
                                Textarea::make('references')
                                    ->label('Références bibliographiques')
                                    ->rows(3)
                                    ->columnSpanFull(),
                                Select::make('status')
                                    ->label('Statut')
                                    ->options([
                                        'brouillon' => '🔘 Brouillon',
                                        'en_revision' => '🟡 En révision',
                                        'publie' => '🟢 Publié',
                                        'archive' => '⚫ Archivé',
                                    ])
                                    ->required()
                                    ->default('brouillon'),
                                DateTimePicker::make('published_at')
                                    ->label('Date de publication'),
                                Toggle::make('is_featured')
                                    ->label('Mettre en avant')
                                    ->helperText('Afficher cet article en page d\'accueil'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

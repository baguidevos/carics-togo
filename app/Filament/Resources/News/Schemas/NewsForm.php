<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(4)
                    ->columnSpanFull()
                    ->schema([
                        // ─── COLONNE GAUCHE (Contenu Principal) ───────────────
                        Section::make('Informations principales')
                            ->icon('heroicon-m-megaphone')
                            ->columnSpan(['default' => 1, 'lg' => 2])
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
                                TextInput::make('event_date')
                                    ->label('Date ou Période de l\'événement')
                                    ->placeholder('Ex: 28–30 juillet 2027 ou Du 30 juillet au 10 août 2027')
                                    ->helperText('Période réelle de déroulement de l\'activité sur le terrain.'),
                                TextInput::make('location')
                                    ->label('Lieu de l\'événement')
                                    ->placeholder('Ex: Cinkassé, Région des Savanes, Togo')
                                    ->helperText('Ville, district ou région où s\'est déroulée l\'activité.'),
                                Textarea::make('excerpt')
                                    ->label('Résumé / Chapeau')
                                    ->rows(3)
                                    ->columnSpanFull(),
                                RichEditor::make('content')
                                    ->label('Contenu')
                                    ->required()
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('news-attachments')
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
                                SpatieMediaLibraryFileUpload::make('cover')
                                    ->label('Image de couverture principale')
                                    ->collection('cover')
                                    ->disk('public')
                                    ->image()
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ]),

                        // ─── COLONNE DROITE (Publication & Galerie du même côté) ───
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 2])
                            ->schema([
                                Section::make('Publication & Visibilité')
                                    ->icon('heroicon-m-rocket-launch')
                                    ->schema([
                                        Select::make('category_id')
                                            ->label('Catégorie')
                                            ->relationship('category', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required(),
                                        TextInput::make('blog_post_id')
                                            ->label('Article de blog lié (ID)')
                                            ->numeric(),
                                        DatePicker::make('published_date')
                                            ->label('Date de publication')
                                            ->default(now())
                                            ->required(),
                                        ToggleButtons::make('is_featured')
                                            ->label('Mise en avant')
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
                                    ]),

                                Section::make('Galerie de photos')
                                    ->icon('heroicon-m-photo')
                                    ->description('Ajoutez plusieurs clichés de mission ou terrain.')
                                    ->collapsible()
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('gallery')
                                            ->label('Photos de la galerie')
                                            ->collection('gallery')
                                            ->disk('public')
                                            ->multiple()
                                            ->reorderable()
                                            ->image()
                                            ->imageEditor()
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}

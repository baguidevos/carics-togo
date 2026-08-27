<?php

namespace App\Filament\Resources\PageBanners\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PageBannersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('cover')
                    ->label('Visuel')
                    ->collection('cover')
                    ->disk('public')
                    ->defaultImageUrl(fn ($record) => $record->image ? asset($record->image) : null)
                    ->width('90px')
                    ->height('55px'),

                TextColumn::make('page_key')
                    ->label('Page')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'about' => 'À propos de nous',
                        'research' => 'Recherche, Expertise & Projets',
                        'resources_publications' => 'Ressources & Publications',
                        'news_opportunities' => 'Actualités & Opportunités',
                        'team' => 'Notre Équipe & Gouvernance',
                        'contact' => 'Contact & Partenariats',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Titre personnalisé')
                    ->placeholder('(Titre par défaut de la page)')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('layout_type')
                    ->label('Format')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'split' => 'warning',
                        default => 'primary',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'split' => 'Split (2 col.)',
                        default => 'Plein écran',
                    }),

                TextColumn::make('hero_media_type')
                    ->label('Média')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'slider' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'slider' => 'Slider',
                        default => 'Image',
                    }),

                ToggleColumn::make('is_active')
                    ->label('Actif'),

                TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

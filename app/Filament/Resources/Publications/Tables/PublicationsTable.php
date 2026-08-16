<?php

namespace App\Filament\Resources\Publications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PublicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('published_date', 'desc')
            ->striped()
            ->columns([
                SpatieMediaLibraryImageColumn::make('cover')
                    ->label('')
                    ->collection('cover')
                    ->circular(),
                TextColumn::make('title')
                    ->label('Titre')
                    ->limit(50)
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'article_scientifique' => 'primary',
                        'rapport_technique' => 'success',
                        'note_politique' => 'warning',
                        'these', 'memoire' => 'info',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('journal_or_publisher')
                    ->label('Revue / Éditeur')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('published_date')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'publie' => 'success',
                        'a_paraitre' => 'warning',
                        'en_revision' => 'info',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('researchProject.title')
                    ->label('Projet associé')
                    ->limit(30)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('external_co_authors')
                    ->label('Co-auteurs')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('external_url')
                    ->label('Lien externe')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'article_scientifique' => 'Article scientifique',
                        'rapport_technique' => 'Rapport technique',
                        'note_politique' => 'Note politique',
                        'these' => 'Thèse',
                        'memoire' => 'Mémoire',
                    ]),
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'publie' => 'Publié',
                        'a_paraitre' => 'À paraître',
                        'en_revision' => 'En révision',
                    ]),
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

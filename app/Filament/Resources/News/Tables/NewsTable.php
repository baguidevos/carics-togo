<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class NewsTable
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
                TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                TextColumn::make('published_date')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->label('⭐')
                    ->boolean(),
                IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('blog_post_id')
                    ->label('Article lié')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Mis à jour le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Catégorie')
                    ->relationship('category', 'name'),
                TernaryFilter::make('is_published')
                    ->label('Publication')
                    ->trueLabel('Publié')
                    ->falseLabel('Brouillon / Non publié'),
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

<?php

namespace App\Filament\Resources\HeroSlides\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class HeroSlidesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('display_order')
            ->defaultSort('display_order', 'asc')
            ->columns([
                TextColumn::make('display_order')
                    ->label('#')
                    ->sortable()
                    ->width('50px'),

                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Visuel')
                    ->collection('image')
                    ->disk('public')
                    ->defaultImageUrl(fn ($record) => $record->image ? asset($record->image) : null)
                    ->width('90px')
                    ->height('55px'),

                TextColumn::make('badge')
                    ->label('Badge')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->limit(25),

                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->limit(45)
                    ->weight('bold'),

                TextColumn::make('primary_cta_label')
                    ->label('Bouton CTA')
                    ->badge()
                    ->color('success')
                    ->limit(20),

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

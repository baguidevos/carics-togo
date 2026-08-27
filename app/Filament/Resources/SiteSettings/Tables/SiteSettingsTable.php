<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultGroup('group')
            ->defaultSort('display_order', 'asc')
            ->columns([
                TextColumn::make('group')
                    ->label('Groupe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'contact' => 'success',
                        'social' => 'info',
                        'general' => 'primary',
                        'seo' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'contact' => '📞 Contact',
                        'social' => '🌐 Réseaux Sociaux',
                        'general' => '🏢 Général',
                        'seo' => '🔍 SEO',
                        default => ucfirst($state),
                    })
                    ->sortable(),

                TextColumn::make('label')
                    ->label('Libellé')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('key')
                    ->label('Clé (key)')
                    ->fontFamily('mono')
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                TextColumn::make('value')
                    ->label('Valeur configurée')
                    ->limit(50)
                    ->placeholder('(Non défini)')
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('display_order')
                    ->label('Ordre')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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

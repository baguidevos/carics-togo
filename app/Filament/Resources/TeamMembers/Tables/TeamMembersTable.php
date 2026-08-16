<?php

namespace App\Filament\Resources\TeamMembers\Tables;

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

class TeamMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('display_order', 'asc')
            ->striped()
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->label('')
                    ->collection('avatar')
                    ->circular(),
                TextColumn::make('full_name')
                    ->label('Nom complet')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('role_title')
                    ->label('Fonction')
                    ->searchable(),
                TextColumn::make('role_category')
                    ->label('Catégorie')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bureau_executif' => 'primary',
                        'conseil_scientifique' => 'info',
                        'equipe_technique' => 'success',
                        'doctorant' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'bureau_executif' => 'Bureau Exécutif',
                        'conseil_scientifique' => 'Conseil Scientifique',
                        'equipe_technique' => 'Équipe Technique',
                        'doctorant' => 'Doctorant',
                        'partenaire_associe' => 'Partenaire Associé',
                        default => $state,
                    })
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->searchable(),
                IconColumn::make('is_founder')
                    ->label('Fondateur')
                    ->boolean(),
                IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean(),
                TextColumn::make('display_order')
                    ->label('Ordre')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role_category')
                    ->label('Catégorie')
                    ->options([
                        'bureau_executif' => 'Bureau Exécutif',
                        'conseil_scientifique' => 'Conseil Scientifique',
                        'equipe_technique' => 'Équipe Technique',
                        'doctorant' => 'Doctorant',
                        'partenaire_associe' => 'Partenaire Associé',
                    ]),
                TernaryFilter::make('is_published')
                    ->label('Publication')
                    ->trueLabel('Publié')
                    ->falseLabel('Non publié'),
                TernaryFilter::make('is_founder')
                    ->label('Fondateur')
                    ->trueLabel('Fondateur')
                    ->falseLabel('Autre membre'),
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

<?php

namespace App\Filament\Resources\ResearchProjects\Tables;

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

class ResearchProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('display_order', 'asc')
            ->striped()
            ->columns([
                SpatieMediaLibraryImageColumn::make('cover')
                    ->label('')
                    ->collection('cover')
                    ->circular(),
                TextColumn::make('title')
                    ->label('Titre')
                    ->limit(45)
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'en_cours' => 'success',
                        'termine' => 'info',
                        'en_attente' => 'warning',
                        'suspendu' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('lead.full_name')
                    ->label('Responsable')
                    ->searchable(),
                TextColumn::make('funder')
                    ->label('Bailleur')
                    ->limit(25)
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Début')
                    ->date('m/Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Fin')
                    ->date('m/Y')
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->label('⭐')
                    ->boolean(),
                IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean(),
                TextColumn::make('region')
                    ->label('Région')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('display_order')
                    ->label('Ordre')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'en_cours' => 'En cours',
                        'termine' => 'Terminé',
                        'en_attente' => 'En attente',
                        'suspendu' => 'Suspendu',
                    ]),
                TernaryFilter::make('is_published')
                    ->label('Publication')
                    ->trueLabel('Publié')
                    ->falseLabel('Non publié'),
                TernaryFilter::make('is_featured')
                    ->label('Mis en avant')
                    ->trueLabel('Oui')
                    ->falseLabel('Non'),
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

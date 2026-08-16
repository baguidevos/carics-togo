<?php

namespace App\Filament\Resources\Opportunities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class OpportunitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('deadline', 'asc')
            ->striped()
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->limit(50)
                    ->weight('bold'),
                TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                TextColumn::make('contract_type')
                    ->label('Contrat')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'stage' => 'info',
                        'cdd' => 'warning',
                        'cdi' => 'success',
                        'benevolat' => 'gray',
                        'consultation' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('location')
                    ->label('Lieu')
                    ->icon('heroicon-m-map-pin')
                    ->searchable(),
                TextColumn::make('deadline')
                    ->label('Date limite')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color(fn (?string $state): string => $state && Carbon::parse($state)->diffInDays(now()) < 7 ? 'danger' : 'gray'),
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ouverte' => 'success',
                        'fermee' => 'danger',
                        'en_cours' => 'warning',
                        default => 'gray',
                    }),
                IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean(),
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
                        'ouverte' => 'Ouverte',
                        'fermee' => 'Fermée',
                        'en_cours' => 'En cours',
                    ]),
                SelectFilter::make('contract_type')
                    ->label('Type de contrat')
                    ->options([
                        'stage' => 'Stage',
                        'cdd' => 'CDD',
                        'cdi' => 'CDI',
                        'benevolat' => 'Bénévolat',
                        'consultation' => 'Consultation',
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

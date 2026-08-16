<?php

namespace App\Filament\Resources\ContactSubmissions\Tables;

use App\Models\ContactSubmission;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContactSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->columns([
                TextColumn::make('form_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'general' => 'primary',
                        'collaboration' => 'success',
                        'stage' => 'info',
                        'presse' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('full_name')
                    ->label('Nom')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->searchable(),
                TextColumn::make('subject')
                    ->label('Sujet')
                    ->limit(40)
                    ->searchable(),
                IconColumn::make('is_read')
                    ->label('Lu')
                    ->boolean(),
                IconColumn::make('is_archived')
                    ->label('Archivé')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Reçu le')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('form_type')
                    ->label('Type')
                    ->options([
                        'general' => 'Général',
                        'collaboration' => 'Collaboration',
                        'stage' => 'Stage',
                        'presse' => 'Presse',
                    ]),
                TernaryFilter::make('is_read')
                    ->label('Lecture')
                    ->trueLabel('Lu')
                    ->falseLabel('Non lu'),
                TernaryFilter::make('is_archived')
                    ->label('Archivé')
                    ->trueLabel('Archivé')
                    ->falseLabel('Actif'),
            ])
            ->recordActions([
                Action::make('markAsRead')
                    ->label('Marquer lu')
                    ->icon('heroicon-m-check')
                    ->color('success')
                    ->action(fn (ContactSubmission $record) => $record->update(['is_read' => true]))
                    ->hidden(fn (ContactSubmission $record) => $record->is_read),
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

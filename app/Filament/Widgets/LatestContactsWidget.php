<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use Filament\Actions\Action as ActionsAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestContactsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = '📬 Derniers messages reçus';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactSubmission::query()
                    ->where('is_read', false)
                    ->latest()
                    ->limit(5)
            )
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
                    ->icon('heroicon-m-envelope'),
                TextColumn::make('subject')
                    ->label('Sujet')
                    ->limit(40),
                TextColumn::make('created_at')
                    ->label('Reçu le')
                    ->since()
                    ->sortable(),
            ])
            ->recordActions([
                ActionsAction::make('markAsRead')
                    ->label('Marquer lu')
                    ->icon('heroicon-m-check')
                    ->color('success')
                    ->action(fn (ContactSubmission $record) => $record->update(['is_read' => true])),
            ])
            ->paginated(false);
    }
}

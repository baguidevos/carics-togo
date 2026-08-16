<?php

namespace App\Filament\Widgets;

use App\Models\Publication;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPublicationsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = '📄 Dernières publications ajoutées';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Publication::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'article_scientifique' => 'primary',
                        'rapport_technique' => 'success',
                        'note_politique' => 'warning',
                        'these', 'memoire' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('title')
                    ->label('Titre')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('journal_or_publisher')
                    ->label('Revue / Éditeur')
                    ->limit(30),
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
                    }),
            ])
            ->paginated(false);
    }
}

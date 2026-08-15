<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TeamMemberInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('full_name'),
                TextEntry::make('slug'),
                TextEntry::make('role_title'),
                TextEntry::make('role_category')
                    ->placeholder('-'),
                TextEntry::make('bio_short')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('bio_full')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('mission_text')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('expertises')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('education')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('distinctions')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('affiliations')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('photo')
                    ->placeholder('-'),
                TextEntry::make('avatar_color'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('linkedin_url')
                    ->placeholder('-'),
                TextEntry::make('orcid_url')
                    ->placeholder('-'),
                TextEntry::make('google_scholar_url')
                    ->placeholder('-'),
                IconEntry::make('is_founder')
                    ->boolean(),
                IconEntry::make('is_published')
                    ->boolean(),
                TextEntry::make('display_order')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

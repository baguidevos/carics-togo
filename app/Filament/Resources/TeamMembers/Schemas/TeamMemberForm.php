<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('role_title')
                    ->required(),
                TextInput::make('role_category')
                    ->default('bureau_executif'),
                Textarea::make('bio_short')
                    ->columnSpanFull(),
                Textarea::make('bio_full')
                    ->columnSpanFull(),
                Textarea::make('mission_text')
                    ->columnSpanFull(),
                Textarea::make('expertises')
                    ->columnSpanFull(),
                Textarea::make('education')
                    ->columnSpanFull(),
                Textarea::make('distinctions')
                    ->columnSpanFull(),
                Textarea::make('affiliations')
                    ->columnSpanFull(),
                TextInput::make('photo'),
                TextInput::make('avatar_color')
                    ->required()
                    ->default('primary'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('linkedin_url')
                    ->url(),
                TextInput::make('orcid_url')
                    ->url(),
                TextInput::make('google_scholar_url')
                    ->url(),
                Toggle::make('is_founder')
                    ->required(),
                Toggle::make('is_published')
                    ->required(),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}

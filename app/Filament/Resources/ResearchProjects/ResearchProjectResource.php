<?php

namespace App\Filament\Resources\ResearchProjects;

use App\Filament\Resources\ResearchProjects\Pages\CreateResearchProject;
use App\Filament\Resources\ResearchProjects\Pages\EditResearchProject;
use App\Filament\Resources\ResearchProjects\Pages\ListResearchProjects;
use App\Filament\Resources\ResearchProjects\Pages\ViewResearchProject;
use App\Filament\Resources\ResearchProjects\Schemas\ResearchProjectForm;
use App\Filament\Resources\ResearchProjects\Schemas\ResearchProjectInfolist;
use App\Filament\Resources\ResearchProjects\Tables\ResearchProjectsTable;
use App\Models\ResearchProject;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class ResearchProjectResource extends Resource
{
    protected static ?string $model = ResearchProject::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static string|UnitEnum|null $navigationGroup = '🔬 Recherche & Projets';

    protected static ?string $navigationLabel = 'Projets de recherche';

    protected static ?string $modelLabel = 'Projet de recherche';

    protected static ?string $pluralModelLabel = 'Projets de recherche';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ResearchProjectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ResearchProjectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResearchProjectsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResearchProjects::route('/'),
            'create' => CreateResearchProject::route('/create'),
            'view' => ViewResearchProject::route('/{record}'),
            'edit' => EditResearchProject::route('/{record}/edit'),
        ];
    }
}

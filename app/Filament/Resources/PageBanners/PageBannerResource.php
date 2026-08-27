<?php

namespace App\Filament\Resources\PageBanners;

use App\Filament\Resources\PageBanners\Pages\CreatePageBanner;
use App\Filament\Resources\PageBanners\Pages\EditPageBanner;
use App\Filament\Resources\PageBanners\Pages\ListPageBanners;
use App\Filament\Resources\PageBanners\Pages\ViewPageBanner;
use App\Filament\Resources\PageBanners\Schemas\PageBannerForm;
use App\Filament\Resources\PageBanners\Schemas\PageBannerInfolist;
use App\Filament\Resources\PageBanners\Tables\PageBannersTable;
use App\Models\PageBanner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use UnitEnum;

class PageBannerResource extends Resource
{
    use Translatable;

    protected static ?string $model = PageBanner::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static string|UnitEnum|null $navigationGroup = '⚙️ Paramètres & Structure';

    protected static ?string $navigationLabel = 'Bannières des Pages';

    protected static ?string $modelLabel = 'Bannière de Page';

    protected static ?string $pluralModelLabel = 'Bannières des Pages';

    protected static ?string $recordTitleAttribute = 'page_key';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return PageBannerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PageBannerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PageBannersTable::configure($table);
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
            'index' => ListPageBanners::route('/'),
            'create' => CreatePageBanner::route('/create'),
            'view' => ViewPageBanner::route('/{record}'),
            'edit' => EditPageBanner::route('/{record}/edit'),
        ];
    }
}

<?php

namespace Modules\Listing\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Listing\Filament\Admin\Resources\ListingResource\Pages;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\Filament\AdminListingResourceSchema;
use UnitEnum;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static string|UnitEnum|null $navigationGroup = 'Catalog';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema(AdminListingResourceSchema::form());
    }

    public static function table(Table $table): Table
    {
        return AdminListingResourceSchema::configureTable($table, static::class);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'activities' => Pages\ListListingActivities::route('/{record}/activities'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}

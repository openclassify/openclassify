<?php

namespace Modules\Location\Filament\Admin\Resources;

use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Admin\Support\Filament\ResourceTableActions;
use Modules\Admin\Support\Filament\ResourceTableColumns;
use Modules\Location\Filament\Admin\Resources\CountryResource\Pages;
use Modules\Location\Models\Country;
use UnitEnum;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-globe-alt';

    protected static string|UnitEnum|null $navigationGroup = 'Location';

    protected static ?string $label = 'Country';

    protected static ?string $pluralLabel = 'Countries';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required()->maxLength(100),
            TextInput::make('code')->required()->maxLength(3)->unique(ignoreRecord: true),
            TextInput::make('phone_code')->maxLength(10),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ResourceTableColumns::id(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('code')->searchable()->sortable(),
            TextColumn::make('phone_code'),
            TextColumn::make('cities_count')->counts('cities')->label('Cities')->sortable(),
            ResourceTableColumns::activeIcon(),
            ResourceTableColumns::createdAtHidden(),
        ])->defaultSort('id', 'desc')->filters([
            SelectFilter::make('code')
                ->label('Code')
                ->options(fn (): array => Country::codeOptions()),
            TernaryFilter::make('has_cities')
                ->label('Has cities')
                ->queries(
                    true: fn (Builder $query): Builder => $query->has('cities'),
                    false: fn (Builder $query): Builder => $query->doesntHave('cities'),
                    blank: fn (Builder $query): Builder => $query,
                ),
            TernaryFilter::make('is_active')->label('Active'),
        ])->actions(ResourceTableActions::editActivityDelete(static::class));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'activities' => Pages\ListCountryActivities::route('/{record}/activities'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}

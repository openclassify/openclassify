<?php

namespace Modules\Location\Filament\Admin\Resources;

use BackedEnum;
use Filament\Forms\Components\Select;
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
use Modules\Location\Filament\Admin\Resources\CityResource\Pages;
use Modules\Location\Models\City;
use UnitEnum;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static string|UnitEnum|null $navigationGroup = 'Location';

    protected static ?string $label = 'City';

    protected static ?string $pluralLabel = 'Cities';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required()->maxLength(120),
            Select::make('country_id')->relationship('country', 'name')->label('Country')->searchable()->preload()->required(),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ResourceTableColumns::id(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('country.name')->label('Country')->searchable()->sortable(),
            TextColumn::make('districts_count')->counts('districts')->label('Districts')->sortable(),
            ResourceTableColumns::activeIcon(),
            ResourceTableColumns::createdAtHidden(),
        ])->defaultSort('id', 'desc')->filters([
            SelectFilter::make('country_id')
                ->label('Country')
                ->relationship('country', 'name')
                ->searchable()
                ->preload(),
            TernaryFilter::make('has_districts')
                ->label('Has districts')
                ->queries(
                    true: fn (Builder $query): Builder => $query->has('districts'),
                    false: fn (Builder $query): Builder => $query->doesntHave('districts'),
                    blank: fn (Builder $query): Builder => $query,
                ),
            TernaryFilter::make('is_active')->label('Active'),
        ])->actions(ResourceTableActions::editActivityDelete(static::class));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'activities' => Pages\ListCityActivities::route('/{record}/activities'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}

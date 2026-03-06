<?php
namespace Modules\Admin\Filament\Resources;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Modules\Admin\Filament\Resources\CityResource\Pages;
use Modules\Location\Models\City;
use UnitEnum;

class CityResource extends Resource
{
    protected static ?string $model = City::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';
    protected static string | UnitEnum | null $navigationGroup = 'Settings';
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
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('country.name')->label('Country')->searchable()->sortable(),
            TextColumn::make('districts_count')->counts('districts')->label('Districts')->sortable(),
            IconColumn::make('is_active')->boolean(),
            TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        ])->defaultSort('id', 'desc')->filters([
            SelectFilter::make('country_id')
                ->label('Country')
                ->relationship('country', 'name')
                ->searchable()
                ->preload(),
            TernaryFilter::make('is_active')->label('Active'),
        ])->actions([
            EditAction::make(),
            Action::make('activities')
                ->icon('heroicon-o-clock')
                ->url(fn (City $record): string => static::getUrl('activities', ['record' => $record])),
            DeleteAction::make(),
        ]);
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

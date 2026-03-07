<?php
namespace Modules\Admin\Filament\Resources;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Admin\Filament\Resources\LocationResource\Pages;
use Modules\Location\Models\Country;
use UnitEnum;

class LocationResource extends Resource
{
    protected static ?string $model = Country::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-globe-alt';
    protected static string | UnitEnum | null $navigationGroup = 'Location';
    protected static ?string $label = 'Country';
    protected static ?string $pluralLabel = 'Countries';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required()->maxLength(100),
            TextInput::make('code')->required()->maxLength(2)->unique(ignoreRecord: true),
            TextInput::make('phone_code')->maxLength(10),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('code')->searchable()->sortable(),
            TextColumn::make('phone_code'),
            TextColumn::make('cities_count')->counts('cities')->label('Cities')->sortable(),
            IconColumn::make('is_active')->boolean(),
            TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        ])->defaultSort('id', 'desc')->filters([
            SelectFilter::make('code')
                ->label('Code')
                ->options(fn (): array => Country::query()->orderBy('code')->pluck('code', 'code')->all()),
            TernaryFilter::make('has_cities')
                ->label('Has cities')
                ->queries(
                    true: fn (Builder $query): Builder => $query->has('cities'),
                    false: fn (Builder $query): Builder => $query->doesntHave('cities'),
                    blank: fn (Builder $query): Builder => $query,
                ),
            TernaryFilter::make('is_active')->label('Active'),
        ])->actions([
            EditAction::make(),
            Action::make('activities')
                ->icon('heroicon-o-clock')
                ->url(fn (Country $record): string => static::getUrl('activities', ['record' => $record])),
            DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'activities' => Pages\ListLocationActivities::route('/{record}/activities'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}

<?php

namespace Modules\Listing\Filament\Admin\Resources;

use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Admin\Support\Filament\ResourceTableActions;
use Modules\Category\Models\Category;
use Modules\Listing\Filament\Admin\Resources\ListingCustomFieldResource\Pages;
use Modules\Listing\Models\ListingCustomField;
use UnitEnum;

class ListingCustomFieldResource extends Resource
{
    protected static ?string $model = ListingCustomField::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static string|UnitEnum|null $navigationGroup = 'Catalog';

    protected static ?int $navigationSort = 30;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('label')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(function ($state, $set, ?ListingCustomField $record): void {
                    $set('name', ListingCustomField::uniqueNameFromLabel((string) $state, $record));
                }),
            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->regex('/^[a-z0-9_]+$/')
                ->helperText('Only lowercase letters, numbers and underscore.')
                ->unique(ignoreRecord: true),
            Select::make('type')
                ->required()
                ->options(ListingCustomField::typeOptions())
                ->live(),
            Select::make('category_id')
                ->label('Category')
                ->options(fn (): array => Category::activeIdNameOptions())
                ->searchable()
                ->preload()
                ->nullable()
                ->helperText('Leave empty to apply this field to all categories.'),
            TagsInput::make('options')
                ->label('Select Options')
                ->placeholder('Add an option and press Enter')
                ->visible(fn ($get): bool => $get('type') === ListingCustomField::TYPE_SELECT)
                ->helperText('Used only for Select type fields.'),
            TextInput::make('sort_order')
                ->numeric()
                ->default(0),
            TextInput::make('placeholder')
                ->maxLength(255),
            Textarea::make('help_text')
                ->rows(2)
                ->maxLength(500),
            Toggle::make('is_required')
                ->default(false),
            Toggle::make('is_active')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('label')->searchable()->sortable(),
                TextColumn::make('name')->searchable()->copyable(),
                TextColumn::make('type')->sortable(),
                TextColumn::make('category.name')->label('Category')->default('All categories'),
                IconColumn::make('is_required')->boolean()->label('Required'),
                IconColumn::make('is_active')->boolean()->label('Active'),
                TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->actions(ResourceTableActions::editDelete());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListingCustomFields::route('/'),
            'create' => Pages\CreateListingCustomField::route('/create'),
            'edit' => Pages\EditListingCustomField::route('/{record}/edit'),
        ];
    }
}

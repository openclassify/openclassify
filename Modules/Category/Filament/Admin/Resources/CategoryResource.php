<?php

namespace Modules\Category\Filament\Admin\Resources;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Admin\Support\Filament\ResourceTableActions;
use Modules\Admin\Support\Filament\ResourceTableColumns;
use Modules\Category\Models\Category;
use Modules\Category\Filament\Admin\Resources\CategoryResource\Pages;
use UnitEnum;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static string|UnitEnum|null $navigationGroup = 'Catalog';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required()->maxLength(255)->live(onBlur: true)->afterStateUpdated(fn ($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
            TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
            TextInput::make('description')->maxLength(500),
            TextInput::make('icon')->maxLength(100),
            Select::make('parent_id')->label('Parent Category')->options(fn (): array => Category::rootIdNameOptions())->nullable()->searchable(),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ResourceTableColumns::id(),
            TextColumn::make('name')
                ->searchable()
                ->formatStateUsing(fn (string $state, Category $record): string => $record->parent_id === null ? $state : '↳ '.$state)
                ->weight(fn (Category $record): string => $record->parent_id === null ? 'semi-bold' : 'normal'),
            TextColumn::make('parent.name')->label('Parent')->default('-'),
            TextColumn::make('children_count')->label('Subcategories'),
            TextColumn::make('listings_count')->label('Listings'),
            ResourceTableColumns::activeIcon(),
            TextColumn::make('sort_order')->sortable(),
        ])->actions([
            Action::make('toggleChildren')
                ->label(fn (Category $record, Pages\ListCategories $livewire): string => $livewire->hasExpandedChildren($record) ? 'Hide subcategories' : 'Show subcategories')
                ->icon(fn (Category $record, Pages\ListCategories $livewire): string => $livewire->hasExpandedChildren($record) ? 'heroicon-o-chevron-down' : 'heroicon-o-chevron-right')
                ->action(fn (Category $record, Pages\ListCategories $livewire) => $livewire->toggleChildren($record))
                ->visible(fn (Category $record): bool => $record->parent_id === null && $record->children_count > 0),
            ...ResourceTableActions::editActivityDelete(static::class),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'activities' => Pages\ListCategoryActivities::route('/{record}/activities'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}

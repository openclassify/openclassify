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
use Filament\Tables\Table;
use Modules\Admin\Filament\Resources\CategoryResource\Pages;
use Modules\Category\Models\Category;
use UnitEnum;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-tag';
    protected static string | UnitEnum | null $navigationGroup = 'Catalog';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required()->maxLength(255)->live(onBlur: true)->afterStateUpdated(fn ($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
            TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
            TextInput::make('description')->maxLength(500),
            TextInput::make('icon')->maxLength(100),
            Select::make('parent_id')->label('Parent Category')->options(fn () => Category::whereNull('parent_id')->pluck('name', 'id'))->nullable()->searchable(),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('parent.name')->label('Parent')->default('-'),
            TextColumn::make('listings_count')->counts('listings')->label('Listings'),
            IconColumn::make('is_active')->boolean(),
            TextColumn::make('sort_order')->sortable(),
        ])->defaultSort('id', 'desc')->actions([
            EditAction::make(),
            Action::make('activities')
                ->icon('heroicon-o-clock')
                ->url(fn (Category $record): string => static::getUrl('activities', ['record' => $record])),
            DeleteAction::make(),
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

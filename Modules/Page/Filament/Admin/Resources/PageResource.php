<?php

declare(strict_types=1);

namespace Modules\Page\Filament\Admin\Resources;

use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Admin\Support\Filament\ResourceTableActions;
use Modules\Admin\Support\Filament\ResourceTableColumns;
use Modules\Page\Filament\Admin\Resources\PageResource\Pages;
use Modules\Page\Models\Page;
use UnitEnum;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?string $label = 'Page';

    protected static ?string $pluralLabel = 'Pages';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')->required()->maxLength(150)->live(onBlur: true)
                ->afterStateUpdated(static fn (Set $set, ?string $state): mixed => $set('slug', Str::slug((string) $state))),
            TextInput::make('slug')->required()->maxLength(150)->unique(ignoreRecord: true),
            TextInput::make('excerpt')->maxLength(255),
            Textarea::make('body')->rows(14)->columnSpanFull(),
            Select::make('placement')->options(fn (): array => collect(Page::placements())->mapWithKeys(
                static fn (string $placement): array => [$placement => ucfirst($placement)]
            )->all())->required(),
            TextInput::make('meta_title')->maxLength(150),
            Textarea::make('meta_description')->rows(2)->maxLength(320),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_published')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ResourceTableColumns::id(),
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('slug')->searchable(),
            TextColumn::make('placement')->badge()->sortable(),
            IconColumn::make('is_published')->boolean()->label('Published'),
            TextColumn::make('sort_order')->sortable(),
            ResourceTableColumns::createdAtHidden(),
        ])->defaultSort('id', 'desc')->filters([
            SelectFilter::make('placement')->options(fn (): array => collect(Page::placements())->mapWithKeys(
                static fn (string $placement): array => [$placement => ucfirst($placement)]
            )->all()),
            TernaryFilter::make('is_published')->label('Published'),
        ])->actions(ResourceTableActions::editDelete());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageResourceRecords::route('/'),
            'create' => Pages\CreatePageResourceRecord::route('/create'),
            'edit' => Pages\EditPageResourceRecord::route('/{record}/edit'),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Modules\Review\Filament\Admin\Resources;

use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Modules\Admin\Support\Filament\ResourceTableActions;
use Modules\Admin\Support\Filament\ResourceTableColumns;
use Modules\Review\Filament\Admin\Resources\ReviewResource\Pages;
use Modules\Review\Models\Review;
use UnitEnum;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-star';

    protected static string|UnitEnum|null $navigationGroup = 'Moderation';

    protected static ?string $label = 'Review';

    protected static ?string $pluralLabel = 'Reviews';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('seller_id')->numeric()->required(),
            TextInput::make('author_id')->numeric()->required(),
            TextInput::make('listing_id')->numeric(),
            TextInput::make('rating')->numeric()->minValue(1)->maxValue(5)->required(),
            TextInput::make('title')->maxLength(120),
            Textarea::make('body')->rows(4)->maxLength(2000),
            Toggle::make('is_approved')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ResourceTableColumns::id(),
            TextColumn::make('rating')->badge()->sortable(),
            TextColumn::make('title')->searchable()->limit(40),
            TextColumn::make('seller_id')->label('Seller')->sortable(),
            TextColumn::make('author_id')->label('Author')->sortable(),
            IconColumn::make('is_approved')->boolean()->label('Approved'),
            ResourceTableColumns::createdAtHidden(),
        ])->defaultSort('id', 'desc')->filters([
            SelectFilter::make('rating')->options([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5']),
            TernaryFilter::make('is_approved')->label('Approved'),
        ])->actions(ResourceTableActions::editDelete());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviewResourceRecords::route('/'),
            'create' => Pages\CreateReviewResourceRecord::route('/create'),
            'edit' => Pages\EditReviewResourceRecord::route('/{record}/edit'),
        ];
    }
}

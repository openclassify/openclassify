<?php

declare(strict_types=1);

namespace Modules\Offer\Filament\Admin\Resources;

use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Modules\Admin\Support\Filament\ResourceTableActions;
use Modules\Admin\Support\Filament\ResourceTableColumns;
use Modules\Offer\Filament\Admin\Resources\OfferResource\Pages;
use Modules\Offer\Models\Offer;
use UnitEnum;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static string|UnitEnum|null $navigationGroup = 'Marketplace';

    protected static ?string $label = 'Offer';

    protected static ?string $pluralLabel = 'Offers';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('listing_id')->numeric()->required(),
            TextInput::make('buyer_id')->numeric()->required(),
            TextInput::make('seller_id')->numeric()->required(),
            TextInput::make('amount')->numeric()->required(),
            TextInput::make('currency')->maxLength(3)->required(),
            Textarea::make('message')->rows(3)->maxLength(500),
            Select::make('status')->options(fn (): array => collect(Offer::statuses())->mapWithKeys(
                static fn (string $status): array => [$status => __('offer::messages.status_'.$status)]
            )->all())->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ResourceTableColumns::id(),
            TextColumn::make('listing_id')->label('Listing')->sortable(),
            TextColumn::make('amount')->money(fn (Offer $record): string => (string) $record->getAttribute('currency'))->sortable(),
            TextColumn::make('status')->badge()->sortable(),
            TextColumn::make('buyer_id')->label('Buyer'),
            TextColumn::make('seller_id')->label('Seller'),
            ResourceTableColumns::createdAtHidden(),
        ])->defaultSort('id', 'desc')->filters([
            SelectFilter::make('status')->options(fn (): array => collect(Offer::statuses())->mapWithKeys(
                static fn (string $status): array => [$status => __('offer::messages.status_'.$status)]
            )->all()),
        ])->actions(ResourceTableActions::editDelete());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOfferResourceRecords::route('/'),
            'create' => Pages\CreateOfferResourceRecord::route('/create'),
            'edit' => Pages\EditOfferResourceRecord::route('/{record}/edit'),
        ];
    }
}

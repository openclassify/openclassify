<?php

namespace Modules\Listing\Support\Filament;

use A909M\FilamentStateFusion\Forms\Components\StateFusionSelect;
use A909M\FilamentStateFusion\Tables\Columns\StateFusionSelectColumn;
use A909M\FilamentStateFusion\Tables\Filters\StateFusionSelectFilter;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Modules\Admin\Support\Filament\ResourceTableActions;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\ListingCustomFieldSchemaBuilder;
use Modules\Listing\Support\ListingPanelHelper;
use Modules\Location\Models\City;
use Modules\Location\Models\Country;
use Modules\Location\Support\CountryCodeManager;
use Modules\Site\App\Support\LocalMedia;
use Modules\Video\Support\Filament\VideoFormSchema;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class AdminListingResourceSchema
{
    public static function form(): array
    {
        return [
            TextInput::make('title')->required()->maxLength(255)->live(onBlur: true)->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state).'-'.Str::random(4))),
            TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
            Textarea::make('description')->rows(4),
            TextInput::make('price')
                ->numeric()
                ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2),
            Select::make('currency')
                ->options(fn (): array => ListingPanelHelper::currencyOptions())
                ->default(fn (): string => ListingPanelHelper::defaultCurrency())
                ->required(),
            Select::make('category_id')
                ->label('Category')
                ->options(fn (): array => Category::activeIdNameOptions())
                ->searchable()
                ->live()
                ->afterStateUpdated(fn ($state, $set) => $set('custom_fields', []))
                ->nullable(),
            Select::make('user_id')->relationship('user', 'email')->label('Owner')->searchable()->preload()->nullable(),
            Section::make('Custom Fields')
                ->description('Category specific listing attributes.')
                ->schema(fn (Get $get): array => ListingCustomFieldSchemaBuilder::formComponents(
                    ($categoryId = $get('category_id')) ? (int) $categoryId : null
                ))
                ->columns(2)
                ->columnSpanFull()
                ->visible(fn (Get $get): bool => ListingCustomFieldSchemaBuilder::hasFields(
                    ($categoryId = $get('category_id')) ? (int) $categoryId : null
                )),
            StateFusionSelect::make('status')->required(),
            PhoneInput::make('contact_phone')->defaultCountry(CountryCodeManager::defaultCountryIso2())->nullable(),
            TextInput::make('contact_email')->email()->maxLength(255),
            Toggle::make('is_featured')->default(false),
            Select::make('country')
                ->label('Country')
                ->options(fn (): array => Country::nameOptions())
                ->searchable()
                ->preload()
                ->live()
                ->afterStateUpdated(fn ($state, $set) => $set('city', null))
                ->nullable(),
            Select::make('city')
                ->label('City')
                ->options(fn (Get $get): array => City::nameOptions($get('country')))
                ->searchable()
                ->preload()
                ->nullable(),
            Map::make('location')
                ->label('Location')
                ->visible(fn (): bool => ListingPanelHelper::googleMapsEnabled())
                ->draggable()
                ->clickable()
                ->autocomplete('city')
                ->autocompleteReverse(true)
                ->reverseGeocode([
                    'city' => '%L',
                ])
                ->defaultLocation([41.0082, 28.9784])
                ->defaultZoom(10)
                ->height('320px')
                ->columnSpanFull(),
            SpatieMediaLibraryFileUpload::make('images')
                ->collection('listing-images')
                ->disk(fn (): string => LocalMedia::disk())
                ->customProperties(fn (): array => Listing::mediaCustomProperties())
                ->multiple()
                ->image()
                ->reorderable(),
            VideoFormSchema::listingSection(),
        ];
    }

    public static function configureTable(Table $table, string $resourceClass): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('images')
                    ->collection('listing-images')
                    ->circular(),
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->searchable()->sortable()->limit(40),
                TextColumn::make('category.name')->label('Category')->sortable(),
                TextColumn::make('user.email')->label('Owner')->searchable()->toggleable()->sortable(),
                TextColumn::make('price')
                    ->currency(fn (Listing $record): string => $record->currency ?: ListingPanelHelper::defaultCurrency())
                    ->sortable(),
                StateFusionSelectColumn::make('status')->sortable(),
                IconColumn::make('is_featured')->boolean()->label('Featured')->sortable(),
                TextColumn::make('city')->sortable(),
                TextColumn::make('country')->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                StateFusionSelectFilter::make('status'),
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('user_id')
                    ->label('Owner')
                    ->relationship('user', 'email')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('country')
                    ->options(fn (): array => Country::nameOptions())
                    ->searchable(),
                SelectFilter::make('city')
                    ->options(fn (): array => City::nameOptions(null, false))
                    ->searchable(),
                TernaryFilter::make('is_featured')->label('Featured'),
                Filter::make('created_at')
                    ->label('Created Date')
                    ->schema([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('until')->label('Until'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query
                        ->when($data['from'] ?? null, fn (Builder $builder, string $date): Builder => $builder->whereDate('created_at', '>=', $date))
                        ->when($data['until'] ?? null, fn (Builder $builder, string $date): Builder => $builder->whereDate('created_at', '<=', $date))),
                Filter::make('price')
                    ->label('Price Range')
                    ->schema([
                        TextInput::make('min')->numeric()->label('Min'),
                        TextInput::make('max')->numeric()->label('Max'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query
                        ->when($data['min'] ?? null, fn (Builder $builder, string $amount): Builder => $builder->where('price', '>=', (float) $amount))
                        ->when($data['max'] ?? null, fn (Builder $builder, string $amount): Builder => $builder->where('price', '<=', (float) $amount))),
            ])
            ->filtersLayout(FiltersLayout::AboveContentCollapsible)
            ->filtersFormColumns(3)
            ->filtersFormWidth('7xl')
            ->persistFiltersInSession()
            ->defaultSort('id', 'desc')
            ->actions(ResourceTableActions::editActivityDelete($resourceClass));
    }
}

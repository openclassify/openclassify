<?php

declare(strict_types=1);

namespace Modules\Promotion\Filament\Admin\Resources;

use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Admin\Support\Filament\ResourceTableActions;
use Modules\Admin\Support\Filament\ResourceTableColumns;
use Modules\Promotion\Filament\Admin\Resources\PromotionPlanResource\Pages;
use Modules\Promotion\Models\PromotionPlan;
use UnitEnum;

class PromotionPlanResource extends Resource
{
    protected static ?string $model = PromotionPlan::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';

    protected static string|UnitEnum|null $navigationGroup = 'Marketplace';

    protected static ?string $label = 'Promotion plan';

    protected static ?string $pluralLabel = 'Promotion plans';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')->required()->maxLength(80)->live(onBlur: true)
                ->afterStateUpdated(static fn (Set $set, ?string $state): mixed => $set('slug', Str::slug((string) $state))),
            TextInput::make('slug')->required()->maxLength(80)->unique(ignoreRecord: true),
            Textarea::make('description')->rows(3)->maxLength(500),
            TextInput::make('price')->numeric()->required()->default(0),
            TextInput::make('currency')->maxLength(3)->required()->default('USD'),
            TextInput::make('duration_days')->numeric()->required()->default(7),
            TextInput::make('bump_count')->numeric()->default(0),
            Toggle::make('grants_featured'),
            Toggle::make('grants_urgent'),
            Toggle::make('is_active')->default(true),
            TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ResourceTableColumns::id(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('price')->money(fn (PromotionPlan $record): string => (string) $record->getAttribute('currency'))->sortable(),
            TextColumn::make('duration_days')->label('Days')->sortable(),
            IconColumn::make('grants_featured')->boolean()->label('Featured'),
            IconColumn::make('grants_urgent')->boolean()->label('Urgent'),
            ResourceTableColumns::activeIcon(),
        ])->defaultSort('id', 'desc')->filters([
            TernaryFilter::make('is_active')->label('Active'),
            TernaryFilter::make('grants_featured')->label('Featured'),
        ])->actions(ResourceTableActions::editDelete());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromotionPlanResourceRecords::route('/'),
            'create' => Pages\CreatePromotionPlanResourceRecord::route('/create'),
            'edit' => Pages\EditPromotionPlanResourceRecord::route('/{record}/edit'),
        ];
    }
}

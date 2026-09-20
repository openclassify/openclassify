<?php

declare(strict_types=1);

namespace Modules\Report\Filament\Admin\Resources;

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
use Modules\Report\Filament\Admin\Resources\ReportResource\Pages;
use Modules\Report\Models\Report;
use UnitEnum;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-flag';

    protected static string|UnitEnum|null $navigationGroup = 'Moderation';

    protected static ?string $label = 'Report';

    protected static ?string $pluralLabel = 'Reports';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('subject_type')->options([
                Report::SUBJECT_LISTING => 'Listing',
                Report::SUBJECT_USER => 'User',
            ])->required(),
            TextInput::make('subject_id')->numeric()->required(),
            Select::make('reason')->options(fn (): array => collect(Report::reasons())->mapWithKeys(
                static fn (string $reason): array => [$reason => __('report::messages.reason_'.$reason)]
            )->all())->required(),
            Textarea::make('details')->rows(3)->maxLength(1000),
            Select::make('status')->options(fn (): array => collect(Report::statuses())->mapWithKeys(
                static fn (string $status): array => [$status => __('report::messages.status_'.$status)]
            )->all())->required(),
            Textarea::make('resolution_note')->rows(2)->maxLength(1000),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ResourceTableColumns::id(),
            TextColumn::make('subject_type')->badge()->sortable(),
            TextColumn::make('subject_id')->label('Subject')->sortable(),
            TextColumn::make('reason')->badge()->searchable(),
            TextColumn::make('status')->badge()->sortable(),
            TextColumn::make('reporter_id')->label('Reporter'),
            ResourceTableColumns::createdAtHidden(),
        ])->defaultSort('id', 'desc')->filters([
            SelectFilter::make('status')->options(fn (): array => collect(Report::statuses())->mapWithKeys(
                static fn (string $status): array => [$status => __('report::messages.status_'.$status)]
            )->all()),
            SelectFilter::make('subject_type')->options([
                Report::SUBJECT_LISTING => 'Listing',
                Report::SUBJECT_USER => 'User',
            ]),
        ])->actions(ResourceTableActions::editDelete());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReportResourceRecords::route('/'),
            'create' => Pages\CreateReportResourceRecord::route('/create'),
            'edit' => Pages\EditReportResourceRecord::route('/{record}/edit'),
        ];
    }
}

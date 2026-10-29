<?php

declare(strict_types=1);

namespace Modules\Admin\Support\Filament;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\User\App\Models\User;

final class ResourceTableFilters
{
    public static function layout(Table $table, array $filters): Table
    {
        return $table
            ->filters([...$filters, TrashedFilter::make()])
            ->filtersLayout(FiltersLayout::AboveContentCollapsible)
            ->filtersFormColumns(3)
            ->filtersFormWidth('7xl')
            ->persistFiltersInSession();
    }

    public static function dateRange(string $column = 'created_at', ?string $label = null): Filter
    {
        return Filter::make($column)
            ->label($label ?? str($column)->headline()->toString())
            ->schema([
                DatePicker::make('from')->label('From'),
                DatePicker::make('until')->label('Until'),
            ])
            ->query(fn (Builder $query, array $data): Builder => $query
                ->when($data['from'] ?? null, fn (Builder $builder, string $date): Builder => $builder->whereDate($column, '>=', $date))
                ->when($data['until'] ?? null, fn (Builder $builder, string $date): Builder => $builder->whereDate($column, '<=', $date)))
            ->indicateUsing(fn (array $data): array => array_values(array_filter([
                ($data['from'] ?? null) ? str($column)->headline().' from '.$data['from'] : null,
                ($data['until'] ?? null) ? str($column)->headline().' until '.$data['until'] : null,
            ])));
    }

    public static function numberRange(string $column, ?string $label = null): Filter
    {
        return Filter::make($column.'_range')
            ->label($label ?? str($column)->headline()->toString())
            ->schema([
                TextInput::make('min')->numeric()->label('Min'),
                TextInput::make('max')->numeric()->label('Max'),
            ])
            ->query(fn (Builder $query, array $data): Builder => $query
                ->when(is_numeric($data['min'] ?? null), fn (Builder $builder): Builder => $builder->where($column, '>=', (float) $data['min']))
                ->when(is_numeric($data['max'] ?? null), fn (Builder $builder): Builder => $builder->where($column, '<=', (float) $data['max'])));
    }

    public static function user(string $column, string $label): SelectFilter
    {
        return SelectFilter::make($column)
            ->label($label)
            ->searchable()
            ->getSearchResultsUsing(fn (string $search): array => User::searchOptions($search))
            ->getOptionLabelUsing(fn (mixed $value): string => User::labelOf((int) $value));
    }

    public static function options(string $column, array $options, ?string $label = null): SelectFilter
    {
        return SelectFilter::make($column)
            ->label($label ?? str($column)->headline()->toString())
            ->options($options)
            ->multiple();
    }
}

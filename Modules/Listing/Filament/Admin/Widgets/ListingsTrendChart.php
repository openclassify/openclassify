<?php

namespace Modules\Listing\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use Modules\Listing\Models\Listing;

class ListingsTrendChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected ?string $heading = 'Listing Creation Trend';

    protected ?string $description = 'Daily listing volume by selected period.';

    protected function getFilters(): ?array
    {
        return [
            '7' => 'Last 7 days',
            '30' => 'Last 30 days',
            '90' => 'Last 90 days',
        ];
    }

    protected function getData(): array
    {
        $days = (int) ($this->filter ?? '30');
        $trend = Listing::creationTrend($days);

        return [
            'datasets' => [
                [
                    'label' => 'Listings',
                    'data' => $trend['data'],
                    'fill' => true,
                    'borderColor' => '#2563eb',
                    'backgroundColor' => 'rgba(37, 99, 235, 0.12)',
                    'tension' => 0.35,
                ],
            ],
            'labels' => $trend['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

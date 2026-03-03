<?php
namespace Modules\Admin\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Modules\Listing\Models\Listing;

class ListingsTrendChart extends ChartWidget
{
    protected static ?int $sort = 2;

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
        $startDate = now()->startOfDay()->subDays($days - 1);

        $countsByDate = Listing::query()
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->where('created_at', '>=', $startDate)
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day')
            ->all();

        $labels = [];
        $data = [];

        for ($index = 0; $index < $days; $index++) {
            $date = $startDate->copy()->addDays($index);
            $dateKey = $date->toDateString();

            $labels[] = $date->format('M j');
            $data[] = (int) ($countsByDate[$dateKey] ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Listings',
                    'data' => $data,
                    'fill' => true,
                    'borderColor' => '#2563eb',
                    'backgroundColor' => 'rgba(37, 99, 235, 0.12)',
                    'tension' => 0.35,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

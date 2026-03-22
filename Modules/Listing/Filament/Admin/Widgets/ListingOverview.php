<?php

namespace Modules\Listing\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Listing\Models\Listing;

class ListingOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $heading = 'Listing Overview';

    protected function getStats(): array
    {
        $stats = Listing::overviewStats();

        $featuredRatio = $stats['total'] > 0
            ? number_format(($stats['featured'] / $stats['total']) * 100, 1).'% of all listings'
            : '0.0% of all listings';

        return [
            Stat::make('Total Listings', number_format($stats['total']))
                ->description('All listings in the system')
                ->icon('heroicon-o-clipboard-document-list')
                ->color('primary'),
            Stat::make('Active Listings', number_format($stats['active']))
                ->description(number_format($stats['pending']).' pending review')
                ->descriptionIcon('heroicon-o-clock')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
            Stat::make('Created Today', number_format($stats['created_today']))
                ->description('New listings added today')
                ->icon('heroicon-o-calendar-days')
                ->color('info'),
            Stat::make('Featured Listings', number_format($stats['featured']))
                ->description($featuredRatio)
                ->icon('heroicon-o-star')
                ->color('warning'),
        ];
    }
}

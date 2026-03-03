<?php
namespace Modules\Admin\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Listing\Models\Listing;

class ListingOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $heading = 'Listing Overview';

    protected function getStats(): array
    {
        $totalListings = Listing::query()->count();
        $activeListings = Listing::query()->where('status', 'active')->count();
        $pendingListings = Listing::query()->where('status', 'pending')->count();
        $featuredListings = Listing::query()->where('is_featured', true)->count();
        $createdToday = Listing::query()->where('created_at', '>=', now()->startOfDay())->count();

        $featuredRatio = $totalListings > 0
            ? number_format(($featuredListings / $totalListings) * 100, 1).'% of all listings'
            : '0.0% of all listings';

        return [
            Stat::make('Total Listings', number_format($totalListings))
                ->description('All listings in the system')
                ->icon('heroicon-o-clipboard-document-list')
                ->color('primary'),
            Stat::make('Active Listings', number_format($activeListings))
                ->description(number_format($pendingListings).' pending review')
                ->descriptionIcon('heroicon-o-clock')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
            Stat::make('Created Today', number_format($createdToday))
                ->description('New listings added today')
                ->icon('heroicon-o-calendar-days')
                ->color('info'),
            Stat::make('Featured Listings', number_format($featuredListings))
                ->description($featuredRatio)
                ->icon('heroicon-o-star')
                ->color('warning'),
        ];
    }
}

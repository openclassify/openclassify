<?php

namespace Modules\Listing\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;
use Modules\User\App\Support\DemoUserCatalog;

class ListingPanelDemoSeeder extends Seeder
{
    private const LEGACY_SLUGS = [
        'admin-demo-pro-workstation',
        'admin-demo-sold-camera',
        'admin-demo-expired-sofa',
        'member-demo-iphone',
        'member-demo-city-bike',
        'member-demo-vintage-chair',
        'member-demo-garden-tools',
    ];

    public function run(): void
    {
        Listing::query()
            ->whereIn('slug', self::LEGACY_SLUGS)
            ->get()
            ->each(function (Listing $listing): void {
                $listing->clearMediaCollection('listing-images');
                $listing->delete();
            });

        foreach (DemoUserCatalog::emails() as $email) {
            $user = User::query()->where('email', $email)->first();

            if (! $user) {
                continue;
            }

            $this->applyPanelStates($user);
        }
    }

    private function applyPanelStates(User $user): void
    {
        $listings = Listing::query()
            ->where('user_id', $user->getKey())
            ->where('slug', 'like', 'demo-%')
            ->orderBy('created_at')
            ->get()
            ->values();

        foreach ($listings as $index => $listing) {
            $listing->forceFill([
                'status' => $this->statusForIndex($index),
                'is_featured' => $index < 2,
                'expires_at' => $this->expiresAtForIndex($index),
                'updated_at' => now()->subHours($index),
            ])->saveQuietly();
        }
    }

    private function statusForIndex(int $index): string
    {
        return match ($index % 9) {
            2 => 'sold',
            3 => 'expired',
            4 => 'pending',
            default => 'active',
        };
    }

    private function expiresAtForIndex(int $index): \Illuminate\Support\Carbon
    {
        return match ($this->statusForIndex($index)) {
            'expired' => now()->subDays(4 + ($index % 5)),
            'sold' => now()->addDays(8 + ($index % 4)),
            'pending' => now()->addDays(5 + ($index % 4)),
            default => now()->addDays(20 + ($index % 9)),
        };
    }
}

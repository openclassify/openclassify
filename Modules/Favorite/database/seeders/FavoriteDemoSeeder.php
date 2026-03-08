<?php

namespace Modules\Favorite\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Category\Models\Category;
use Modules\Favorite\App\Models\FavoriteSearch;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;

class FavoriteDemoSeeder extends Seeder
{
    public function run(): void
    {
        if (! $this->favoriteTablesExist()) {
            return;
        }

        $admin = User::query()->where('email', 'a@a.com')->first();
        $member = User::query()->where('email', 'b@b.com')->first();

        if (! $admin || ! $member) {
            return;
        }

        $adminListings = Listing::query()
            ->where('user_id', $admin->getKey())
            ->orderByDesc('is_featured')
            ->orderBy('id')
            ->get();

        $memberListings = Listing::query()
            ->where('user_id', $member->getKey())
            ->orderByDesc('is_featured')
            ->orderBy('id')
            ->get();

        if ($adminListings->isEmpty() || $memberListings->isEmpty()) {
            return;
        }

        $activeAdminListings = $adminListings->where('status', 'active')->values();
        $activeMemberListings = $memberListings->where('status', 'active')->values();

        $this->seedFavoriteListings(
            $member,
            $activeAdminListings->take(6)
        );

        $this->seedFavoriteListings(
            $admin,
            $activeMemberListings->take(4)
        );

        $this->seedFavoriteSeller($member, $admin, now()->subDays(2));
        $this->seedFavoriteSeller($admin, $member, now()->subDays(1));

        $this->seedFavoriteSearches($member, $this->memberSearchPayloads());
        $this->seedFavoriteSearches($admin, $this->adminSearchPayloads());
    }

    private function favoriteTablesExist(): bool
    {
        return Schema::hasTable('favorite_listings')
            && Schema::hasTable('favorite_sellers')
            && Schema::hasTable('favorite_searches');
    }

    private function seedFavoriteListings(User $user, Collection $listings): void
    {
        $rows = $listings
            ->values()
            ->map(function (Listing $listing, int $index) use ($user): array {
                $timestamp = now()->subHours(12 + ($index * 5));

                return [
                    'user_id' => $user->getKey(),
                    'listing_id' => $listing->getKey(),
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            })
            ->all();

        if ($rows === []) {
            return;
        }

        DB::table('favorite_listings')->upsert(
            $rows,
            ['user_id', 'listing_id'],
            ['updated_at']
        );
    }

    private function seedFavoriteSeller(User $user, User $seller, \Illuminate\Support\Carbon $timestamp): void
    {
        if ((int) $user->getKey() === (int) $seller->getKey()) {
            return;
        }

        DB::table('favorite_sellers')->upsert(
            [[
                'user_id' => $user->getKey(),
                'seller_id' => $seller->getKey(),
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]],
            ['user_id', 'seller_id'],
            ['updated_at']
        );
    }

    private function seedFavoriteSearches(User $user, array $payloads): void
    {
        foreach ($payloads as $index => $payload) {
            $filters = FavoriteSearch::normalizeFilters([
                'search' => $payload['search'] ?? null,
                'category' => $payload['category_id'] ?? null,
            ]);

            if ($filters === []) {
                continue;
            }

            $signature = FavoriteSearch::signatureFor($filters);
            $categoryName = null;

            if (! empty($payload['category_id'])) {
                $categoryName = Category::query()->whereKey($payload['category_id'])->value('name');
            }

            $favoriteSearch = FavoriteSearch::updateOrCreate(
                [
                    'user_id' => $user->getKey(),
                    'signature' => $signature,
                ],
                [
                    'label' => FavoriteSearch::labelFor($filters, is_string($categoryName) ? $categoryName : null),
                    'search_term' => $filters['search'] ?? null,
                    'category_id' => $filters['category'] ?? null,
                    'filters' => $filters,
                ]
            );

            $timestamp = now()->subDays($index + 1);
            $favoriteSearch->forceFill([
                'created_at' => $favoriteSearch->wasRecentlyCreated ? $timestamp : $favoriteSearch->created_at,
                'updated_at' => $timestamp,
            ])->saveQuietly();
        }
    }

    private function memberSearchPayloads(): array
    {
        $electronicsId = Category::query()->where('slug', 'electronics')->value('id');
        $vehiclesId = Category::query()->where('slug', 'vehicles')->value('id');
        $realEstateId = Category::query()->where('slug', 'real-estate')->value('id');
        $servicesId = Category::query()->where('slug', 'services')->value('id');

        return [
            ['search' => 'iphone', 'category_id' => $electronicsId],
            ['search' => 'sedan', 'category_id' => $vehiclesId],
            ['search' => 'apartment', 'category_id' => $realEstateId],
            ['search' => 'repair', 'category_id' => $servicesId],
        ];
    }

    private function adminSearchPayloads(): array
    {
        $fashionId = Category::query()->where('slug', 'fashion')->value('id');
        $homeGardenId = Category::query()->where('slug', 'home-garden')->value('id');
        $sportsId = Category::query()->where('slug', 'sports')->value('id');

        return [
            ['search' => 'vintage', 'category_id' => $fashionId],
            ['search' => 'garden', 'category_id' => $homeGardenId],
            ['search' => 'fitness', 'category_id' => $sportsId],
        ];
    }
}

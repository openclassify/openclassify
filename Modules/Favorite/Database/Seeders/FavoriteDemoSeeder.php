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
use Modules\User\App\Support\DemoUserCatalog;

class FavoriteDemoSeeder extends Seeder
{
    public function run(): void
    {
        if (! $this->favoriteTablesExist()) {
            return;
        }

        $users = User::query()
            ->whereIn('email', DemoUserCatalog::emails())
            ->orderBy('email')
            ->get()
            ->values();

        if ($users->count() < 2) {
            return;
        }

        DB::table('favorite_listings')->whereIn('user_id', $users->pluck('id'))->delete();
        DB::table('favorite_sellers')->whereIn('user_id', $users->pluck('id'))->delete();
        FavoriteSearch::query()->whereIn('user_id', $users->pluck('id'))->delete();

        foreach ($users as $index => $user) {
            $favoriteSeller = $users->get(($index + 1) % $users->count());
            $secondarySeller = $users->get(($index + 2) % $users->count());

            if (! $favoriteSeller instanceof User || ! $secondarySeller instanceof User) {
                continue;
            }

            $favoriteListings = Listing::query()
                ->whereIn('user_id', [$favoriteSeller->getKey(), $secondarySeller->getKey()])
                ->where('status', 'active')
                ->orderByDesc('is_featured')
                ->orderBy('id')
                ->take(4)
                ->get();

            $this->seedFavoriteListings($user, $favoriteListings);
            $this->seedFavoriteSeller($user, $favoriteSeller, now()->subDays($index + 1));
            $this->seedFavoriteSearches($user, $this->searchPayloadsForUser($index));
        }
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
                $timestamp = now()->subHours(8 + ($index * 3));

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

    private function searchPayloadsForUser(int $index): array
    {
        $blueprints = [
            ['search' => 'phone', 'slug' => 'electronics'],
            ['search' => 'car', 'slug' => 'vehicles'],
            ['search' => 'apartment', 'slug' => 'real-estate'],
            ['search' => 'style', 'slug' => 'fashion'],
            ['search' => 'furniture', 'slug' => 'home-garden'],
            ['search' => 'fitness', 'slug' => 'sports'],
            ['search' => 'remote', 'slug' => 'jobs'],
            ['search' => 'cleaning', 'slug' => 'services'],
        ];

        return collect(range(0, 2))
            ->map(function (int $offset) use ($blueprints, $index): array {
                $blueprint = $blueprints[($index + $offset) % count($blueprints)];

                return [
                    'search' => $blueprint['search'],
                    'category_id' => Category::query()->where('slug', $blueprint['slug'])->value('id'),
                ];
            })
            ->all();
    }
}

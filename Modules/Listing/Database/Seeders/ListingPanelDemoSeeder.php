<?php

namespace Modules\Listing\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;

class ListingPanelDemoSeeder extends Seeder
{
    private const PANEL_LISTINGS = [
        [
            'slug' => 'admin-demo-sold-camera',
            'title' => 'Admin Demo Camera Bundle',
            'description' => 'Sample sold listing for the panel filters and activity cards.',
            'price' => 18450,
            'status' => 'sold',
            'city' => 'Istanbul',
            'country' => 'Turkey',
            'image' => 'sample_image/macbook.jpg',
            'expires_offset_days' => 12,
            'is_featured' => false,
        ],
        [
            'slug' => 'admin-demo-expired-sofa',
            'title' => 'Admin Demo Sofa Set',
            'description' => 'Sample expired listing for the panel filters and republish flow.',
            'price' => 9800,
            'status' => 'expired',
            'city' => 'Ankara',
            'country' => 'Turkey',
            'image' => 'sample_image/cup.jpg',
            'expires_offset_days' => -5,
            'is_featured' => false,
        ],
        [
            'slug' => 'admin-demo-expired-bike',
            'title' => 'Admin Demo City Bike',
            'description' => 'Extra expired sample listing so My Listings is not empty in filtered views.',
            'price' => 6200,
            'status' => 'expired',
            'city' => 'Izmir',
            'country' => 'Turkey',
            'image' => 'sample_image/car2.jpeg',
            'expires_offset_days' => -11,
            'is_featured' => false,
        ],
    ];

    public function run(): void
    {
        $admin = $this->resolveAdminUser();

        if (! $admin) {
            return;
        }

        $this->claimAllListingsForAdmin($admin);

        $categories = $this->resolveCategories();

        if ($categories->isEmpty()) {
            return;
        }

        foreach (self::PANEL_LISTINGS as $index => $payload) {
            $category = $categories->get($index % $categories->count());

            if (! $category instanceof Category) {
                continue;
            }

            $listing = Listing::updateOrCreate(
                ['slug' => $payload['slug']],
                [
                    'slug' => $payload['slug'],
                    'title' => $payload['title'],
                    'description' => $payload['description'],
                    'price' => $payload['price'],
                    'currency' => 'TRY',
                    'city' => $payload['city'],
                    'country' => $payload['country'],
                    'category_id' => $category->getKey(),
                    'user_id' => $admin->getKey(),
                    'status' => $payload['status'],
                    'contact_email' => $admin->email,
                    'contact_phone' => '+905551112233',
                    'is_featured' => $payload['is_featured'],
                    'expires_at' => now()->addDays((int) $payload['expires_offset_days']),
                ]
            );

            $this->syncListingImage($listing, (string) $payload['image']);
        }
    }

    private function resolveAdminUser(): ?User
    {
        return User::query()->where('email', 'a@a.com')->first()
            ?? User::query()->whereHas('roles', fn ($query) => $query->where('name', 'admin'))->first()
            ?? User::query()->first();
    }

    private function claimAllListingsForAdmin(User $admin): void
    {
        Listing::query()
            ->where(function ($query) use ($admin): void {
                $query
                    ->whereNull('user_id')
                    ->orWhere('user_id', '!=', $admin->getKey());
            })
            ->update([
                'user_id' => $admin->getKey(),
                'contact_email' => $admin->email,
                'updated_at' => now(),
            ]);
    }

    private function resolveCategories(): Collection
    {
        $leafCategories = Category::query()
            ->where('is_active', true)
            ->whereDoesntHave('children')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        if ($leafCategories->isNotEmpty()) {
            return $leafCategories->values();
        }

        return Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->values();
    }

    private function syncListingImage(Listing $listing, string $imageRelativePath): void
    {
        $imageAbsolutePath = public_path($imageRelativePath);

        if (! is_file($imageAbsolutePath)) {
            return;
        }

        $targetFileName = basename($imageAbsolutePath);
        $existingMedia = $listing->getMedia('listing-images')->first();

        if (
            $existingMedia
            && (string) $existingMedia->file_name === $targetFileName
            && (string) $existingMedia->disk === 'public'
        ) {
            try {
                if (is_file($existingMedia->getPath())) {
                    return;
                }
            } catch (\Throwable) {
            }
        }

        $listing->clearMediaCollection('listing-images');

        $listing
            ->addMedia($imageAbsolutePath)
            ->usingFileName(Str::slug($listing->slug).'-'.basename($imageAbsolutePath))
            ->preservingOriginal()
            ->toMediaCollection('listing-images', 'public');
    }
}

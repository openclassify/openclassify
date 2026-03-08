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
    private const USER_PANEL_LISTINGS = [
        'a@a.com' => [
            [
                'slug' => 'admin-demo-pro-workstation',
                'title' => 'Admin Demo Pro Workstation',
                'description' => 'Active demo listing for inbox, favorites, and video testing.',
                'price' => 28450,
                'status' => 'active',
                'city' => 'Istanbul',
                'country' => 'Turkey',
                'image' => 'sample_image/macbook.jpg',
                'expires_offset_days' => 21,
                'is_featured' => true,
            ],
            [
                'slug' => 'admin-demo-sold-camera',
                'title' => 'Admin Demo Camera Bundle',
                'description' => 'Sold demo listing for panel status testing.',
                'price' => 18450,
                'status' => 'sold',
                'city' => 'Ankara',
                'country' => 'Turkey',
                'image' => 'sample_image/headphones.jpg',
                'expires_offset_days' => 12,
                'is_featured' => false,
            ],
            [
                'slug' => 'admin-demo-expired-sofa',
                'title' => 'Admin Demo Sofa Set',
                'description' => 'Expired demo listing for republish testing.',
                'price' => 9800,
                'status' => 'expired',
                'city' => 'Izmir',
                'country' => 'Turkey',
                'image' => 'sample_image/cup.jpg',
                'expires_offset_days' => -5,
                'is_featured' => false,
            ],
        ],
        'b@b.com' => [
            [
                'slug' => 'member-demo-iphone',
                'title' => 'Member Demo iPhone Bundle',
                'description' => 'Active demo listing owned by the member account.',
                'price' => 21990,
                'status' => 'active',
                'city' => 'Bursa',
                'country' => 'Turkey',
                'image' => 'sample_image/phone.jpeg',
                'expires_offset_days' => 24,
                'is_featured' => true,
            ],
            [
                'slug' => 'member-demo-city-bike',
                'title' => 'Member Demo City Bike',
                'description' => 'Second active listing so conversations and favorites are easy to test.',
                'price' => 7600,
                'status' => 'active',
                'city' => 'Antalya',
                'country' => 'Turkey',
                'image' => 'sample_image/car2.jpeg',
                'expires_offset_days' => 17,
                'is_featured' => false,
            ],
            [
                'slug' => 'member-demo-vintage-chair',
                'title' => 'Member Demo Vintage Chair',
                'description' => 'Sold listing for panel filters on the member account.',
                'price' => 4350,
                'status' => 'sold',
                'city' => 'Istanbul',
                'country' => 'Turkey',
                'image' => 'sample_image/car.jpeg',
                'expires_offset_days' => 8,
                'is_featured' => false,
            ],
            [
                'slug' => 'member-demo-garden-tools',
                'title' => 'Member Demo Garden Tools Set',
                'description' => 'Expired listing for republish flow on the member account.',
                'price' => 3150,
                'status' => 'expired',
                'city' => 'Ankara',
                'country' => 'Turkey',
                'image' => 'sample_image/laptop.jpg',
                'expires_offset_days' => -7,
                'is_featured' => false,
            ],
        ],
    ];

    public function run(): void
    {
        $admin = $this->resolveUserByEmail('a@a.com');

        if (! $admin) {
            return;
        }

        $this->claimAllListingsForAdmin($admin);

        $categories = $this->resolveCategories();

        if ($categories->isEmpty()) {
            return;
        }

        foreach (self::USER_PANEL_LISTINGS as $email => $payloads) {
            $owner = $this->resolveUserByEmail($email);

            if (! $owner) {
                continue;
            }

            foreach ($payloads as $index => $payload) {
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
                        'user_id' => $owner->getKey(),
                        'status' => $payload['status'],
                        'contact_email' => $owner->email,
                        'contact_phone' => $email === 'a@a.com' ? '+905551112233' : '+905551112244',
                        'is_featured' => $payload['is_featured'],
                        'expires_at' => now()->addDays((int) $payload['expires_offset_days']),
                    ]
                );

                $this->syncListingImage($listing, (string) $payload['image']);
            }
        }
    }

    private function resolveUserByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
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

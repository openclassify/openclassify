<?php

namespace Modules\Listing\Database\Seeders;

use Modules\User\App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;

class ListingSeeder extends Seeder
{
    private const LISTINGS = [
        [
            'title' => 'iPhone 14 Pro 256 GB, temiz kullanılmış',
            'description' => 'Cihaz sorunsuz çalışıyor, pil sağlığı iyi durumda. Kutusu ve şarj kablosu ile teslim edilecektir.',
            'price' => 44999,
            'city' => 'İstanbul',
            'country' => 'Türkiye',
            'image' => 'sample_image/phone.jpeg',
        ],
        [
            'title' => 'MacBook Pro M2 16 GB / 512 GB',
            'description' => 'Yazılım geliştirme için kullanıldı. Kozmetik olarak çok iyi durumda, faturası mevcut.',
            'price' => 62999,
            'city' => 'Ankara',
            'country' => 'Türkiye',
            'image' => 'sample_image/macbook.jpg',
        ],
        [
            'title' => '2020 Toyota Corolla 1.6 Dream',
            'description' => 'Boyalı parça yok, düzenli bakımlı aile aracı. Detaylı ekspertiz raporu paylaşılabilir.',
            'price' => 980000,
            'city' => 'İzmir',
            'country' => 'Türkiye',
            'image' => 'sample_image/car.jpeg',
        ],
        [
            'title' => 'Bluetooth Kulaklık - Aktif Gürültü Engelleme',
            'description' => 'Uzun pil ömrü ve net mikrofon performansı. Kutu içeriği tamdır.',
            'price' => 3499,
            'city' => 'Bursa',
            'country' => 'Türkiye',
            'image' => 'sample_image/headphones.jpg',
        ],
        [
            'title' => 'Masaüstü için 15 inç dizüstü bilgisayar',
            'description' => 'Günlük kullanım ve ofis işleri için ideal. SSD sayesinde hızlı açılış.',
            'price' => 18450,
            'city' => 'Antalya',
            'country' => 'Türkiye',
            'image' => 'sample_image/laptop.jpg',
        ],
        [
            'title' => 'Seramik Kahve Kupası Seti (6 Adet)',
            'description' => 'Az kullanıldı, kırık/çatlak yok. Mutfak yenileme nedeniyle satılıktır.',
            'price' => 650,
            'city' => 'Adana',
            'country' => 'Türkiye',
            'image' => 'sample_image/cup.jpg',
        ],
        [
            'title' => 'Sedan Araç - Düşük Kilometre',
            'description' => 'Şehir içi kullanıldı, tüm bakımları zamanında yapıldı. Ciddi alıcılarla paylaşım yapılır.',
            'price' => 845000,
            'city' => 'Konya',
            'country' => 'Türkiye',
            'image' => 'sample_image/car2.jpeg',
        ],
    ];

    public function run(): void
    {
        $user = $this->resolveSeederUser();
        $categories = Category::query()
            ->where('level', 0)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        if (! $user || $categories->isEmpty()) {
            return;
        }

        foreach (self::LISTINGS as $index => $data) {
            $listing = $this->upsertListing(
                index: $index,
                data: $data,
                categories: $categories,
                user: $user,
            );

            $this->syncListingImage($listing, $data['image']);
        }
    }

    private function resolveSeederUser(): ?User
    {
        return User::query()
            ->where('email', 'b@b.com')
            ->orWhere('email', 'partner@openclassify.com')
            ->first();
    }

    private function upsertListing(int $index, array $data, Collection $categories, User $user): Listing
    {
        $slug = Str::slug($data['title']) . '-' . ($index + 1);
        $category = $categories->get($index % $categories->count());

        return Listing::updateOrCreate(
            ['slug' => $slug],
            [
                'slug' => $slug,
                'title' => $data['title'],
                'description' => $data['description'],
                'price' => $data['price'],
                'currency' => 'TRY',
                'city' => $data['city'],
                'country' => $data['country'],
                'category_id' => $category?->id,
                'user_id' => $user->id,
                'status' => 'active',
                'contact_email' => $user->email,
                'contact_phone' => '+905551112233',
                'is_featured' => $index < 3,
            ]
        );
    }

    private function syncListingImage(Listing $listing, string $imageRelativePath): void
    {
        $imageAbsolutePath = public_path($imageRelativePath);

        if (! is_file($imageAbsolutePath)) {
            if ($this->command) {
                $this->command->warn("Gorsel bulunamadi: {$imageRelativePath}");
            }

            return;
        }

        $targetFileName = basename($imageAbsolutePath);
        $mediaItems = $listing->getMedia('listing-images');

        if (! $this->hasSingleHealthyTargetMedia($mediaItems, $targetFileName)) {
            $listing->clearMediaCollection('listing-images');

            $listing
                ->addMedia($imageAbsolutePath)
                ->preservingOriginal()
                ->toMediaCollection('listing-images', 'public');
        }
    }

    private function hasSingleHealthyTargetMedia(Collection $mediaItems, string $targetFileName): bool
    {
        if ($mediaItems->count() !== 1) {
            return false;
        }

        $media = $mediaItems->first();

        if (
            ! $media
            || (string) $media->file_name !== $targetFileName
            || (string) $media->disk !== 'public'
        ) {
            return false;
        }

        try {
            return is_file($media->getPath());
        } catch (\Throwable) {
            return false;
        }
    }
}

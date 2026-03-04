<?php
namespace Modules\Listing\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $user = \App\Models\User::where('email', 'b@b.com')
            ->orWhere('email', 'partner@openclassify.com')
            ->first();
        $categories = Category::where('level', 0)->get();

        if (!$user || $categories->isEmpty()) return;

        $listings = [
            [
                'title' => 'iPhone 14 Pro 256 GB, temiz kullanılmış',
                'description' => 'Cihaz sorunsuz çalışıyor, pil sağlığı iyi durumda. Kutusu ve şarj kablosu ile teslim edilecektir.',
                'price' => 44999,
                'city' => 'İstanbul',
                'country' => 'Türkiye',
            ],
            [
                'title' => 'MacBook Pro M2 16 GB / 512 GB',
                'description' => 'Yazılım geliştirme için kullanıldı. Kozmetik olarak çok iyi durumda, faturası mevcut.',
                'price' => 62999,
                'city' => 'Ankara',
                'country' => 'Türkiye',
            ],
            [
                'title' => '2020 Toyota Corolla 1.6 Dream',
                'description' => 'Boyalı parça yok, düzenli bakımlı aile aracı. Detaylı ekspertiz raporu paylaşılabilir.',
                'price' => 980000,
                'city' => 'İzmir',
                'country' => 'Türkiye',
            ],
            [
                'title' => 'Bluetooth Kulaklık - Aktif Gürültü Engelleme',
                'description' => 'Uzun pil ömrü ve net mikrofon performansı. Kutu içeriği tamdır.',
                'price' => 3499,
                'city' => 'Bursa',
                'country' => 'Türkiye',
            ],
            [
                'title' => 'Masaüstü için 15 inç dizüstü bilgisayar',
                'description' => 'Günlük kullanım ve ofis işleri için ideal. SSD sayesinde hızlı açılış.',
                'price' => 18450,
                'city' => 'Antalya',
                'country' => 'Türkiye',
            ],
            [
                'title' => 'Seramik Kahve Kupası Seti (6 Adet)',
                'description' => 'Az kullanıldı, kırık/çatlak yok. Mutfak yenileme nedeniyle satılıktır.',
                'price' => 650,
                'city' => 'Adana',
                'country' => 'Türkiye',
            ],
            [
                'title' => 'Sedan Araç - Düşük Kilometre',
                'description' => 'Şehir içi kullanıldı, tüm bakımları zamanında yapıldı. Ciddi alıcılarla paylaşım yapılır.',
                'price' => 845000,
                'city' => 'Konya',
                'country' => 'Türkiye',
            ],
        ];

        $sampleImages = [
            'sample_image/phone.jpeg',
            'sample_image/macbook.jpg',
            'sample_image/car.jpeg',
            'sample_image/headphones.jpg',
            'sample_image/laptop.jpg',
            'sample_image/cup.jpg',
            'sample_image/car2.jpeg',
        ];

        $sampleImageFileNames = collect($sampleImages)
            ->map(fn (string $path): string => basename($path))
            ->values();

        foreach ($listings as $i => $listing) {
            $category = $categories->get($i % $categories->count());
            $slug = Str::slug($listing['title']) . '-' . ($i + 1);

            $listingModel = Listing::updateOrCreate(
                ['slug' => $slug],
                array_merge($listing, [
                    'slug' => $slug,
                    'description' => $listing['description'],
                    'currency' => 'TRY',
                    'category_id' => $category?->id,
                    'user_id' => $user->id,
                    'status' => 'active',
                    'contact_email' => $user->email,
                    'contact_phone' => '+905551112233',
                    'is_featured' => $i < 3,
                ])
            );

            $imageRelativePath = $sampleImages[$i % count($sampleImages)];
            $imageAbsolutePath = public_path($imageRelativePath);

            if (! is_file($imageAbsolutePath)) {
                continue;
            }

            $currentMedia = $listingModel->getMedia('listing-images');
            $currentHasSampleImage = $currentMedia->contains(
                fn ($media): bool => $sampleImageFileNames->contains((string) $media->file_name)
            );

            if (! $currentHasSampleImage) {
                $listingModel->clearMediaCollection('listing-images');
            }

            $targetFileName = basename($imageAbsolutePath);
            $alreadyHasTargetImage = $listingModel->getMedia('listing-images')
                ->contains(fn ($media): bool => (string) $media->file_name === $targetFileName);

            if (! $alreadyHasTargetImage) {
                $listingModel
                    ->addMedia($imageAbsolutePath)
                    ->preservingOriginal()
                    ->toMediaCollection('listing-images');
            }
        }
    }
}

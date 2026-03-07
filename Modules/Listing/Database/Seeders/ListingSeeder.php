<?php

namespace Modules\Listing\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Location\Models\City;
use Modules\Location\Models\Country;
use Modules\User\App\Models\User;

class ListingSeeder extends Seeder
{
    private const SAMPLE_IMAGES = [
        'sample_image/phone.jpeg',
        'sample_image/macbook.jpg',
        'sample_image/car.jpeg',
        'sample_image/headphones.jpg',
        'sample_image/laptop.jpg',
        'sample_image/cup.jpg',
        'sample_image/car2.jpeg',
    ];

    private const TITLE_PREFIXES = [
        'Temiz kullanılmış',
        'Az kullanılmış',
        'Fırsat ürün',
        'Uygun fiyatlı',
        'Sahibinden',
        'Kaçırılmayacak',
        'Bakımlı',
    ];

    public function run(): void
    {
        $user = $this->resolveSeederUser();
        $categories = $this->resolveSeedableCategories();

        if (! $user || $categories->isEmpty()) {
            return;
        }

        $countries = $this->resolveCountries();
        $turkeyCities = $this->resolveTurkeyCities();

        foreach ($categories as $index => $category) {
            $listingData = $this->buildListingData($category, $index, $countries, $turkeyCities);
            $listing = $this->upsertListing($index, $listingData, $category, $user);
            $this->syncListingImage($listing, $listingData['image']);
        }
    }

    private function resolveSeederUser(): ?User
    {
        return User::query()->where('email', 'a@a.com')->first()
            ?? User::query()->where('email', 'admin@openclassify.com')->first()
            ?? User::query()
                ->whereHas('roles', fn ($query) => $query->where('name', 'admin'))
                ->first()
            ?? User::query()->first();
    }

    private function resolveSeedableCategories(): Collection
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

    private function resolveCountries(): Collection
    {
        if (! class_exists(Country::class) || ! Schema::hasTable('countries')) {
            return collect();
        }

        return Country::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'code'])
            ->values();
    }

    private function resolveTurkeyCities(): Collection
    {
        if (! class_exists(City::class) || ! Schema::hasTable('cities') || ! Schema::hasTable('countries')) {
            return collect(['İstanbul', 'Ankara', 'İzmir', 'Bursa', 'Antalya']);
        }

        $turkey = Country::query()
            ->where('code', 'TR')
            ->first(['id']);

        if (! $turkey) {
            return collect(['İstanbul', 'Ankara', 'İzmir', 'Bursa', 'Antalya']);
        }

        $cities = City::query()
            ->where('country_id', (int) $turkey->id)
            ->where('is_active', true)
            ->orderBy('name')
            ->pluck('name')
            ->map(fn ($name): string => trim((string) $name))
            ->filter(fn (string $name): bool => $name !== '')
            ->values();

        return $cities->isNotEmpty()
            ? $cities
            : collect(['İstanbul', 'Ankara', 'İzmir', 'Bursa', 'Antalya']);
    }

    private function buildListingData(
        Category $category,
        int $index,
        Collection $countries,
        Collection $turkeyCities
    ): array {
        $location = $this->resolveLocation($index, $countries, $turkeyCities);
        $image = self::SAMPLE_IMAGES[$index % count(self::SAMPLE_IMAGES)];

        return [
            'title' => $this->buildTitle($category, $index),
            'description' => $this->buildDescription($category, $location['city'], $location['country']),
            'price' => $this->priceForIndex($index),
            'city' => $location['city'],
            'country' => $location['country'],
            'image' => $image,
        ];
    }

    private function resolveLocation(int $index, Collection $countries, Collection $turkeyCities): array
    {
        $turkeyCountry = $countries->first(fn ($country): bool => strtoupper((string) $country->code) === 'TR');
        $turkeyName = trim((string) ($turkeyCountry->name ?? 'Türkiye')) ?: 'Türkiye';

        $useForeignCountry = $countries->count() > 1 && $index % 4 === 0;

        if ($useForeignCountry) {
            $foreignCountries = $countries
                ->filter(fn ($country): bool => strtoupper((string) $country->code) !== 'TR')
                ->values();

            if ($foreignCountries->isNotEmpty()) {
                $selected = $foreignCountries->get($index % $foreignCountries->count());
                $countryName = trim((string) ($selected->name ?? ''));

                return [
                    'country' => $countryName !== '' ? $countryName : 'Türkiye',
                    'city' => $countryName !== '' ? $countryName : 'İstanbul',
                ];
            }
        }

        $city = trim((string) $turkeyCities->get($index % max(1, $turkeyCities->count())));

        return [
            'country' => $turkeyName,
            'city' => $city !== '' ? $city : 'İstanbul',
        ];
    }

    private function buildTitle(Category $category, int $index): string
    {
        $prefix = self::TITLE_PREFIXES[$index % count(self::TITLE_PREFIXES)];
        $categoryName = trim((string) $category->name);

        return sprintf('%s %s ilanı', $prefix, $categoryName !== '' ? $categoryName : 'ürün');
    }

    private function buildDescription(Category $category, string $city, string $country): string
    {
        $categoryName = trim((string) $category->name);
        $location = trim(collect([$city, $country])->filter()->join(', '));

        return sprintf(
            '%s kategorisinde, durum olarak sorunsuz ve kullanıma hazırdır. Teslimat noktası: %s. Detaylar için mesaj atabilirsiniz.',
            $categoryName !== '' ? $categoryName : 'Ürün',
            $location !== '' ? $location : 'Türkiye'
        );
    }

    private function priceForIndex(int $index): int
    {
        $basePrices = [
            1499,
            3250,
            6490,
            11800,
            26500,
            44990,
            82000,
            135000,
        ];

        $base = $basePrices[$index % count($basePrices)];
        $step = (int) floor($index / count($basePrices)) * 750;

        return $base + $step;
    }

    private function upsertListing(int $index, array $data, Category $category, User $user): Listing
    {
        $slug = Str::slug($category->slug.'-'.$data['title']).'-'.($index + 1);

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
                'category_id' => $category->id,
                'user_id' => $user->id,
                'status' => 'active',
                'contact_email' => $user->email,
                'contact_phone' => '+905551112233',
                'is_featured' => $index < 8,
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

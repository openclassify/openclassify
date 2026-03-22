<?php

namespace Modules\Listing\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\SampleListingImageCatalog;
use Modules\Location\Models\City;
use Modules\Location\Models\Country;
use Modules\User\App\Models\User;
use Modules\User\App\Support\DemoUserCatalog;

class ListingSeeder extends Seeder
{
    private const TITLE_PREFIXES = [
        'Clean',
        'Lightly used',
        'Special offer',
        'Well priced',
        'Owner listed',
        'Must-see',
        'Well kept',
    ];

    public function run(): void
    {
        $users = $this->resolveSeederUsers();
        $categories = $this->resolveSeedableCategories();
        $imagePool = SampleListingImageCatalog::uniquePaths();

        if ($users->isEmpty() || $categories->isEmpty() || $imagePool->isEmpty()) {
            return;
        }

        $countries = $this->resolveCountries();
        $turkeyCities = $this->resolveTurkeyCities();
        $plannedSlugs = [];
        $assignedImageIndex = 0;

        foreach ($categories as $category) {
            foreach ($users as $user) {
                if ($assignedImageIndex >= $imagePool->count()) {
                    continue;
                }

                $listingData = $this->buildListingData(
                    $category,
                    $assignedImageIndex,
                    $countries,
                    $turkeyCities,
                    $user,
                    $imagePool->get($assignedImageIndex)
                );
                $listing = $this->upsertListing($listingData, $category, $user);
                $plannedSlugs[] = $listing->slug;
                $this->syncListingImage($listing, $listingData['image_path']);
                $assignedImageIndex++;
            }
        }

        Listing::query()
            ->whereIn('user_id', $users->pluck('id'))
            ->where('slug', 'like', 'demo-%')
            ->whereNotIn('slug', $plannedSlugs)
            ->get()
            ->each(function (Listing $listing): void {
                $listing->clearMediaCollection('listing-images');
                $listing->delete();
            });
    }

    private function resolveSeederUsers(): Collection
    {
        return User::query()
            ->whereIn('email', DemoUserCatalog::emails())
            ->orderBy('email')
            ->get()
            ->values();
    }

    private function resolveSeedableCategories(): Collection
    {
        $leafCategories = Category::query()
            ->where('is_active', true)
            ->whereDoesntHave('children')
            ->with('parent:id,name')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        if ($leafCategories->isNotEmpty()) {
            return $leafCategories->values();
        }

        return Category::query()
            ->where('is_active', true)
            ->with('parent:id,name')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->values();
    }

    private function resolveCountries(): Collection
    {
        return Country::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'code'])
            ->values();
    }

    private function resolveTurkeyCities(): Collection
    {
        $turkey = Country::query()
            ->where('code', 'TR')
            ->first(['id']);

        if (! $turkey) {
            return collect(['Istanbul', 'Ankara', 'Izmir', 'Bursa', 'Antalya']);
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
            : collect(['Istanbul', 'Ankara', 'Izmir', 'Bursa', 'Antalya']);
    }

    private function buildListingData(
        Category $category,
        int $index,
        Collection $countries,
        Collection $turkeyCities,
        User $user,
        ?string $imagePath
    ): array {
        $location = $this->resolveLocation($index, $countries, $turkeyCities);
        $title = $this->buildTitle($category, $index, $user);
        $slug = 'demo-'.Str::slug($user->email).'-'.$category->slug;

        return [
            'slug' => $slug,
            'title' => $title,
            'description' => $this->buildDescription($category, $location['city'], $location['country'], $user),
            'price' => $this->priceForIndex($index),
            'city' => $location['city'],
            'country' => $location['country'],
            'contact_phone' => DemoUserCatalog::phoneFor($user->email),
            'is_featured' => $index % 7 === 0,
            'expires_at' => now()->addDays(21 + ($index % 9)),
            'created_at' => now()->subHours(6 + $index),
            'image_path' => $imagePath,
        ];
    }

    private function resolveLocation(int $index, Collection $countries, Collection $turkeyCities): array
    {
        $turkeyCountry = $countries->first(fn ($country): bool => strtoupper((string) $country->code) === 'TR');
        $turkeyName = trim((string) ($turkeyCountry->name ?? 'Turkey')) ?: 'Turkey';
        $useForeignCountry = $countries->count() > 1 && $index % 4 === 0;

        if ($useForeignCountry) {
            $foreignCountries = $countries
                ->filter(fn ($country): bool => strtoupper((string) $country->code) !== 'TR')
                ->values();

            if ($foreignCountries->isNotEmpty()) {
                $selected = $foreignCountries->get($index % $foreignCountries->count());
                $countryName = trim((string) ($selected->name ?? ''));

                return [
                    'country' => $countryName !== '' ? $countryName : 'Turkey',
                    'city' => $countryName !== '' ? $countryName : 'Istanbul',
                ];
            }
        }

        $city = trim((string) $turkeyCities->get($index % max(1, $turkeyCities->count())));

        return [
            'country' => $turkeyName,
            'city' => $city !== '' ? $city : 'Istanbul',
        ];
    }

    private function buildTitle(Category $category, int $index, User $user): string
    {
        $prefix = self::TITLE_PREFIXES[$index % count(self::TITLE_PREFIXES)];
        $categoryName = trim((string) $category->name);
        $ownerFragment = trim(Str::before($user->name, ' '));

        return sprintf(
            '%s %s for %s',
            $prefix,
            $categoryName !== '' ? $categoryName : 'item',
            $ownerFragment !== '' ? $ownerFragment : 'demo'
        );
    }

    private function buildDescription(Category $category, string $city, string $country, User $user): string
    {
        $categoryName = trim((string) $category->name);
        $location = trim(collect([$city, $country])->filter()->join(', '));

        return sprintf(
            '%s listed by %s. Clean demo condition, sample product photo assigned from the provided catalog, and ready for browsing, favorites, inbox, and panel testing. Pickup area: %s.',
            $categoryName !== '' ? $categoryName : 'Item',
            trim((string) $user->name) !== '' ? trim((string) $user->name) : 'a marketplace user',
            $location !== '' ? $location : 'Turkey'
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

    private function upsertListing(array $data, Category $category, User $user): Listing
    {
        $listing = Listing::updateOrCreate(
            ['slug' => $data['slug']],
            [
                'slug' => $data['slug'],
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
                'contact_phone' => $data['contact_phone'],
                'is_featured' => $data['is_featured'],
                'expires_at' => $data['expires_at'],
            ]
        );

        $listing->forceFill([
            'created_at' => $data['created_at'],
            'updated_at' => $data['created_at'],
        ])->saveQuietly();

        return $listing;
    }

    private function syncListingImage(Listing $listing, ?string $imageAbsolutePath): void
    {
        if (! is_string($imageAbsolutePath) || ! is_file($imageAbsolutePath)) {
            return;
        }

        $listing->replacePublicImage(
            $imageAbsolutePath,
            SampleListingImageCatalog::fileNameFor($imageAbsolutePath, $listing->slug)
        );
    }
}

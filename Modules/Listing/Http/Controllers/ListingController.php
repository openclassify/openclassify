<?php
namespace Modules\Listing\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Conversation\App\Models\Conversation;
use Modules\Favorite\App\Models\FavoriteSearch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Modules\Location\Models\City;
use Modules\Location\Models\Country;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\ListingCustomFieldSchemaBuilder;
use Modules\Theme\Support\ThemeManager;
use Throwable;

class ListingController extends Controller
{
    public function __construct(private ThemeManager $themes)
    {
    }

    public function index()
    {
        $search = trim((string) request('search', ''));

        $categoryId = request()->integer('category');
        $categoryId = $categoryId > 0 ? $categoryId : null;

        $countryId = request()->integer('country');
        $countryId = $countryId > 0 ? $countryId : null;

        $cityId = request()->integer('city');
        $cityId = $cityId > 0 ? $cityId : null;

        $sellerUserId = request()->integer('user');
        $sellerUserId = $sellerUserId > 0 ? $sellerUserId : null;

        $minPriceInput = trim((string) request('min_price', ''));
        $maxPriceInput = trim((string) request('max_price', ''));
        $minPrice = is_numeric($minPriceInput) ? max((float) $minPriceInput, 0) : null;
        $maxPrice = is_numeric($maxPriceInput) ? max((float) $maxPriceInput, 0) : null;

        $dateFilter = (string) request('date_filter', 'all');
        $allowedDateFilters = ['all', 'today', 'week', 'month'];
        if (! in_array($dateFilter, $allowedDateFilters, true)) {
            $dateFilter = 'all';
        }

        $sort = (string) request('sort', 'smart');
        $allowedSorts = ['smart', 'newest', 'oldest', 'price_asc', 'price_desc'];
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'smart';
        }

        $countries = collect();
        $cities = collect();
        $selectedCountryName = null;
        $selectedCityName = null;

        $this->resolveLocationFilters(
            $countryId,
            $cityId,
            $countries,
            $cities,
            $selectedCountryName,
            $selectedCityName
        );

        $listingDirectory = Category::listingDirectory($categoryId);

        $browseFilters = [
            'search' => $search,
            'country' => $selectedCountryName,
            'city' => $selectedCityName,
            'user_id' => $sellerUserId,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'date_filter' => $dateFilter,
        ];

        $allListingsTotal = Listing::query()
            ->active()
            ->forBrowseFilters($browseFilters)
            ->count();

        $listingsQuery = Listing::query()
            ->active()
            ->with('category:id,name')
            ->forBrowseFilters([
                ...$browseFilters,
                'category_ids' => $listingDirectory['filterIds'],
            ])
            ->applyBrowseSort($sort);

        $filteredListingsTotal = (clone $listingsQuery)->count();

        $listings = $listingsQuery
            ->paginate(16)
            ->withQueryString();

        $categories = $listingDirectory['categories'];
        $selectedCategory = $listingDirectory['selectedCategory'];

        $favoriteListingIds = [];
        $isCurrentSearchSaved = false;
        $conversationListingMap = [];

        if (auth()->check()) {
            $userId = (int) auth()->id();

            $favoriteListingIds = auth()->user()
                ->favoriteListings()
                ->pluck('listings.id')
                ->all();

            $conversationListingMap = Conversation::query()
                ->where('buyer_id', $userId)
                ->pluck('id', 'listing_id')
                ->map(fn ($conversationId) => (int) $conversationId)
                ->all();

            $filters = FavoriteSearch::normalizeFilters([
                'search' => $search,
                'category' => $categoryId,
            ]);

            if ($filters !== []) {
                $signature = FavoriteSearch::signatureFor($filters);
                $isCurrentSearchSaved = auth()->user()
                    ->favoriteSearches()
                    ->where('signature', $signature)
                    ->exists();
            }
        }

        return view($this->themes->view('listing', 'index'), compact(
            'listings',
            'search',
            'categoryId',
            'countryId',
            'cityId',
            'sellerUserId',
            'minPriceInput',
            'maxPriceInput',
            'dateFilter',
            'sort',
            'countries',
            'cities',
            'selectedCategory',
            'categories',
            'favoriteListingIds',
            'isCurrentSearchSaved',
            'conversationListingMap',
            'allListingsTotal',
            'filteredListingsTotal',
        ));
    }

    public function show(Listing $listing)
    {
        if (
            Schema::hasColumn('listings', 'view_count')
            && (! auth()->check() || (int) auth()->id() !== (int) $listing->user_id)
        ) {
            $listing->increment('view_count');
            $listing->refresh();
        }

        $listing->loadMissing([
            'user:id,name,email',
            'category:id,name,parent_id,slug',
            'category.parent:id,name,parent_id,slug',
            'category.parent.parent:id,name,parent_id,slug',
            'videos' => fn ($query) => $query->published()->ordered(),
        ]);
        $presentableCustomFields = ListingCustomFieldSchemaBuilder::presentableValues(
            $listing->category_id ? (int) $listing->category_id : null,
            $listing->custom_fields ?? [],
        );
        $gallery = $listing->themeGallery();
        $listingVideos = $listing->getRelation('videos');
        $relatedListings = $listing->relatedSuggestions(12);
        $themePillCategories = Category::themePills(10);
        $breadcrumbCategories = $listing->category
            ? $listing->category->breadcrumbTrail()
            : collect();

        $isListingFavorited = false;
        $isSellerFavorited = false;
        $detailConversation = null;

        if (auth()->check()) {
            $userId = (int) auth()->id();

            $isListingFavorited = auth()->user()
                ->favoriteListings()
                ->whereKey($listing->getKey())
                ->exists();

            if ($listing->user_id) {
                $isSellerFavorited = auth()->user()
                    ->favoriteSellers()
                    ->whereKey($listing->user_id)
                    ->exists();
            }

            if ($listing->user_id && (int) $listing->user_id !== $userId) {
                $existingConversationId = Conversation::buyerListingConversationId(
                    (int) $listing->getKey(),
                    $userId,
                );

                if ($existingConversationId) {
                    $detailConversation = Conversation::query()
                        ->forUser($userId)
                        ->find($existingConversationId);

                    if ($detailConversation) {
                        $detailConversation->loadThread();
                        $detailConversation->loadCount([
                            'messages as unread_count' => fn ($query) => $query
                                ->where('sender_id', '!=', $userId)
                                ->whereNull('read_at'),
                        ]);
                    }
                }
            }
        }

        return view($this->themes->view('listing', 'show'), compact(
            'listing',
            'isListingFavorited',
            'isSellerFavorited',
            'presentableCustomFields',
            'detailConversation',
            'gallery',
            'listingVideos',
            'relatedListings',
            'themePillCategories',
            'breadcrumbCategories',
        ));
    }

    public function create()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        return redirect()->route('panel.listings.create');
    }

    public function store()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        return redirect()
            ->route('panel.listings.create')
            ->with('success', 'You were redirected to the listing creation screen.');
    }

    private function resolveLocationFilters(
        ?int &$countryId,
        ?int &$cityId,
        Collection &$countries,
        Collection &$cities,
        ?string &$selectedCountryName,
        ?string &$selectedCityName
    ): void {
        try {
            if (! Schema::hasTable('countries') || ! Schema::hasTable('cities')) {
                return;
            }

            $countries = Country::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name']);

            $selectedCountry = $countryId
                ? $countries->firstWhere('id', $countryId)
                : null;

            if (! $selectedCountry && $countryId) {
                $selectedCountry = Country::query()->whereKey($countryId)->first(['id', 'name']);
            }

            $selectedCity = null;
            if ($cityId) {
                $selectedCity = City::query()->whereKey($cityId)->first(['id', 'name', 'country_id']);
                if (! $selectedCity) {
                    $cityId = null;
                }
            }

            if ($selectedCity && ! $selectedCountry) {
                $countryId = (int) $selectedCity->country_id;
                $selectedCountry = Country::query()->whereKey($countryId)->first(['id', 'name']);
            }

            if ($selectedCountry) {
                $selectedCountryName = (string) $selectedCountry->name;
                $cities = City::query()
                    ->where('country_id', $selectedCountry->id)
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->get(['id', 'name', 'country_id']);

                if ($cities->isEmpty()) {
                    $cities = City::query()
                        ->where('country_id', $selectedCountry->id)
                        ->orderBy('name')
                        ->get(['id', 'name', 'country_id']);
                }
            } else {
                $countryId = null;
                $cities = collect();
            }

            if ($selectedCity) {
                if ($selectedCountry && (int) $selectedCity->country_id !== (int) $selectedCountry->id) {
                    $selectedCity = null;
                    $cityId = null;
                } else {
                    $selectedCityName = (string) $selectedCity->name;
                }
            }
        } catch (Throwable) {
            $countryId = null;
            $cityId = null;
            $selectedCountryName = null;
            $selectedCityName = null;
            $countries = collect();
            $cities = collect();
        }
    }

}

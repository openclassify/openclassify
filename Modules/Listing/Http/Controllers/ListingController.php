<?php

namespace Modules\Listing\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Conversation\App\Models\Conversation;
use Modules\Favorite\App\Models\FavoriteSearch;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\ListingCustomFieldSchemaBuilder;
use Modules\Location\Models\Country;
use Modules\Theme\Support\ThemeManager;

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

        $locationSelection = Country::browseSelection($countryId, $cityId);
        $countryId = $locationSelection['country_id'];
        $cityId = $locationSelection['city_id'];
        $countries = $locationSelection['countries'];
        $cities = $locationSelection['cities'];
        $selectedCountryName = $locationSelection['selected_country_name'];
        $selectedCityName = $locationSelection['selected_city_name'];

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

            $favoriteListingIds = auth()->user()->favoriteListingIds();
            $conversationListingMap = Conversation::listingMapForBuyer($userId);

            $isCurrentSearchSaved = FavoriteSearch::isSavedForUser(auth()->user(), [
                'search' => $search,
                'category' => $categoryId,
            ]);
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
        $listing->trackViewBy(auth()->id());

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
        $gallery = $listing->galleryImageData();
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

            $isListingFavorited = in_array((int) $listing->getKey(), auth()->user()->favoriteListingIds(), true);

            if ($listing->user_id) {
                $isSellerFavorited = auth()->user()
                    ->favoriteSellers()
                    ->whereKey($listing->user_id)
                    ->exists();
            }

            if ($listing->user_id && (int) $listing->user_id !== $userId) {
                $detailConversation = Conversation::detailForBuyerListing(
                    (int) $listing->getKey(),
                    $userId,
                );
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
}

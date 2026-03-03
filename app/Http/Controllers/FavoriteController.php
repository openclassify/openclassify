<?php

namespace App\Http\Controllers;

use App\Models\FavoriteSearch;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = (string) $request->string('tab', 'listings');

        if (! in_array($activeTab, ['listings', 'searches', 'sellers'], true)) {
            $activeTab = 'listings';
        }

        $statusFilter = (string) $request->string('status', 'all');

        if (! in_array($statusFilter, ['all', 'active'], true)) {
            $statusFilter = 'all';
        }

        $selectedCategoryId = $request->integer('category');

        if ($selectedCategoryId <= 0) {
            $selectedCategoryId = null;
        }

        $user = $request->user();
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        $favoriteListings = null;
        $favoriteSearches = null;
        $favoriteSellers = null;

        if ($activeTab === 'listings') {
            $favoriteListings = $user->favoriteListings()
                ->with(['category:id,name', 'user:id,name'])
                ->wherePivot('created_at', '>=', now()->subYear())
                ->when($statusFilter === 'active', fn ($query) => $query->where('status', 'active'))
                ->when($selectedCategoryId, fn ($query) => $query->where('category_id', $selectedCategoryId))
                ->orderByPivot('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();
        }

        if ($activeTab === 'searches') {
            $favoriteSearches = $user->favoriteSearches()
                ->with('category:id,name')
                ->latest()
                ->paginate(10)
                ->withQueryString();
        }

        if ($activeTab === 'sellers') {
            $favoriteSellers = $user->favoriteSellers()
                ->withCount([
                    'listings as active_listings_count' => fn ($query) => $query->where('status', 'active'),
                ])
                ->orderByPivot('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();
        }

        return view('favorites.index', [
            'activeTab' => $activeTab,
            'statusFilter' => $statusFilter,
            'selectedCategoryId' => $selectedCategoryId,
            'categories' => $categories,
            'favoriteListings' => $favoriteListings,
            'favoriteSearches' => $favoriteSearches,
            'favoriteSellers' => $favoriteSellers,
        ]);
    }

    public function toggleListing(Request $request, Listing $listing)
    {
        $user = $request->user();
        $isFavorite = $user->favoriteListings()->whereKey($listing->getKey())->exists();

        if ($isFavorite) {
            $user->favoriteListings()->detach($listing->getKey());

            return back()->with('success', 'İlan favorilerden kaldırıldı.');
        }

        $user->favoriteListings()->syncWithoutDetaching([$listing->getKey()]);

        return back()->with('success', 'İlan favorilere eklendi.');
    }

    public function toggleSeller(Request $request, User $seller)
    {
        $user = $request->user();

        if ((int) $user->getKey() === (int) $seller->getKey()) {
            return back()->with('error', 'Kendi hesabını favorilere ekleyemezsin.');
        }

        $isFavorite = $user->favoriteSellers()->whereKey($seller->getKey())->exists();

        if ($isFavorite) {
            $user->favoriteSellers()->detach($seller->getKey());

            return back()->with('success', 'Satıcı favorilerden kaldırıldı.');
        }

        $user->favoriteSellers()->syncWithoutDetaching([$seller->getKey()]);

        return back()->with('success', 'Satıcı favorilere eklendi.');
    }

    public function storeSearch(Request $request)
    {
        $data = $request->validate([
            'search' => ['nullable', 'string', 'max:120'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        $filters = FavoriteSearch::normalizeFilters([
            'search' => $data['search'] ?? null,
            'category' => $data['category_id'] ?? null,
        ]);

        if ($filters === []) {
            return back()->with('error', 'Favoriye eklemek için en az bir filtre seçmelisin.');
        }

        $signature = FavoriteSearch::signatureFor($filters);

        $categoryName = null;
        if (isset($filters['category'])) {
            $categoryName = Category::query()->whereKey($filters['category'])->value('name');
        }

        $labelParts = [];
        if (! empty($filters['search'])) {
            $labelParts[] = '"'.$filters['search'].'"';
        }
        if ($categoryName) {
            $labelParts[] = $categoryName;
        }

        $label = $labelParts !== [] ? implode(' · ', $labelParts) : 'Filtreli arama';

        $favoriteSearch = $request->user()->favoriteSearches()->firstOrCreate(
            ['signature' => $signature],
            [
                'label' => $label,
                'search_term' => $filters['search'] ?? null,
                'category_id' => $filters['category'] ?? null,
                'filters' => $filters,
            ]
        );

        if (! $favoriteSearch->wasRecentlyCreated) {
            return back()->with('success', 'Bu arama zaten favorilerinde.');
        }

        return back()->with('success', 'Arama favorilere eklendi.');
    }

    public function destroySearch(Request $request, FavoriteSearch $favoriteSearch)
    {
        if ((int) $favoriteSearch->user_id !== (int) $request->user()->getKey()) {
            abort(403);
        }

        $favoriteSearch->delete();

        return back()->with('success', 'Favori arama silindi.');
    }
}

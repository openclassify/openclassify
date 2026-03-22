<?php

namespace Modules\Favorite\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Category\Models\Category;
use Modules\Conversation\App\Models\Conversation;
use Modules\Favorite\App\Models\FavoriteSearch;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;
use Modules\User\App\Support\AuthRedirector;

class FavoriteController extends Controller
{
    public function __construct(private AuthRedirector $redirector)
    {
    }

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
        $requiresLogin = ! $user;

        $categories = Category::filterOptions();

        $favoriteListings = $this->emptyPaginator();
        $favoriteSearches = $this->emptyPaginator();
        $favoriteSellers = $this->emptyPaginator();
        $buyerConversationListingMap = [];

        if ($user && $activeTab === 'listings') {
            $favoriteListings = $user->favoriteListingsPage($statusFilter, $selectedCategoryId);

            if ($favoriteListings->isNotEmpty()) {
                $buyerConversationListingMap = Conversation::listingMapForBuyer(
                    (int) $user->getKey(),
                    $favoriteListings->pluck('id')->all(),
                );
            }
        }

        if ($user && $activeTab === 'searches') {
            $favoriteSearches = $user->favoriteSearchesPage();
        }

        if ($user && $activeTab === 'sellers') {
            $favoriteSellers = $user->favoriteSellersPage();
        }

        return view('favorite::index', [
            'activeTab' => $activeTab,
            'statusFilter' => $statusFilter,
            'selectedCategoryId' => $selectedCategoryId,
            'categories' => $categories,
            'favoriteListings' => $favoriteListings,
            'favoriteSearches' => $favoriteSearches,
            'favoriteSellers' => $favoriteSellers,
            'buyerConversationListingMap' => $buyerConversationListingMap,
            'requiresLogin' => $requiresLogin,
        ]);
    }

    public function toggleListing(Request $request, Listing $listing)
    {
        $isNowFavorite = $request->user()->toggleFavoriteListing($listing);

        return $this->redirectBack($request)->with('success', $isNowFavorite ? 'Listing added to favorites.' : 'Listing removed from favorites.');
    }

    public function toggleSeller(Request $request, User $seller)
    {
        $user = $request->user();

        if ((int) $user->getKey() === (int) $seller->getKey()) {
            return $this->redirectBack($request)->with('error', 'You cannot favorite your own account.');
        }

        $isNowFavorite = $user->toggleFavoriteSeller($seller);

        return $this->redirectBack($request)->with('success', $isNowFavorite ? 'Seller added to favorites.' : 'Seller removed from favorites.');
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
            return back()->with('error', 'Select at least one filter before saving a search.');
        }

        $favoriteSearch = FavoriteSearch::storeForUser($request->user(), $filters);

        if (! $favoriteSearch->wasRecentlyCreated) {
            return back()->with('success', 'This search is already in your favorites.');
        }

        return back()->with('success', 'Search added to favorites.');
    }

    public function destroySearch(Request $request, FavoriteSearch $favoriteSearch)
    {
        if ((int) $favoriteSearch->user_id !== (int) $request->user()->getKey()) {
            abort(403);
        }

        $favoriteSearch->delete();

        return back()->with('success', 'Saved search deleted.');
    }

    private function emptyPaginator(): LengthAwarePaginator
    {
        return new LengthAwarePaginator([], 0, 10, 1, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }

    private function redirectBack(Request $request): \Illuminate\Http\RedirectResponse
    {
        $target = $this->redirector->sanitize((string) $request->input('redirect_to', ''));

        if ($target !== null) {
            return redirect()->to($target);
        }

        return back();
    }
}

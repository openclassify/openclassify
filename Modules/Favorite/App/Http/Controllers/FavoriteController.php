<?php

namespace Modules\Favorite\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Modules\Category\Models\Category;
use Modules\Conversation\App\Models\Conversation;
use Modules\Favorite\App\Models\FavoriteSearch;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;
use Modules\User\App\Support\AuthRedirector;
use Throwable;

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

        $categories = collect();
        if ($this->tableExists('categories')) {
            $categories = Category::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name']);
        }

        $favoriteListings = $this->emptyPaginator();
        $favoriteSearches = $this->emptyPaginator();
        $favoriteSellers = $this->emptyPaginator();
        $buyerConversationListingMap = [];

        if ($user && $activeTab === 'listings') {
            try {
                if ($this->tableExists('favorite_listings')) {
                    $favoriteListings = $user->favoriteListings()
                        ->with(['category:id,name', 'user:id,name'])
                        ->wherePivot('created_at', '>=', now()->subYear())
                        ->when($statusFilter === 'active', fn ($query) => $query->where('status', 'active'))
                        ->when($selectedCategoryId, fn ($query) => $query->where('category_id', $selectedCategoryId))
                        ->orderByPivot('created_at', 'desc')
                        ->paginate(10)
                        ->withQueryString();
                }

                if (
                    $favoriteListings->isNotEmpty()
                    && $this->tableExists('conversations')
                ) {
                    $userId = (int) $user->getKey();
                    $buyerConversationListingMap = Conversation::query()
                        ->where('buyer_id', $userId)
                        ->whereIn('listing_id', $favoriteListings->pluck('id')->all())
                        ->pluck('id', 'listing_id')
                        ->map(fn ($conversationId) => (int) $conversationId)
                        ->all();
                }
            } catch (Throwable) {
                $favoriteListings = $this->emptyPaginator();
                $buyerConversationListingMap = [];
            }
        }

        if ($user && $activeTab === 'searches') {
            try {
                if ($this->tableExists('favorite_searches')) {
                    $favoriteSearches = $user->favoriteSearches()
                        ->with('category:id,name')
                        ->latest()
                        ->paginate(10)
                        ->withQueryString();
                }
            } catch (Throwable) {
                $favoriteSearches = $this->emptyPaginator();
            }
        }

        if ($user && $activeTab === 'sellers') {
            try {
                if ($this->tableExists('favorite_sellers')) {
                    $favoriteSellers = $user->favoriteSellers()
                        ->withCount([
                            'listings as active_listings_count' => fn ($query) => $query->where('status', 'active'),
                        ])
                        ->orderByPivot('created_at', 'desc')
                        ->paginate(10)
                        ->withQueryString();
                }
            } catch (Throwable) {
                $favoriteSellers = $this->emptyPaginator();
            }
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

        $signature = FavoriteSearch::signatureFor($filters);

        $categoryName = null;
        if (isset($filters['category'])) {
            $categoryName = Category::query()->whereKey($filters['category'])->value('name');
        }

        $label = FavoriteSearch::labelFor($filters, is_string($categoryName) ? $categoryName : null);

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

    private function tableExists(string $table): bool
    {
        try {
            return Schema::hasTable($table);
        } catch (Throwable) {
            return false;
        }
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

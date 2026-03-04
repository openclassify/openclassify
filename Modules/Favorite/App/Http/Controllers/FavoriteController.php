<?php

namespace Modules\Favorite\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Modules\Conversation\App\Models\Conversation;
use Modules\Conversation\App\Support\QuickMessageCatalog;
use Modules\Favorite\App\Models\FavoriteSearch;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;

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

        $messageFilter = (string) $request->string('message_filter', 'all');
        if (! in_array($messageFilter, ['all', 'unread', 'important'], true)) {
            $messageFilter = 'all';
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
        $conversations = collect();
        $selectedConversation = null;
        $buyerConversationListingMap = [];

        if ($activeTab === 'listings') {
            $favoriteListings = $user->favoriteListings()
                ->with(['category:id,name', 'user:id,name'])
                ->wherePivot('created_at', '>=', now()->subYear())
                ->when($statusFilter === 'active', fn ($query) => $query->where('status', 'active'))
                ->when($selectedCategoryId, fn ($query) => $query->where('category_id', $selectedCategoryId))
                ->orderByPivot('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();

            $userId = (int) $user->getKey();
            $conversations = Conversation::inboxForUser($userId, $messageFilter);
            $buyerConversationListingMap = $conversations
                ->where('buyer_id', $userId)
                ->pluck('id', 'listing_id')
                ->map(fn ($conversationId) => (int) $conversationId)
                ->all();

            $selectedConversation = Conversation::resolveSelected($conversations, $request->integer('conversation'));

            if ($selectedConversation) {
                $selectedConversation->loadThread();
                $selectedConversation->markAsReadFor($userId);

                $conversations = $conversations->map(function (Conversation $conversation) use ($selectedConversation): Conversation {
                    if ((int) $conversation->getKey() === (int) $selectedConversation->getKey()) {
                        $conversation->unread_count = 0;
                    }

                    return $conversation;
                });
            }
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

        return view('favorite::index', [
            'activeTab' => $activeTab,
            'statusFilter' => $statusFilter,
            'selectedCategoryId' => $selectedCategoryId,
            'messageFilter' => $messageFilter,
            'categories' => $categories,
            'favoriteListings' => $favoriteListings,
            'favoriteSearches' => $favoriteSearches,
            'favoriteSellers' => $favoriteSellers,
            'conversations' => $conversations,
            'selectedConversation' => $selectedConversation,
            'buyerConversationListingMap' => $buyerConversationListingMap,
            'quickMessages' => QuickMessageCatalog::all(),
        ]);
    }

    public function toggleListing(Request $request, Listing $listing)
    {
        $isNowFavorite = $request->user()->toggleFavoriteListing($listing);

        return back()->with('success', $isNowFavorite ? 'İlan favorilere eklendi.' : 'İlan favorilerden kaldırıldı.');
    }

    public function toggleSeller(Request $request, User $seller)
    {
        $user = $request->user();

        if ((int) $user->getKey() === (int) $seller->getKey()) {
            return back()->with('error', 'Kendi hesabını favorilere ekleyemezsin.');
        }

        $isNowFavorite = $user->toggleFavoriteSeller($seller);

        return back()->with('success', $isNowFavorite ? 'Satıcı favorilere eklendi.' : 'Satıcı favorilerden kaldırıldı.');
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

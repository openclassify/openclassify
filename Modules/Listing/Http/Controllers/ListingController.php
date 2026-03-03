<?php
namespace Modules\Listing\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\FavoriteSearch;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\ListingCustomFieldSchemaBuilder;

class ListingController extends Controller
{
    public function index()
    {
        $search = trim((string) request('search', ''));
        $categoryId = request()->integer('category');
        $categoryId = $categoryId > 0 ? $categoryId : null;

        $listings = Listing::query()
            ->publicFeed()
            ->with('category:id,name')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($searchQuery) use ($search): void {
                    $searchQuery
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%")
                        ->orWhere('country', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->paginate(12)
            ->withQueryString();

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

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

        return view('listing::index', compact(
            'listings',
            'search',
            'categoryId',
            'categories',
            'favoriteListingIds',
            'isCurrentSearchSaved',
            'conversationListingMap',
        ));
    }

    public function show(Listing $listing)
    {
        $listing->loadMissing('user:id,name,email');
        $presentableCustomFields = ListingCustomFieldSchemaBuilder::presentableValues(
            $listing->category_id ? (int) $listing->category_id : null,
            $listing->custom_fields ?? [],
        );

        $isListingFavorited = false;
        $isSellerFavorited = false;
        $existingConversationId = null;

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
                $existingConversationId = Conversation::query()
                    ->where('listing_id', $listing->getKey())
                    ->where('buyer_id', $userId)
                    ->value('id');
            }
        }

        return view('listing::show', compact(
            'listing',
            'isListingFavorited',
            'isSellerFavorited',
            'presentableCustomFields',
            'existingConversationId',
        ));
    }

    public function create()
    {
        if (! auth()->check()) {
            return redirect()->route('filament.partner.auth.login');
        }

        return redirect()->route('filament.partner.resources.listings.create', ['tenant' => auth()->id()]);
    }

    public function store()
    {
        if (! auth()->check()) {
            return redirect()->route('filament.partner.auth.login');
        }

        return redirect()
            ->route('filament.partner.resources.listings.create', ['tenant' => auth()->id()])
            ->with('success', 'Use the Partner Panel to create listings.');
    }
}

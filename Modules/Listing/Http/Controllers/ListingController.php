<?php
namespace Modules\Listing\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FavoriteSearch;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;

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

        if (auth()->check()) {
            $favoriteListingIds = auth()->user()
                ->favoriteListings()
                ->pluck('listings.id')
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
        ));
    }

    public function show(Listing $listing)
    {
        $listing->loadMissing('user:id,name,email');

        $isListingFavorited = false;
        $isSellerFavorited = false;

        if (auth()->check()) {
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
        }

        return view('listing::show', compact('listing', 'isListingFavorited', 'isSellerFavorited'));
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

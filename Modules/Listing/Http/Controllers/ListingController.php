<?php
namespace Modules\Listing\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Listing\Models\Listing;

class ListingController extends Controller
{
    public function index()
    {
        $search = trim((string) request('search', ''));

        $listings = Listing::query()
            ->publicFeed()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($searchQuery) use ($search): void {
                    $searchQuery
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%")
                        ->orWhere('country', 'like', "%{$search}%");
                });
            })
            ->paginate(12)
            ->withQueryString();

        return view('listing::index', compact('listings', 'search'));
    }

    public function show(Listing $listing)
    {
        return view('listing::show', compact('listing'));
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

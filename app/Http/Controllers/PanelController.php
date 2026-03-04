<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Listing\Models\Listing;

class PanelController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('panel.listings.index');
    }

    public function create(): View
    {
        return view('panel.create');
    }

    public function listings(Request $request): View
    {
        $user = $request->user();
        $search = trim((string) $request->string('search'));
        $status = (string) $request->string('status', 'all');

        if (! in_array($status, ['all', 'sold', 'expired'], true)) {
            $status = 'all';
        }

        $listings = $user->listings()
            ->with('category:id,name')
            ->withCount('favoritedByUsers')
            ->when($search !== '', fn ($query) => $query->where('title', 'like', "%{$search}%"))
            ->when($status !== 'all', fn ($query) => $query->where('status', $status))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $statusCounts = $user->listings()
            ->selectRaw('status, COUNT(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        $counts = [
            'all' => (int) $statusCounts->sum(),
            'sold' => (int) ($statusCounts['sold'] ?? 0),
            'expired' => (int) ($statusCounts['expired'] ?? 0),
        ];

        return view('panel.listings', [
            'listings' => $listings,
            'status' => $status,
            'search' => $search,
            'counts' => $counts,
        ]);
    }

    public function destroyListing(Request $request, Listing $listing): RedirectResponse
    {
        $this->guardListingOwner($request, $listing);
        $listing->delete();

        return back()->with('success', 'İlan kaldırıldı.');
    }

    public function markListingAsSold(Request $request, Listing $listing): RedirectResponse
    {
        $this->guardListingOwner($request, $listing);
        $listing->forceFill([
            'status' => 'sold',
        ])->save();

        return back()->with('success', 'İlan satıldı olarak işaretlendi.');
    }

    public function republishListing(Request $request, Listing $listing): RedirectResponse
    {
        $this->guardListingOwner($request, $listing);
        $listing->forceFill([
            'status' => 'active',
            'expires_at' => now()->addDays(30),
        ])->save();

        return back()->with('success', 'İlan yeniden yayına alındı.');
    }

    private function guardListingOwner(Request $request, Listing $listing): void
    {
        if ((int) $listing->user_id !== (int) $request->user()->getKey()) {
            abort(403);
        }
    }
}

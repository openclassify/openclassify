<?php
namespace Modules\Listing\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Listing\Models\Listing;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::query()
            ->publicFeed()
            ->paginate(12);
        return view('listing::index', compact('listings'));
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

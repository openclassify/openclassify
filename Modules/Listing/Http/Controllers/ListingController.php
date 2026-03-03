<?php
namespace Modules\Listing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\ListingPanelHelper;

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
        return view('listing::create', [
            'currencies' => ListingPanelHelper::currencyCodes(),
        ]);
    }

    public function store(Request $request)
    {
        $currencies = ListingPanelHelper::currencyCodes();

        $data = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'currency' => ['nullable', 'string', 'size:3', Rule::in($currencies)],
            'city' => 'nullable|string|max:120',
            'country' => 'nullable|string|max:120',
            'category_id' => 'nullable|integer',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
        ]);

        $listing = Listing::createFromFrontend($data, auth()->id());

        return redirect()->route('listings.show', $listing)->with('success', 'Listing created!');
    }
}

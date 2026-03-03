<?php
namespace Modules\Listing\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Listing\Models\Listing;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $listings = Listing::where('status', 'active')
            ->orderByDesc('is_featured')
            ->orderByDesc('created_at')
            ->paginate(12);
        return view('listing::index', compact('listings'));
    }

    public function show(Listing $listing)
    {
        return view('listing::show', compact('listing'));
    }

    public function create()
    {
        return view('listing::create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'category_id' => 'nullable|integer',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
        ]);
        $data['user_id'] = auth()->id();
        $data['slug'] = \Illuminate\Support\Str::slug($data['title']) . '-' . \Illuminate\Support\Str::random(6);
        $listing = Listing::create($data);
        return redirect()->route('listings.show', $listing)->with('success', 'Listing created!');
    }
}

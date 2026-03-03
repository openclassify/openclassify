<?php
namespace Modules\Listing\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
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
        return view('listing::create', [
            'currencies' => $this->currencyCodes(),
        ]);
    }

    public function store(Request $request)
    {
        $currencies = $this->currencyCodes();

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
        $data['user_id'] = auth()->id();
        $data['currency'] = strtoupper($data['currency'] ?? $currencies[0]);
        $data['slug'] = \Illuminate\Support\Str::slug($data['title']) . '-' . \Illuminate\Support\Str::random(6);
        $listing = Listing::create($data);
        return redirect()->route('listings.show', $listing)->with('success', 'Listing created!');
    }

    private function currencyCodes(): array
    {
        $codes = collect(config('app.currencies', ['USD']))
            ->filter(fn ($code) => is_string($code) && trim($code) !== '')
            ->map(fn (string $code) => strtoupper(substr(trim($code), 0, 3)))
            ->filter(fn (string $code) => strlen($code) === 3)
            ->unique()
            ->values()
            ->all();

        return $codes !== [] ? $codes : ['USD'];
    }
}

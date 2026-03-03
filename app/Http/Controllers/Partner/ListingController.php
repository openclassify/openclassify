<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Modules\Listing\Models\Listing;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::where('user_id', auth()->id())->latest()->paginate(15);
        return view('partner.listings.index', compact('listings'));
    }
}

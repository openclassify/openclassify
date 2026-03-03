<?php
namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Modules\Listing\Models\Listing;

class DashboardController extends Controller
{
    public function index()
    {
        $myListings = Listing::where('user_id', auth()->id())->latest()->paginate(10);
        $stats = [
            'total' => Listing::where('user_id', auth()->id())->count(),
            'active' => Listing::where('user_id', auth()->id())->where('status', 'active')->count(),
        ];
        return view('partner.dashboard', compact('myListings', 'stats'));
    }
}

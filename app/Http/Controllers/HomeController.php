<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Listing\Models\Listing;
use Modules\Category\Models\Category;
use Modules\User\App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->where('is_active', true)->get();
        $featuredListings = Listing::where('status', 'active')->where('is_featured', true)->latest()->take(4)->get();
        $recentListings = Listing::where('status', 'active')->latest()->take(8)->get();
        $listingCount = Listing::where('status', 'active')->count();
        $categoryCount = Category::where('is_active', true)->count();
        $userCount = User::count();
        $favoriteListingIds = auth()->check()
            ? auth()->user()->favoriteListings()->pluck('listings.id')->all()
            : [];

        return view('home', compact(
            'categories',
            'featuredListings',
            'recentListings',
            'listingCount',
            'categoryCount',
            'userCount',
            'favoriteListingIds',
        ));
    }
}

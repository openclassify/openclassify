<?php

namespace Modules\Site\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::homeParentCategories();
        $featuredListings = Listing::homeFeatured();
        $recentListings = Listing::homeRecent();
        $listingCount = Listing::activeCount();
        $categoryCount = Category::activeCount();
        $userCount = User::totalCount();
        $favoriteListingIds = auth()->check()
            ? auth()->user()->favoriteListingIds()
            : [];

        return view('site::home', compact(
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

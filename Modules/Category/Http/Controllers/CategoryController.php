<?php
namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Theme\Support\ThemeManager;

class CategoryController extends Controller
{
    public function __construct(private ThemeManager $themes)
    {
    }

    public function index()
    {
        $categories = Category::rootTreeWithActiveChildren();

        return view($this->themes->view('category', 'index'), compact('categories'));
    }

    public function show(Category $category)
    {
        $category->loadMissing([
            'children' => fn ($query) => $query->active()->ordered(),
        ]);

        $categoryIds = $category->descendantAndSelfIds()->all();

        $listings = Listing::query()
            ->where('status', 'active')
            ->whereIn('category_id', $categoryIds)
            ->with('category:id,name')
            ->latest('id')
            ->paginate(12);

        return view($this->themes->view('category', 'show'), compact('category', 'listings'));
    }
}

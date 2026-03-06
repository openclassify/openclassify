<?php
namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Models\Category;
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
}

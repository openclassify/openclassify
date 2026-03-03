<?php
namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Category\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('children')->where('is_active', true)->get();
        return view('category::index', compact('categories'));
    }

    public function show(Category $category)
    {
        $listings = $category->listings()->where('status', 'active')->paginate(12);
        return view('category::show', compact('category', 'listings'));
    }
}

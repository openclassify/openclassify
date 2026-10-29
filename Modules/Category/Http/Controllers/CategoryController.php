<?php

declare(strict_types=1);

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Modules\Category\Models\Category;
use Modules\Theme\Support\ThemeManager;

class CategoryController extends Controller
{
    public function __construct(private ThemeManager $themes) {}

    public function index(): View
    {
        $categories = Category::rootTreeWithActiveChildren();

        return view($this->themes->view('category', 'index'), compact('categories'));
    }
}

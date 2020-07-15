<?php namespace Visiosoft\CatsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class SitemapController extends PublicController
{

    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categoriesCount = $this->categoryRepository->count();
        $pagesCount = ceil($categoriesCount / 5000);

        return response()->view('visiosoft.module.cats::sitemap.index', [
            'pagesCount' => $pagesCount,
        ])->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $page = request()->page ?: 1;
        $skip = $page - 1;

        $categories = $this->categoryRepository->newQuery()->skip(5000 * $skip)->take(5000)->get();

        return response()->view('visiosoft.module.cats::sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }
}

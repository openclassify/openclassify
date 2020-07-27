<?php namespace Visiosoft\CatsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;

class SitemapController extends PublicController
{

    private $categoryRepository;
    private $cityRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        CityRepositoryInterface $cityRepository
    )
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $categoriesCount = $this->categoryRepository->count();
        $citiesCount = $this->cityRepository->count();

        $pagesCount = $citiesCount ? $categoriesCount * $citiesCount : $categoriesCount;
        $pagesCount = ceil($pagesCount / setting_value('visiosoft.module.cats::sitemap_dividing_number'));

        return response()->view('visiosoft.module.cats::sitemap.index', [
            'pagesCount' => $pagesCount,
        ])->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $sitemapDividingNumber = setting_value('visiosoft.module.cats::sitemap_dividing_number');
        $page = request()->page ?: 1;
        $skip = $page - 1;

        $citiesCount = $this->cityRepository->count();
        if ($citiesCount) {
            $categoriesCount = $this->categoryRepository->count();

            $takeCategories = $categoriesCount / ($categoriesCount * $citiesCount / $sitemapDividingNumber);

            $categories = $this->categoryRepository
                ->newQuery()
                ->skip($takeCategories * $skip)
                ->take($takeCategories)
                ->get();

            $sitemapLinks = array();
            $cities = $this->cityRepository->all();
            foreach ($categories as $category) {
                foreach ($cities as $city) {
                    $sitemapLinks[] = route('adv_list_seo', [$category->slug, $city->slug]);
                }
            }
        } else {
            $categories = $this->categoryRepository
                ->newQuery()
                ->skip($sitemapDividingNumber * $skip)
                ->take($sitemapDividingNumber)
                ->get();

            $sitemapLinks = array();
            foreach ($categories as $category) {
                $sitemapLinks[] = route('adv_list_seo', [$category->slug]);
            }
        }

        return response()->view('visiosoft.module.cats::sitemap.categories', [
            'sitemapLinks' => $sitemapLinks,
        ])->header('Content-Type', 'text/xml');
    }
}

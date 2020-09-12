<?php namespace Visiosoft\CatsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;

class SitemapController extends PublicController
{

    private $category;
    private $city;

    public function __construct(
        CategoryRepositoryInterface $category,
        CityRepositoryInterface $city
    )
    {
        parent::__construct();
        $this->category = $category;
        $this->city = $city;
    }

    public function index()
    {
        $categoriesCount = $this->category->count();
        $include_cities_sitemap = setting_value('visiosoft.module.cats::include_cities_sitemap');
        $sitemap_dividing_number = setting_value('visiosoft.module.cats::sitemap_dividing_number');

        if ($include_cities_sitemap) {
            $citiesCount = $this->city->count();
            $pagesCount = $citiesCount ? $categoriesCount * $citiesCount : $categoriesCount;
        } else {
            $pagesCount = $categoriesCount;
        }

        $pagesCount = ceil($pagesCount / $sitemap_dividing_number);

        return $this->response->view('visiosoft.module.cats::sitemap.index', compact('pagesCount'))
            ->header('Content - Type', 'text / xml');
    }

    public function categories()
    {
        $page = request()->page ?: 1;
        $skip = $page - 1;
        $sitemapLinks = array();
        $sitemap_dividing_number = setting_value('visiosoft.module.cats::sitemap_dividing_number');
        $include_cities_sitemap = setting_value('visiosoft.module.cats::include_cities_sitemap');


        if ($citiesCount = $this->city->count() && $include_cities_sitemap) {
            $categoriesCount = $this->category->count();

            $take = $categoriesCount / ($categoriesCount * $citiesCount / $sitemap_dividing_number);

            $categories = $this->category->skipAndTake($take, $skip);

            $cities = $this->city->all();

            foreach ($categories as $category) {
                foreach ($cities as $city) {
                    $sitemapLinks[] = route('adv_list_seo', [$category->slug, $city->slug]);
                }
            }
        } else {
            $categories = $this->category->skipAndTake($sitemap_dividing_number, $skip);

            foreach ($categories as $category) {
                $sitemapLinks[] = route('adv_list_seo', [$category->slug]);
            }
        }

        return response()->view('visiosoft.module.cats::sitemap.categories', compact('sitemapLinks'))
            ->header('Content - Type', 'text / xml');
    }
}

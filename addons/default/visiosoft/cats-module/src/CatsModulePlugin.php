<?php namespace Visiosoft\CatsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;

use Visiosoft\CatsModule\Category\Command\getCategoriesLevel2;
use Visiosoft\CatsModule\Category\Command\getCategoriesLevel3;
use Visiosoft\CatsModule\Category\Command\GetCategoryName;
use Visiosoft\CatsModule\Category\Command\GetCategoryDetail;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CatsModulePlugin extends Plugin
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction(
                'category_name',
                function ($id) {

                    if (!$ad = dispatch_sync(new GetCategoryName($id))) {
                        return null;
                    }

                    return $ad;
                }
            ), new \Twig\TwigFunction(
                'category_detail',
                function ($id) {

                    if (!$ad = dispatch_sync(new GetCategoryDetail($id))) {
                        return null;
                    }

                    return $ad;
                }
            ), new \Twig\TwigFunction(
                'category_parents_name',
                function ($id) {
                    return $this->categoryRepository->getParentCategoryById($id);
                }
            ), new \Twig\TwigFunction(
                'getParentsCount',
                function ($id) {
                    return count($this->categoryRepository->getParentCategoryById($id)) - 1;
                }
            ), new \Twig\TwigFunction(
                'catIcon',
                function ($path) {
                    if ($path == "") {
                        return dispatch_sync(new MakeImageInstance('visiosoft.theme.restate::images/default-categories-icon.png', 'img'))->url();
                    } else {
                        return url('files/' . $path);
                    }
                }
            ), new \Twig\TwigFunction(
                'getCategoriesLevel2',
                function () {
                    if (!$getCategoriesLevel2 = dispatch_sync(new getCategoriesLevel2())) {
                        return 0;
                    }
                    return $getCategoriesLevel2;
                }
            ), new \Twig\TwigFunction(
                'getCategoriesLevel3',
                function () {
                    if (!$getCategoriesLevel3 = dispatch_sync(new getCategoriesLevel3())) {
                        return 0;
                    }
                    return $getCategoriesLevel3;
                }
            )
        ];
    }
}

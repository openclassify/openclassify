<?php namespace Visiosoft\CatsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;

use Visiosoft\CatsModule\Category\Command\getCategoriesLevel2;
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
            new \Twig_SimpleFunction(
                'category_name',
                function ($id) {

                    if (!$ad = $this->dispatch(new GetCategoryName($id))) {
                        return null;
                    }

                    return $ad;
                }
            ), new \Twig_SimpleFunction(
                'category_detail',
                function ($id) {

                    if (!$ad = $this->dispatch(new GetCategoryDetail($id))) {
                        return null;
                    }

                    return $ad;
                }
            ), new \Twig_SimpleFunction(
                'category_parents_name',
                function ($id) {
                    return $this->categoryRepository->getParentCategoryById($id);
                }
            ), new \Twig_SimpleFunction(
                'getParentsCount',
                function ($id) {
                    return count($this->categoryRepository->getParentCategoryById($id)) - 1;
                }
            ), new \Twig_SimpleFunction(
                'catIcon',
                function ($path) {
                    if ($path == "") {
                        return $this->dispatch(new MakeImageInstance('visiosoft.theme.base::images/default-categories-icon.png', 'img'))->url();
                    } else {
                        return url('files/' . $path);
                    }
                }
            ), new \Twig_SimpleFunction(
                'getCategoriesLevel2',
                function () {
                    if (!$getCategoriesLevel2 = $this->dispatch(new getCategoriesLevel2())) {
                        return 0;
                    }
                    return $getCategoriesLevel2;
                }
            )
        ];
    }
}

<?php namespace Visiosoft\CatsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;

use Visiosoft\CatsModule\Category\Command\getLevel2Cats;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CatsModule\Category\CategoryRepository;
use Visiosoft\CatsModule\Category\Command\GetCategoryName;
use Visiosoft\CatsModule\Category\Command\GetCategoryDetail;

class CatsModulePlugin extends Plugin
{

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
                    $category_model = new CategoryModel();
                    return $category_model->getParentCats($id, 'add_main');
                }
            ), new \Twig_SimpleFunction(
                'getParentsCount',
                function ($id) {
                    $category_model = new CategoryModel();
                    return $category_model->getParentsCount($id);
                }
            ), new \Twig_SimpleFunction(
                'catIcon',
                function ($path) {
                    if ($path == "") {
                        return $this->dispatch(new MakeImageInstance('visiosoft.theme.base::images/default-categories-icon.png', 'img'))->url();
                    } else {
                        return url('files/'.$path);
                    }
                }
            ), new \Twig_SimpleFunction(
                'getLevel2Cats',
                function () {
                    if (!$getLevel2Cats = $this->dispatch(new getLevel2Cats())) {
                        return 0;
                    }
                    return $getLevel2Cats;
                }
            )
        ];
    }
}

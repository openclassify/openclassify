<?php namespace Visiosoft\CatsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CatsModulePlugin extends Plugin
{
    public $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'findCategory',
                function ($id) {
                    if (!$category = $this->categoryRepository->find($id)) {
                        return null;
                    }
                    return $category;
                }
            ), new \Twig_SimpleFunction(
                'getParents',
                function ($id) {
                    return $this->categoryRepository->getParents($id);
                }
            )
        ];
    }
}

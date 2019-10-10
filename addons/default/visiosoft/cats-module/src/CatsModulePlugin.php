<?php namespace Visiosoft\CatsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\CatsModule\Category\Command\GetCategoryName;

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
            )
        ];
    }
}

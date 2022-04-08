<?php namespace Visiosoft\SubmenuPlugin;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\SubmenuPlugin\Commands\GetSections;
use Visiosoft\SubmenuPlugin\Commands\GetSubMenus;

class SubmenuPlugin extends Plugin
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'getSubmenus',
                function ($namespace) {
                    return $this->dispatch(new GetSubMenus($namespace));
                }
            ),
            new \Twig_SimpleFunction(
                'getSections',
                function ($namespace) {
                    return $this->dispatch(new GetSections($namespace));
                }
            )
        ];
    }
}

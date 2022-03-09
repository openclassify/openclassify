<?php namespace Anomaly\BlocksModule;

use Anomaly\BlocksModule\Area\Command\GetArea;
use Anomaly\BlocksModule\Area\Contract\AreaInterface;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class BlocksModulePlugin
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlocksModulePlugin extends Plugin
{

    /**
     * Get the plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'blocks',
                function ($identifier) {

                    /* @var AreaInterface $area */
                    if (!$area = $this->dispatch(new GetArea($identifier))) {
                        return null;
                    }

                    return $area->getBlocks();
                }, ['is_safe' => ['html']]
            ),
        ];
    }
}

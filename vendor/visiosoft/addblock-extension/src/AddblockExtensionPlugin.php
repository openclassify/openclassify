<?php namespace Visiosoft\AddblockExtension;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\AddblockExtension\Command\addBlock;

class AddblockExtensionPlugin extends Plugin
{

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'addBlock',
                function ($location, $params = [], $addons = []) {

                    if (!$addBlock = $this->dispatch(new addBlock($location, $params, $addons))) {
                        return null;
                    }

                    return $addBlock;
                }
            )
        ];
    }
}

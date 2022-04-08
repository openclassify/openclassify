<?php namespace Anomaly\Streams\Platform\Asset\Filter;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;
use CoffeeScript\Compiler;

/**
 * Class CoffeeFilter
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class CoffeeFilter implements FilterInterface
{

    /**
     * Filters an asset after it has been loaded.
     *
     * @param AssetInterface $asset
     */
    public function filterLoad(AssetInterface $asset)
    {
        //
    }

    /**
     * Filters an asset just before it's dumped.
     *
     * @param AssetInterface $asset
     */
    public function filterDump(AssetInterface $asset)
    {
        $asset->setContent(
            trim(
                Compiler::compile(
                    $asset->getContent(),
                    ['filename' => $asset->getSourcePath()]
                )
            )
        );
    }
}

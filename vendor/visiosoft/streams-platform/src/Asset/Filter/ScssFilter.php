<?php namespace Anomaly\Streams\Platform\Asset\Filter;

use Anomaly\Streams\Platform\Support\Collection;
use Assetic\Asset\AssetInterface;
use Assetic\Filter\ScssphpFilter;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Leafo\ScssPhp\Compiler;

/**
 * Class ScssFilter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ScssFilter extends ScssphpFilter
{

    use DispatchesJobs;

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
     * @todo Remove this variable stuff completely.
     */
    public function filterDump(AssetInterface $asset)
    {
        $variables = new Collection();
        $compiler  = new Compiler();

        if ($dir = $asset->getSourceDirectory()) {
            $compiler->addImportPath($dir);
        }

        $compiler->setVariables($variables->all());

        $asset->setContent($compiler->compile($asset->getContent()));
    }
}

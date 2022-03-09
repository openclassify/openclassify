<?php namespace Anomaly\Streams\Platform\Asset\Filter;

use Anomaly\Streams\Platform\Support\Collection;
use Assetic\Asset\AssetInterface;
use Assetic\Filter\SassphpFilter;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Leafo\ScssPhp\Compiler;

/**
 * Class SassFilter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SassFilter extends SassphpFilter
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

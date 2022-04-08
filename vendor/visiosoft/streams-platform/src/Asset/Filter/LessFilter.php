<?php namespace Anomaly\Streams\Platform\Asset\Filter;

use Anomaly\Streams\Platform\Support\Collection;
use Assetic\Asset\AssetInterface;
use Assetic\Filter\LessphpFilter;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class LessFilter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LessFilter extends LessphpFilter
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
        $compiler  = new \lessc();
        $variables = new Collection();

        $compiler->setVariables($variables->all());

        if ($dir = $asset->getSourceDirectory()) {
            $compiler->importDir = $dir;
        }

        foreach ($this->loadPaths as $loadPath) {
            $compiler->addImportDir($loadPath);
        }

        $asset->setContent($compiler->parse($asset->getContent()));
    }
}

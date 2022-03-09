<?php namespace Anomaly\Streams\Platform\Asset\Filter;

use Anomaly\Streams\Platform\Asset\AssetParser;
use Assetic\Asset\AssetInterface;

/**
 * Class StylusFilter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StylusFilter extends \Assetic\Filter\StylusFilter
{

    /**
     * Create a new LessFilter instance.
     *
     * @param AssetParser $parser
     */
    public function __construct()
    {
        parent::__construct(
            '/usr/local/bin/node',
            ['/usr/local/lib/node_modules', '/usr/local/lib/node_modules/stylus']
        );
    }

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
        $asset->setContent($asset->getContent());

        parent::filterLoad($asset);
    }
}

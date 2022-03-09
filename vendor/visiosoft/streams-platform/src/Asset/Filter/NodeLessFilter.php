<?php namespace Anomaly\Streams\Platform\Asset\Filter;

use Assetic\Asset\AssetInterface;

/**
 * Class NodeLessFilter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class NodeLessFilter extends \Assetic\Filter\LessFilter
{

    /**
     * Create a new NodeLessFilter instance.
     */
    public function __construct()
    {
        parent::__construct(
            '/usr/local/bin/node',
            [
                '/usr/local/lib/node_modules',
                '/usr/local/lib/node_modules/less/bin/lessc',
            ]
        );
    }

    /**
     * Filters an asset after it has been loaded.
     *
     * @param AssetInterface $asset
     */
    public function filterLoad(AssetInterface $asset)
    {
        $asset->setContent($asset->getContent());

        parent::filterLoad($asset);
    }
}

<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class AddAssets
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddAssets
{

    /**
     * The form builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new AddAssets instance.
     *
     * @param TreeBuilder $builder
     */
    public function __construct(TreeBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param  Asset      $asset
     * @throws \Exception
     */
    public function handle(Asset $asset)
    {
        foreach ($this->builder->getAssets() as $collection => $assets) {
            if (!is_array($assets)) {
                $assets = [$assets];
            }

            foreach ($assets as $file) {
                $filters = explode('|', $file);

                $file = array_shift($filters);

                $asset->add($collection, $file, $filters);
            }
        }
    }
}

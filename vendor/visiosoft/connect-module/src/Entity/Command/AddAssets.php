<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class AddAssets
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class AddAssets
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new AddAssets instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param Asset $asset
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

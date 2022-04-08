<?php namespace Anomaly\BlocksModule\Area\Contract;

use Anomaly\BlocksModule\Block\BlockCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Interface AreaInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface AreaInterface extends EntryInterface
{

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the related blocks.
     *
     * @return BlockCollection
     */
    public function getBlocks();

    /**
     * Return the blocks relation.
     *
     * @return MorphMany
     */
    public function blocks();

}

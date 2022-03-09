<?php namespace Anomaly\BlocksModule\Area;

use Anomaly\BlocksModule\Area\Contract\AreaInterface;
use Anomaly\BlocksModule\Block\BlockCollection;
use Anomaly\BlocksModule\Block\BlockModel;
use Anomaly\Streams\Platform\Model\Blocks\BlocksAreasEntryModel;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class AreaModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AreaModel extends BlocksAreasEntryModel implements AreaInterface
{

    /**
     * The cascading relations.
     *
     * @var array
     */
    protected $cascades = [
        'blocks',
    ];

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the related blocks.
     *
     * @return BlockCollection
     */
    public function getBlocks()
    {
        return $this->getAttribute('blocks');
    }

    /**
     * Return the blocks relation.
     *
     * @return MorphMany
     */
    public function blocks()
    {
        return $this
            ->morphMany(BlockModel::class, 'area', 'area_type');
    }
}

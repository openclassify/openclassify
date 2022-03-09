<?php namespace Anomaly\BlocksModule\Block;

use Anomaly\BlocksModule\Block\Contract\BlockInterface;
use Anomaly\BlocksModule\Block\Contract\BlockRepositoryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;

/**
 * Class BlockRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\BlocksModule\Block
 */
class BlockRepository extends EntryRepository implements BlockRepositoryInterface
{

    /**
     * The block model.
     *
     * @var BlockModel
     */
    protected $model;

    /**
     * Create a new BlockRepository instance.
     *
     * @param BlockModel $model
     */
    public function __construct(BlockModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a block by it's slug.
     *
     * @param $slug
     * @return null|BlockInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Sync an area's blocks.
     *
     * @param EntryInterface $area
     * @param FieldInterface $field
     * @param array          $ids
     */
    public function sync(EntryInterface $area, FieldInterface $field, array $ids)
    {
        $this->model
            ->where('area_type', get_class($area))
            ->where('area_id', $area->getId())
            ->where('field_id', $field->getId())
            ->whereNotIn('id', $ids)
            ->delete();
    }
}

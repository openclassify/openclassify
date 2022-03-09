<?php namespace Anomaly\BlocksModule\Block\Table;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BlockTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\BlocksModule\Block\Table
 */
class BlockTableBuilder extends TableBuilder
{

    /**
     * The block area.
     *
     * @var EntryInterface
     */
    protected $area;

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'title',
        'extension',
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'extension' => [
            'heading' => 'anomaly.module.blocks::field.block.name',
            'wrapper' => '{value.extension}<br><span class="text-muted">{value.title}</span>',
            'value'   => [
                'title'     => 'entry.title',
                'extension' => 'entry.extension.title',
            ],
        ],
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'edit',
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'delete',
    ];

    /**
     * Fired just before querying.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        $area = $this->getArea();

        $query->where('area_id', $area->getId());
        $query->where('area_type', get_class($area));
    }

    /**
     * Get the area.
     *
     * @return EntryInterface
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set the area.
     *
     * @param EntryInterface $area
     * @return $this
     */
    public function setArea(EntryInterface $area)
    {
        $this->area = $area;

        return $this;
    }

}

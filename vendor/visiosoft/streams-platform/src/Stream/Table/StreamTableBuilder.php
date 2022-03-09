<?php namespace Anomaly\Streams\Platform\Stream\Table;

use Anomaly\Streams\Platform\Stream\StreamModel;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class StreamTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StreamTableBuilder extends TableBuilder
{

    /**
     * The table model.
     *
     * @var string
     */
    protected $model = StreamModel::class;

    /**
     * The streams namespace.
     *
     * @var null|string
     */
    protected $namespace = null;

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'search' => [
            'columns' => [
                'name',
                'slug',
                'description',
            ],
        ],
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'heading' => 'streams::field.name.name',
            'value'   => 'entry.name',
        ],
        [
            'heading'     => 'streams::field.slug.name',
            'value'       => 'entry.slug',
            'sort_column' => 'slug',
        ],
        [
            'heading' => 'streams::field.description.name',
            'value'   => 'entry.description',
        ],
        [
            'value' => 'entry.labels',
        ],
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $actions = [
        'prompt',
    ];

    /**
     * Fired just before querying.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        if ($namespace = $this->getNamespace()) {
            $query->where('namespace', $namespace);
        }
    }

    /**
     * Get the namespace.
     *
     * @return null|string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Set the namespace.
     *
     * @param $namespace
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }
}

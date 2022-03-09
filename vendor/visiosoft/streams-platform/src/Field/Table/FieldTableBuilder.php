<?php namespace Anomaly\Streams\Platform\Field\Table;

use Anomaly\Streams\Platform\Field\Table\View\UnassignedQuery;
use Anomaly\Streams\Platform\Field\Table\Filter\TypeFilterOptions;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FieldTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldTableBuilder extends TableBuilder
{

    /**
     * The locked flag.
     *
     * @var bool
     */
    protected $locked = false;

    /**
     * The related stream instance.
     *
     * @var null|StreamInterface
     */
    protected $stream = null;

    /**
     * The stream namespace.
     *
     * @var null|string
     */
    protected $namespace = null;

    /**
     * The table model.
     *
     * @var string
     */
    protected $model = 'Anomaly\Streams\Platform\Field\FieldModel';

    /**
     * The table views.
     *
     * @var array
     */
    protected $views = [
        'all',
        'unassigned' => [
            'query' => UnassignedQuery::class,
            'text'  => 'streams::view.unassigned',
        ],
    ];

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
            ],
        ],
        'type'   => [
            'filter'      => 'select',
            'options'     => TypeFilterOptions::class,
            'placeholder' => 'streams::field.type.name',
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
            'heading' => 'streams::field.slug.name',
            'value'   => 'entry.slug',
        ],
        [
            'heading' => 'streams::field.type.name',
            'value'   => 'entry.type.title',
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
        'prompt',
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'order_by' => [
            'slug' => 'ASC',
        ],
    ];

    /**
     * Limit to the stream's namespace.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        $query->where('namespace', $this->getStream() ? $this->getStreamNamespace() : $this->getNamespace());

        if (($locked = $this->getLocked()) !== null) {
            $query->where('locked', $locked);
        }
    }

    /**
     * Get the lock flag.
     *
     * @return bool
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set the lock flag.
     *
     * @param $locked
     * @return $this
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get the stream.
     *
     * @return StreamInterface|null
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Return the related stream's namespace.
     *
     * @return string
     */
    protected function getStreamNamespace()
    {
        $stream = $this->getStream();

        return $stream->getNamespace();
    }

    /**
     * Set the stream.
     *
     * @param  StreamInterface $stream
     * @return $this
     */
    public function setStream(StreamInterface $stream)
    {
        $this->stream = $stream;

        return $this;
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

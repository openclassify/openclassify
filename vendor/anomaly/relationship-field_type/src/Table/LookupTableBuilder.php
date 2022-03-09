<?php namespace Anomaly\RelationshipFieldType\Table;

use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class LookupTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\RelationshipFieldType\Table
 */
class LookupTableBuilder extends TableBuilder
{

    /**
     * The field type configuration.
     *
     * @var null|Collection
     */
    protected $config = null;

    /**
     * The ajax flag.
     *
     * @var bool
     */
    protected $ajax = true;

    /**
     * The table filters.
     *
     * @var string
     */
    protected $filters = LookupTableFilters::class;

    /**
     * The table columns.
     *
     * @var string
     */
    protected $columns = LookupTableColumns::class;

    /**
     * The table buttons.
     *
     * @var string
     */
    protected $buttons = LookupTableButtons::class;

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'sortable' => false,
        'title'    => 'anomaly.field_type.relationship::message.choose_entry'
    ];

    /**
     * Return a config value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function config($key, $default = null)
    {
        return $this->config->get($key, $default);
    }

    /**
     * Get the config.
     *
     * @return Collection|null
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the config.
     *
     * @param Collection $config
     * @return $this
     */
    public function setConfig(Collection $config)
    {
        $this->config = $config;

        return $this;
    }
}

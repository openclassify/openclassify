<?php namespace Visiosoft\MultipleFieldType\Table;

use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

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
     * The table actions.
     *
     * @var string
     */
    protected $actions = LookupTableActions::class;

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'sortable'   => false,
        'title'      => 'visiosoft.field_type.multiple::message.select_entries',
        'table_view' => 'visiosoft.field_type.multiple::table/ajax',
    ];

    /**
     * Return a config value.
     *
     * @param        $key
     * @param  null  $default
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
     * @param  Collection $config
     * @return $this
     */
    public function setConfig(Collection $config)
    {
        $this->config = $config;

        return $this;
    }
}

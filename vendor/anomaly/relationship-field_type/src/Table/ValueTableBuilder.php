<?php namespace Anomaly\RelationshipFieldType\Table;

use Anomaly\RelationshipFieldType\RelationshipFieldType;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Class ValueTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\RelationshipFieldType\Table
 */
class ValueTableBuilder extends TableBuilder
{

    /**
     * The field type configuration.
     *
     * @var null|Collection
     */
    protected $config = null;

    /**
     * The field type.
     *
     * @var null|RelationshipFieldType
     */
    protected $fieldType = null;

    /**
     * The selected entry.
     *
     * @var array
     */
    protected $selected = null;

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'remove' => [
            'data-dismiss' => 'relationship',
            'data-entry'   => 'entry.id'
        ]
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'limit'          => 1,
        'sortable'       => false,
        'enable_views'   => false,
        'enable_headers' => false,
        'table_view'     => 'anomaly.field_type.relationship::table/table'
    ];

    /**
     * Fired just before querying.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        $model = $this->getTableModel();

        $query->where($model->getTableName() . '.id', $this->getSelected() ?: 0);
    }

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

    /**
     * Get the selected value.
     *
     * @return int|null
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * Get the selected value.
     *
     * @param $selected
     * @return $this
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;

        return $this;
    }

    /**
     * Get the field type.
     *
     * @return RelationshipFieldType|null
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }

    /**
     * Set the field type.
     *
     * @param RelationshipFieldType $fieldType
     * @return $this
     */
    public function setFieldType(RelationshipFieldType $fieldType)
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    /**
     * Set the table entries.
     *
     * @param \Illuminate\Support\Collection $entries
     * @return $this
     */
    public function setTableEntries(\Illuminate\Support\Collection $entries)
    {
        if (!$this->getFieldType()) {
            $entries = $entries->sort(
                function ($a, $b) {
                    return array_search($a->id, $this->getSelected()) - array_search($b->id, $this->getSelected());
                }
            );
        }

        return parent::setTableEntries($entries);
    }
}

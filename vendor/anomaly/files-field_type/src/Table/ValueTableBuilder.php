<?php namespace Anomaly\FilesFieldType\Table;

use Anomaly\FilesFieldType\FilesFieldType;
use Anomaly\FilesModule\File\FileModel;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ValueTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ValueTableBuilder extends TableBuilder
{

    /**
     * The uploaded IDs.
     *
     * @var array
     */
    protected $uploaded = [];

    /**
     * The field type.
     *
     * @var null|FilesFieldType
     */
    protected $fieldType = null;

    /**
     * The table model.
     *
     * @var string
     */
    protected $model = FileModel::class;

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.preview' => [
            'heading' => 'anomaly.module.files::field.preview.name',
        ],
        'name'          => [
            'sort_column' => 'name',
            'wrapper'     => '
                    <strong>{value.file}</strong>
                    <br>
                    <small class="text-muted">{value.disk}://{value.folder}/{value.file}</small>
                    <br>
                    <span>{value.size} {value.keywords}</span>',
            'value'       => [
                'file'     => 'entry.name',
                'folder'   => 'entry.folder.slug',
                'keywords' => 'entry.keywords.labels|join',
                'disk'     => 'entry.folder.disk.slug',
                'size'     => 'entry.size_label',
            ],
        ],
        'size'          => [
            'sort_column' => 'size',
            'value'       => 'entry.readable_size',
        ],
        'mime_type',
        'folder',
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'edit'   => [
            'target'     => '_blank',
            'href'       => 'admin/files/edit/{entry.id}',
            'permission' => 'anomaly.module.files::files.write',
        ],
        'view'   => [
            'target' => '_blank',
            'href'   => 'admin/files/view/{entry.id}',
        ],
        'remove' => [
            'data-dismiss' => 'file',
            'data-file'    => 'entry.id',
        ],
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'limit'              => 9999,
        'show_headers'       => false,
        'sortable_headers'   => false,
        'table_view'         => 'anomaly.field_type.files::table/table',
        'no_results_message' => 'anomaly.field_type.files::message.no_files_selected',
    ];

    /**
     * Fired just before querying
     * for table entries.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        $uploaded = $this->getUploaded();

        if ($fieldType = $this->getFieldType()) {

            /*
             * If we have the entry available then
             * we can determine saved sort order.
             */
            $entry = $fieldType->getEntry();
            $table = $fieldType->getPivotTableName();

            if ($entry->getId() && !$uploaded) {
                $query->join($table, $table . '.file_id', '=', 'files_files.id');
                $query->where($table . '.entry_id', $entry->getId());
                $query->orderBy($table . '.sort_order', 'ASC');
            } elseif ($entry->getId()) {
                $query->where($table . '.entry_id', $entry->getId());
                $query->join($table, $table . '.file_id', '=', 'files_files.id');
                $query->orderBy($table . '.sort_order', 'ASC');
            } else {
                $query->whereIn('id', $uploaded ?: [0]);
            }
        } else {

            /*
             * If all we have is ID then just use that.
             * The JS / UI will be handling the sort
             * order at this time.
             */
            $query->whereIn('id', $uploaded ?: [0]);
        }
    }

    /**
     * Get the field type.
     *
     * @return FilesFieldType|null
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }

    /**
     * Set the field type.
     *
     * @param  FilesFieldType $fieldType
     * @return $this
     */
    public function setFieldType(FilesFieldType $fieldType)
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    /**
     * Get the uploaded.
     *
     * @return array
     */
    public function getUploaded()
    {
        return $this->uploaded;
    }

    /**
     * Set the uploaded.
     *
     * @param $uploaded
     * @return $this
     */
    public function setUploaded($uploaded)
    {
        $this->uploaded = $uploaded;

        return $this;
    }

    /**
     * Set the table entries.
     *
     * @param  \Illuminate\Support\Collection $entries
     * @return ValueTableBuilder|TableBuilder
     */
    public function setTableEntries(\Illuminate\Support\Collection $entries)
    {
        if (!$this->getFieldType()) {
            $entries = $entries->sort(
                function ($a, $b) {
                    return array_search($a->id, $this->getUploaded()) - array_search($b->id, $this->getUploaded());
                }
            );
        }

        return parent::setTableEntries($entries);
    }
}

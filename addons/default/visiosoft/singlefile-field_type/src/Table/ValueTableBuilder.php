<?php namespace Visiosoft\SinglefileFieldType\Table;

use Anomaly\FilesModule\File\FileModel;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ValueTableBuilder
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
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
        'view'   => [
            'target' => '_blank',
            'href'   => 'admin/files/view/{entry.id}',
        ],
        'remove' => [
            'data-dismiss' => 'file',
        ],
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'limit'              => 1,
        'show_headers'       => false,
        'sortable_headers'   => false,
        'table_view'         => 'visiosoft.field_type.singlefile::table',
        'no_results_message' => 'visiosoft.field_type.singlefile::message.no_file_selected',
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [
        'styles.css' => [
            'visiosoft.field_type.singlefile::less/input.less',
        ],
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

        $query->whereIn('id', $uploaded ?: [0]);

        $query->orderBy('updated_at', 'ASC');
        $query->orderBy('created_at', 'ASC');
    }

    /**
     * Get uploaded IDs.
     *
     * @return array
     */
    public function getUploaded()
    {
        return $this->uploaded;
    }

    /**
     * Set the uploaded IDs.
     *
     * @param  array $uploaded
     * @return $this
     */
    public function setUploaded(array $uploaded)
    {
        $this->uploaded = $uploaded;

        return $this;
    }
}

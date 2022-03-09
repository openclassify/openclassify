<?php namespace Anomaly\FileFieldType\Table;

use Anomaly\FilesModule\File\FileModel;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FileTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FileTableBuilder extends TableBuilder
{

    /**
     * Field configuration.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The ajax flag.
     *
     * @var bool
     */
    protected $ajax = true;

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
        'select' => [
            'data-file' => 'entry.id',
        ],
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'enable_views' => false,
        'title'        => 'anomaly.field_type.file::message.choose_file',
    ];

    /**
     * Fired when query starts building.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        if ($folders = array_get($this->getConfig(), 'folders')) {
            $query->whereIn(
                'folder_id',
                array_filter(
                    array_map(
                        function ($folder) {

                            if (is_numeric($folder)) {
                                return $folder;
                            }

                            if ($folder = $this->dispatch(new GetFolder($folder))) {
                                return $folder->getId();
                            }

                            return null;
                        },
                        $folders
                    )
                )
            );
        }

        if ($allowed = array_get($this->getConfig(), 'allowed_types')) {
            $query->whereIn('extension', $allowed);
        }
    }

    /**
     * Get the config.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the config.
     *
     * @param  array $config
     * @return $this
     */
    public function setConfig(array $config = [])
    {
        $this->config = $config;

        return $this;
    }
}

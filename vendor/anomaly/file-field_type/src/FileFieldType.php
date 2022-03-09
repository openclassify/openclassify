<?php

namespace Anomaly\FileFieldType;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Anomaly\FileFieldType\Table\ValueTableBuilder;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class FileFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileFieldType extends FieldType
{

    /**
     * The underlying database column type
     *
     * @var string
     */
    protected $columnType = 'integer';

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.file::input';

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'mode'    => 'default',
        'folders' => [],
    ];

    /**
     * Get the relation.
     *
     * @return BelongsTo
     */
    public function getRelation()
    {
        $entry = $this->getEntry();

        return $entry->belongsTo(
            Arr::get($this->config, 'related', 'Anomaly\FilesModule\File\FileModel'),
            $this->getColumnName()
        );
    }

    /**
     * Get the config.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $post = str_replace('M', '', ini_get('post_max_size'));
        $file = str_replace('M', '', ini_get('upload_max_filesize'));

        $server = $file > $post ? $post : $file;

        $max = Arr::get($config, 'max');

        if ($max && $max > $server) {
            $max = $server;
        }

        Arr::set($config, 'max', $max);

        Arr::set($config, 'folders', (array)$this->config('folders', []));

        return $config;
    }

    /**
     * Get the database column name.
     *
     * @return null|string
     */
    public function getColumnName()
    {
        return parent::getColumnName() . '_id';
    }

    /**
     * Return the config key.
     *
     * @return string
     */
    public function configKey()
    {
        Cache::remember($this->getInputName() . '-config', 60 * 60 * 24, function () {
            return $this->getConfig();
        });

        return $this->getInputName() . '-config';
    }

    /**
     * Value table.
     *
     * @return string
     */
    public function valueTable()
    {
        $table = app(ValueTableBuilder::class);

        $file = $this->getValue();

        if ($file instanceof FileInterface) {
            $file = $file->getId();
        }

        return $table->setUploaded([$file])->build()->load()->getTableContent();
    }
}

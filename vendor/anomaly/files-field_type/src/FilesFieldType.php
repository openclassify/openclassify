<?php namespace Anomaly\FilesFieldType;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Anomaly\FilesModule\File\FileModel;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\FilesFieldType\Table\ValueTableBuilder;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class FilesFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FilesFieldType extends FieldType
{

    /**
     * No database column.
     *
     * @var bool
     */
    protected $columnType = false;

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.files::input';

    /**
     * The field type rules.
     *
     * @var array
     */
    protected $rules = [
        'array',
    ];

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'mode' => 'default',
    ];

    /**
     * Return the ids.
     *
     * @return array|mixed|static
     */
    public function ids()
    {
        $value = $this->getValue();

        if (is_object($value)) {
            $value = $value->pluck('id')->all();
        }

        return array_filter((array)$value);
    }

    /**
     * Get the rules.
     *
     * @return array
     */
    public function getRules()
    {
        $rules = parent::getRules();

        if ($min = array_get($this->getConfig(), 'min')) {
            $rules[] = 'min:' . $min;
        }

        if ($max = array_get($this->getConfig(), 'max')) {
            $rules[] = 'max:' . $max;
        }

        return $rules;
    }

    /**
     * Get the config.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();
        Arr::set($config, 'folders', (array)$this->config('folders', []));

        return $config;
    }

    /**
     * Get the relation.
     *
     * @return BelongsToMany
     */
    public function getRelation()
    {
        $entry = $this->getEntry();

        return $entry->belongsToMany(
            $this->getRelatedModel(),
            $this->getPivotTableName(),
            'entry_id',
            'file_id'
        )->orderBy($this->getPivotTableName() . '.sort_order', 'ASC');
    }

    /**
     * Get the unsorted relation.
     *
     * @return BelongsToMany
     */
    public function getUnsortedRelation()
    {
        $entry = $this->getEntry();

        return $entry->belongsToMany(
            $this->getRelatedModel(),
            $this->getPivotTableName(),
            'entry_id',
            'file_id'
        );
    }

    /**
     * Get the pivot table.
     *
     * @return string
     */
    public function getPivotTableName()
    {
        return $this->getEntryTableName() . '_' . $this->getField();
    }

    /**
     * Get the entry table.
     *
     * @return string
     */
    public function getEntryTableName()
    {
        return $this->entry->getTableName();
    }

    /**
     * Get the related model.
     *
     * @return null|FileModel
     */
    public function getRelatedModel()
    {
        return app($this->config('related', 'Anomaly\FilesModule\File\FileModel'));
    }

    /**
     * Handle saving the form data ourselves.
     *
     * @param FormBuilder $builder
     */
    public function handle(FormBuilder $builder)
    {
        $entry = $builder->getFormEntry();

        // See the accessor for how IDs are handled.
        $entry->{$this->getField()} = $this->getPostValue();
    }

    /**
     * Get the post value.
     *
     * @param  null $default
     * @return array
     */
    public function getPostValue($default = null)
    {
        return array_filter(explode(',', parent::getPostValue($default)));
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
        /* @var ValueTableBuilder $table */
        $table = app(ValueTableBuilder::class)
            ->setFieldType($this);

        $files = $this->getValue();

        // Arrays are from validation.
        if (!$files instanceof EntryCollection) {
            $table->setUploaded(array_unique((array)$files));
        }

        if ($files instanceof EntryCollection) {
            $table->setUploaded($files->ids());
        }

        return $table
            ->build()
            ->load()
            ->getTableContent();
    }

    /**
     * Fired after an entry is deleted.
     *
     * @param FilesFieldType $fieldType
     */
    public function onEntryDeleted()
    {
        $pivot   = $this->getPivotTableName();
        $related = $this->getEntryTableName();

//        $abandoned = app('db')
//            ->table($pivot)
//            ->select($pivot . '.id')
//            ->leftJoin(
//                $related,
//                $pivot . '.entry_id',
//                '=',
//                $related . '.id'
//            )
//            ->whereNull($related . '.id')
//            ->get();

        //dd($abandoned);
    }

    /**
     * Fired just before version comparison.
     *
     * @param EloquentCollection $related
     */
    public function toArrayForComparison(EloquentCollection $related)
    {
        return $related->map(
            function (EloquentModel $model) {
                return array_diff_key(
                    $model->toArrayWithRelations(),
                    array_flip(
                        [
                            'id',
                            'sort_order',
                            'created_at',
                            'created_by_id',
                            'updated_at',
                            'updated_by_id',
                            'deleted_at',
                            'deleted_by_id',
                        ]
                    )
                );
            }
        )->toArray();
    }
}

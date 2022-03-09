<?php namespace Anomaly\Streams\Platform\Field;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentRepository;

/**
 * Class FieldRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldRepository extends EloquentRepository implements FieldRepositoryInterface
{

    /**
     * The field model.
     *
     * @var FieldModel
     */
    protected $model;

    /**
     * Create a new FieldRepository instance.
     *
     * @param FieldModel $model
     */
    public function __construct(FieldModel $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new field.
     *
     * @param  array $attributes
     * @return FieldInterface
     */
    public function create(array $attributes = [])
    {
        $attributes['config'] = array_get($attributes, 'config', []);
        $attributes['locked'] = (array_get($attributes, 'locked', true));

        return $this->model->create($attributes);
    }

    /**
     * Find a field by it's slug and namespace.
     *
     * @param  $slug
     * @param  $namespace
     * @return null|FieldInterface
     */
    public function findBySlugAndNamespace($slug, $namespace)
    {
        return $this->model->where('namespace', $namespace)->where('slug', $slug)->first();
    }

    /**
     * Return all fields in a namespace.
     *
     * @param  $namespace
     * @return FieldCollection
     */
    public function findAllByNamespace($namespace)
    {
        return $this->model->where('namespace', $namespace)->get();
    }

    /**
     * Clean up abandoned fields.
     */
    public function cleanup()
    {
        $fieldTypes = app('field_type.collection')->map(
            function (FieldType $fieldType) {
                return $fieldType->getNamespace();
            }
        )->all();

        $fields = $this->model
            ->select('streams_fields.*')
            ->leftJoin('streams_streams', 'streams_fields.namespace', '=', 'streams_streams.namespace')
            ->whereNull('streams_streams.id')
            ->get();

        foreach ($fields as $field) {
            $this->delete($field);
        }

        foreach ($this->model->where('slug', '')->get() as $field) {
            $this->delete($field);
        }

        foreach ($this->model->where('namespace', '')->get() as $field) {
            $this->delete($field);
        }

        foreach ($this->model->whereNotIn('type', $fieldTypes)->get() as $field) {
            $this->delete($field);
        }

        $translations = $this->model->getTranslationModel();

        $translations = $translations
            ->select('streams_fields_translations.*')
            ->leftJoin(
                'streams_fields',
                'streams_fields_translations.field_id',
                '=',
                'streams_fields.id'
            )
            ->whereNull('streams_fields.id')
            ->get();

        foreach ($translations as $translation) {
            $this->delete($translation);
        }
    }
}

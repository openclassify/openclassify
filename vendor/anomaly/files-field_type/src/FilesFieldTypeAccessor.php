<?php namespace Anomaly\FilesFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeAccessor;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class FilesFieldTypeAccessor
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FilesFieldTypeAccessor extends FieldTypeAccessor
{

    /**
     * The field type object.
     * This is for IDE support.
     *
     * @var FilesFieldType
     */
    protected $fieldType;

    /**
     * Set the value.
     *
     * @param $value
     */
    public function set($value)
    {
        if (is_string($value)) {
            $value = $this->organizeSyncValue(explode(',', $value));
        } elseif (is_array($value)) {
            $value = $this->organizeSyncValue($value);
        } elseif ($value instanceof Collection) {
            $value = $this->organizeSyncValue($value->filter()->all());
        } elseif ($value instanceof EntryInterface) {
            $value = $this->organizeSyncValue([$value->getId()]);
        }

        $this->fieldType->getRelation()->detach();
        $this->fieldType->getRelation()->sync($value);
    }

    /**
     * Organize the value for sync.
     *
     * @param  array $value
     * @return array
     */
    protected function organizeSyncValue(array $value)
    {

        /**
         * First clean our value.
         */
        $value = array_filter(array_unique((array)$value));

        /**
         * Next take the natural array
         * key and make it the sort order.
         */
        $value = array_combine(
            array_values($value),
            array_map(
                function ($key) {
                    return [
                        'sort_order' => $key,
                    ];
                },
                array_keys($value)
            )
        );

        /**
         * Lastly add the file_id
         * relation column for sync.
         */
        array_walk(
            $value,
            function (&$value, $key) {
                $value['file_id'] = $key;
            }
        );

        return $value;
    }

    /**
     * Get the value.
     *
     * @return mixed
     */
    public function get()
    {
        return $this->fieldType->getRelation();
    }
}

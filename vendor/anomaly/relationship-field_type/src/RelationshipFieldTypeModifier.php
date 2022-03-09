<?php namespace Anomaly\RelationshipFieldType;

use Anomaly\RelationshipFieldType\Command\SetRelation;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RelationshipFieldTypeModifier
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\RelationshipFieldType
 */
class RelationshipFieldTypeModifier extends FieldTypeModifier
{

    use DispatchesJobs;

    /**
     * The field type instance.
     * This is for IDE support.
     *
     * @var RelationshipFieldType
     */
    protected $fieldType;

    /**
     * Modify the value.
     *
     * @param $value
     * @return integer
     */
    public function modify($value)
    {
        if ($value instanceof EloquentModel) {

            $this->dispatch(new SetRelation($this->fieldType, $value));

            return $value->getId();
        }

        return $value === null ? $value : (int)$value;
    }

    /**
     * Restore the value from storage format.
     *
     * @param  $value
     * @return mixed
     */
    public function restore($value)
    {
        return $value ?: null;
    }
}

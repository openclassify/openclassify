<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class PolymorphicFieldType
 *
 * @link   http://pyrocms.com
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PolymorphicFieldType extends FieldType
{

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.polymorphic::input';

    /**
     * Get the relation.
     *
     * @return MorphTo|mixed|null
     */
    public function getRelation()
    {
        return $this->entry->morphTo($this->getField());
    }

    /**
     * Handle saving input.
     */
    public function handle()
    {
        // We don't do anything yet.
    }
}

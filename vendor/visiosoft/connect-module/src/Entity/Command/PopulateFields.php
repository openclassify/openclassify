<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Http\Request;

/**
 * Class PopulateFields
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class PopulateFields
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new PopulateFields instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the event.
     */
    public function handle(Request $request)
    {
        /* @var FieldType $field */
        foreach ($request->old() as $key => $value) {
            if ($field = $this->builder->getEntityField($key)) {
                $field->setValue($value);
            }
        }
    }
}

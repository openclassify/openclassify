<?php namespace Anomaly\BlocksFieldType\Command;

use Anomaly\BlocksFieldType\BlocksFieldType;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;

/**
 * Class GetMultiformFromValue
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetMultiformFromValue
{

    use DispatchesJobs;

    /**
     * The field type instance.
     *
     * @var BlocksFieldType
     */
    protected $fieldType;

    /**
     * Create a new GetMultiformFromValue instance.
     *
     * @param BlocksFieldType $fieldType
     */
    public function __construct(BlocksFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Get the multiple form builder from the value.
     *
     * @return MultipleFormBuilder|null
     */
    public function handle()
    {
        /* @var EntryCollection $value */
        if (!$value = $this->fieldType->getValue()) {
            return null;
        }

        if (is_array($value)) {
            return $this->dispatch(new GetMultiformFromData($this->fieldType));
        }

        if ($value instanceof Collection) {
            return $this->dispatch(new GetMultiformFromRelation($this->fieldType));
        }

        return null;
    }
}

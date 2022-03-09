<?php namespace Anomaly\DatetimeFieldType\Validation;

use Anomaly\DatetimeFieldType\DatetimeFieldType;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Carbon\Carbon;

/**
 * Class ValidateDatetime
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ValidateDatetime
{

    /**
     * Handle the validation.
     *
     * @param FormBuilder $builder
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function handle(DatetimeFieldType $fieldType, $value)
    {
        if (empty($value)) {
            return true;
        }

        try {
            (new Carbon())->createFromFormat($fieldType->getInputFormat(), $value, $fieldType->configGet('timezone'));
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}

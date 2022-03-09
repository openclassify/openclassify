<?php namespace Anomaly\StateFieldType\Validation;

use Anomaly\StateFieldType\StateFieldType;

/**
 * Class ValidateState
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\StateFieldType\Validation
 */
class ValidateState
{

    /**
     * Handle the validation.
     *
     * @param StateFieldType   $fieldType
     * @param                  $value
     * @return bool
     */
    public function handle(StateFieldType $fieldType, $value)
    {
        $options = array_map(
            function ($states) {
                return array_flip($states);
            },
            $fieldType->getOptions()
        );

        return in_array(strtoupper($value), array_flatten($options));
    }
}

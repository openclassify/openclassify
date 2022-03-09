<?php namespace Anomaly\CountryFieldType\Validation;

use Anomaly\CountryFieldType\CountryFieldType;

/**
 * Class ValidateCountry
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CountryFieldType\Validation
 */
class ValidateCountry
{

    /**
     * Handle the validation.
     *
     * @param CountryFieldType $fieldType
     * @param                  $value
     * @return bool
     */
    public function handle(CountryFieldType $fieldType, $value)
    {
        return in_array(strtoupper($value), array_keys($fieldType->getOptions()));
    }
}
